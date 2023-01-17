<?php

namespace Joy\VoyagerRelationsTable\Services;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use InvalidArgumentException;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\DataType;

class RelationshipResolver
{
    /**
     * Handle service
     */
    public function handle(
        DataType $parentDataType,
        Model $parentData,
        string $relation,
    ): Relation | EloquentBuilder | QueryBuilder {
        if (!$this->hasRelation($parentDataType, $parentData, $relation)) {
            throw new InvalidArgumentException('Invalid relationship');
        }

        $parentModel = app($parentDataType->model_name);
        if (modelHasRelationshipMethod($parentModel, $relation)) {
            return $parentData->{$relation}();
        }

        $dataRow = $parentDataType->rows->where('field', $relation)->first();
        $options = $dataRow->details;

        switch ($options->type) {
            case 'belongsTo':
                return $parentData->belongsTo(
                    $options->model,
                    $options->column ?? null,
                    $options->key ?? null,
                );
                break;
            case 'hasOne':
                return $parentData->hasOne(
                    $options->model,
                    $options->column ?? null,
                    $options->key ?? null,
                );
                break;
            case 'hasMany':
                return $parentData->hasMany(
                    $options->model,
                    $options->column ?? null,
                    $options->key ?? null,
                );
                break;
            case 'belongsToMany':
                return $parentData->belongsToMany(
                    $options->model,
                    $options->pivot_table,
                    $options->foreign_pivot_key ?? null,
                    $options->related_pivot_key ?? null,
                    $options->parent_key ?? null,
                    $options->key
                );
                break;
            case 'morphMany':
                return $parentData->morphMany(
                    $options->model, // Voyager::modelClass('Call'), // $related
                    $options->function, // 'callable', // $name
                    $options->type_column, // 'parent_type', // $type
                    $options->column, // 'parent_id', // $id
                    $options->local_key ?? null, // 'id', // $localKey
                );
                break;

            default:
                throw new InvalidArgumentException('Invalid relationship');
                break;
        }
    }

    /**
     * Check if has relation
     */
    public function hasRelation(
        DataType $parentDataType,
        Model $parentData,
        string $relation,
    ): bool {
        $parentModel = app($parentDataType->model_name);
        if (modelHasRelationshipMethod($parentModel, $relation)) {
            return true;
        }

        $dataRow = $parentDataType->rows->where('field', $relation)->first();

        if (!$dataRow) {
            return false;
        }

        $options = $dataRow->details;

        switch ($options->type) {
            case 'belongsTo':
            case 'hasOne':
            case 'hasMany':
            case 'belongsToMany':
            case 'morphMany':
                return true;
                break;

            default:
                //
                break;
        }

        return false;
    }
}
