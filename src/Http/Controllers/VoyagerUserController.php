<?php

namespace Joy\VoyagerRelationsTable\Http\Controllers;

use Joy\VoyagerRelationsTable\Http\Traits\AjaxAction;
use Joy\VoyagerRelationsTable\Http\Traits\IndexAction;
use Joy\VoyagerCore\Http\Controllers\VoyagerUserController as TCGVoyagerUserController;

class VoyagerUserController extends TCGVoyagerUserController
{
    use IndexAction;
    use AjaxAction;
}
