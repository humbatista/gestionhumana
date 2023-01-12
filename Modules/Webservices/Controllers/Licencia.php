<?php 
namespace Modules\Webservices\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
use Modules\Webservices\Models\Licencia_Model;


class Licencia extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new Licencia_Model();
        $data['empleados']= $model->OrderBy('id','DESC')->findAll();
        return $this->respond($data);
    }

    public function show($id = null){
        $model = new Licencia_Model();
        $data = $model->where('cedula', $id)->find_All();
        if($data){
            return $this->respond($data);
        } else{
            return $this->failNotFound('No se encontro');
        }
    }
}