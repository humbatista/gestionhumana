<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Desvinculacion_Model extends Model{
    protected $table      = 't_cancelacion';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre','cedula','centro_educativo', 'distrito','lugar',
    'puesto','status','telefono', 'fecha', 'fecha_entrega','usuario','fecha_entrada','fecha_salida'];

    public function getbyDistrito($distrito){
        $builder = $this->db->table('t_cancelacion');
        $builder->Where(['distrito' => $distrito]);
        $builder->Where('status !=', 'Aprobada');
        return $builder->get();
    }
}