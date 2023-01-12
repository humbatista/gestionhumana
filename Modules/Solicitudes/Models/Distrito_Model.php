<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Distrito_Model extends Model{
    public function ObtenerDistrito()
    {
        $builder = $this->db->table('t_distritos');
        return $builder->get();
    }

    protected $table      = 't_distrito';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['distrito_id', 'descripcion', 'id'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}