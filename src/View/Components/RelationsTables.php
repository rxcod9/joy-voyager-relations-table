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
     * The withLabel.
     *
     * @var bool|null
     */
    protected $withLabel;

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
     * @param bool|null   $withoutCheckbox
     * @param bool|null   $withoutActions
     * @param bool|null   $withLabel
     * @param string|null $dataId
     *
     * @return void
     */
    public function __construct(
        Request $request,
        string $parentSlug,
        $id,
        array $relations = [],
        ?bool $withoutCheckbox = true,
        ?bool $withoutActions = true,
        ?bool $withLabel = true,
        ?string $dataId = null
    ) {
        $this->request         = $request;
        $this->parentSlug      = $parentSlug;
        $this->id              = $id;
        $this->relations       = $relations;
        $this->withoutCheckbox = $withoutCheckbox;
        $this->withoutActions  = $withoutActions;
        $this->withLabel       = $withLabel;
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

        $view = 'joy-voyager-relations-table::components.relations-tables';

        return Voyager::view($view, [
            'parentSlug'      => $parentSlug,
            'id'              => $id,
            'relations'       => $relations,
            'withoutCheckbox' => $this->withoutCheckbox,
            'withoutActions'  => $this->withoutActions,
            'withLabel'       => $this->withLabel,
            'dataId'          => $this->dataId,
        ]);
    }
}
