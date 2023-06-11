<?php

namespace Modules\SGS\Controllers;

use App\Controllers\BaseController;
use Modules\SGS\Models\Solicitud_Model;;


class Solicitud extends BaseController {
    public function index(){
        echo view('Modules\SGS\Views\func');
        echo view('Modules\SGS\Views\solicitud');
    }
}