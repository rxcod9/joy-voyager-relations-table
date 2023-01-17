<?php

namespace Joy\VoyagerRelationsTable\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;
use TCG\Voyager\Facades\Voyager;

class RelationsTables extends Component
{
    /**
     * The request.
     *
     * @var Request
     */
    protected $request;

    /**
     * The parentSlug.
     *
     * @var string
     */
    protected $parentSlug;

    /**
     * The id.
     *
     * @var mixed
     */
    protected $id;

    /**
     * The relations.
     *
     * @var array
     */
    protected $relations;

    /**
     * The withLabel.
     *
     * @var bool|null
     */
    protected $withLabel;

    /**
     * The autoWidth.
     *
     * @var bool
     */
    protected $autoWidth;

    /**
     * The columnDefs.
     *
     * @var array
     */
    protected $columnDefs;

    /**
     * The withoutCheckbox.
     *
     * @var bool|null
     */
    protected $withoutCheckbox;

    /**
     * The withoutActions.
     *
     * @var bool|null
     */
    protected $withoutActions;

    /**
     * The dataId.
     *
     * @var string|null
     */
    protected $dataId;

    /**
     * Create the component instance.
     *
     * @param Request     $request
     * @param string      $parentSlug
     * @param mixed       $id
     * @param array       $relations
     * @param bool|null   $withLabel
     * @param bool        $autoWidth
     * @param array       $columnDefs
     * @param bool|null   $withoutCheckbox
     * @param bool|null   $withoutActions
     * @param string|null $dataId
     *
     * @return void
     */
    public function __construct(
        Request $request,
        string $parentSlug,
        $id,
        array $relations = [],
        ?bool $withLabel = true,
        ?bool $autoWidth = false,
        ?array $columnDefs = [],
        ?bool $withoutCheckbox = true,
        ?bool $withoutActions = true,
        ?string $dataId = null
    ) {
        $this->request         = $request;
        $this->parentSlug      = $parentSlug;
        $this->id              = $id;
        $this->relations       = $relations;
        $this->withLabel       = $withLabel;
        $this->autoWidth       = $autoWidth;
        $this->columnDefs      = $columnDefs;
        $this->withoutCheckbox = $withoutCheckbox;
        $this->withoutActions  = $withoutActions;
        $this->dataId          = $dataId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $parentSlug = $this->parentSlug;
        $id         = $this->id;
        $relations  = $this->relations;

        // GET THE DataType based on the slug
        $parentDataType = Voyager::model('DataType')->where('slug', '=', $parentSlug)->first();
        if (!$relations) {
            $relations = Voyager::model('DataRow')
                ->whereDataTypeId($parentDataType->id)
                ->where('type', '=', 'relationship')
                ->get()->filter(function ($item) {
                    return in_array($item->details->type, [
                        'hasMany',
                        'belongsToMany',
                        'morphMany',
                        'morphToMany',
                    ]);
                })->mapWithKeys(function ($item) {
                    $dataType = Voyager::model('DataType')->where('model_name', '=', $item->details->model)->firstOrFail();
                    return [
                        $item->field => $dataType->slug
                    ];
                })->toArray();
        }

        $view = 'joy-voyager-relations-table::components.relations-tables';

        return Voyager::view($view, [
            'parentSlug'      => $parentSlug,
            'id'              => $id,
            'relations'       => $relations,
            'withLabel'       => $this->withLabel,
            'autoWidth'       => $this->autoWidth,
            'columnDefs'      => $this->columnDefs,
            'withoutCheckbox' => $this->withoutCheckbox,
            'withoutActions'  => $this->withoutActions,
            'dataId'          => $this->dataId,
        ]);
    }
}
