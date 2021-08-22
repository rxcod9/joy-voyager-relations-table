<?php

use Illuminate\Database\Eloquent\Model;

if (!function_exists('modelHasRelationshipMethod')) {
    /**
     * May have html
     *
     * @param Model|string $model
     */
    function modelHasRelationshipMethod(
        $model,
        string $relationshipMethod
    ): bool {
        // If the "attribute" exists as a method on the model, we will just assume
        // it is a relationship and will load and return results from the query
        // and hydrate the relationship's value on the "relationships" array.
        if (method_exists($model, $relationshipMethod)) {
            //Uses PHP built in function to determine whether the returned object is a laravel relation
            return is_a(
                $model->$relationshipMethod(),
                "Illuminate\Database\Eloquent\Relations\Relation"
            );
        }

        return false;
    }
}
