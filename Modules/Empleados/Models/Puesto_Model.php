<?php 
namespace Modules\Empleados\Models;

use CodeIgniter\Model;

class Puesto_Model extends Model{
    protected $table      = 'app_puesto';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'codigo';
    protected $allowedFields = ['descripcion', 'grupo'];
}