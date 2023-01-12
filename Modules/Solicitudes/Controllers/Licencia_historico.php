<?php 
namespace Modules\Solicitudes\Controllers;

use App\Controllers\BaseController;


use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use Modules\Solicitudes\Models\Licencia_Model;
use phpOffice\PhpWord\Style\Language;

class Licencia_historico extends Controller{
    public function loadRecord(){
        $request = service('request');
        $searchData= $request->getGet();

        $search="";
        if (isset($searchData) && isset($searchData['search'])) {
            $search = $searchData['search'];
        }

        //obtener los datos

        $users = new Licencia_Model();
 
        if ($search=='') {
            $paginateData = $users->select('*')
                ->orlike('id', 0)
                ->paginate(5);
        } else {
            $paginateData = $users->select('*')
                ->orlike('distrito', $search)
                ->orlike('nombres', $search)
                ->orlike('cedula', $search)
                ->paginate(5);
        }

        $data = [
            'licencia' => $paginateData,
            'pager' => $users->pager,
            'search' => $search
        ];
        echo view('Modules\Solicitudes\Views\header\head');
        echo view('Modules\Solicitudes\Views\header\header');
        echo view('Modules\Solicitudes\Views\menu\menu_admin');
        //echo view('Modules\Solicitudes\Views\menu\sidebaradmin');
        echo view('Modules\Solicitudes\Views\form\licencia_historico_view', $data);
        echo view('Modules\Solicitudes\Views\header\footer');
    }
}