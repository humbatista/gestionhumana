<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Observacion_Model extends Model{
    protected $table      = 't_obspension';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['idsolicitud','tipo', 'fecha', 'observacion', 'usuario'];

    public function getObservacion($id, $tipo){
        $builder = $this->db->table('t_obspension');
        $builder->Where(['idsolicitud' => $id]);
        $builder->Where(['tipo' => $tipo]);
        return $builder->get();

    }

}