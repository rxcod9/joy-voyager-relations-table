<?php

namespace Joy\VoyagerRelationsTable\Http\Controllers;

use Illuminate\Http\Request;
use Joy\VoyagerRelationsTable\Http\Traits\AjaxAction;
use Joy\VoyagerRelationsTable\Http\Traits\IndexAction;
use Joy\VoyagerCore\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;

class VoyagerBaseController extends BaseVoyagerBaseController
{
    use IndexAction;
    use AjaxAction;

    public function getSlug(Request $request)
    {
        if (isset($this->slug)) {
            $slug = $this->slug;
        } elseif (isset($request->slug)) {
            $slug = $request->slug;
        } else {
            $slug = explode('.', $request->route()->getName())[1];
        }

        return $slug;
    }

    public function getParentSlug(Request $request)
    {
        if (isset($this->parentSlug)) {
            $parentSlug = $this->parentSlug;
        } elseif (isset($request->parentSlug)) {
            $parentSlug = $request->parentSlug;
        } else {
            $parentSlug = explode('.', $request->route()->getName())[1];
        }

        return $parentSlug;
    }
}
