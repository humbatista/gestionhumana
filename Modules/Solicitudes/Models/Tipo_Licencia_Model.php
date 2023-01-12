<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Tipo_Licencia_Model extends Model{
    protected $table      = 't_tipo_permisos';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idtipo';
    protected $allowedFields = ['descripcion'];
}