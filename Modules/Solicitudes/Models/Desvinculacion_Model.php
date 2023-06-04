<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class Desvinculacion_Model extends Model{
    protected $table      = 't_cancelacion';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre','cedula','centro_educativo', 'distrito','lugar',
    'puesto','status','telefono', 'fecha', 'fecha_entrega','usuario','fecha_entrada','fecha_salida','activa'];

    public function getbyDistrito($distrito){
        $builder = $this->db->table('t_cancelacion');
        /* Para trabajar los centros por distrito, descomente la proxima linea de codigo */
        //$builder->Where(['distrito' => $distrito]);
        $builder->Where('status !=', 'Entregada');
        return $builder->get();
    }

    /* listado de estados:
        1. Solicitada
        2. Enviada
        3. Recibida
        4. Entregada */

    public function enviada($id){
        $builder = $this->db->table('t_cancelacion');
        $builder->set('status', 'Enviada');
        $builder->where('id', $id);
        $builder->update();
    }

    public function recibida($id){
        $builder = $this->db->table('t_cancelacion');
        $builder->set('status', 'Recibida');
        $builder->where('id', $id);
        $builder->update();
    }

    public function entregada($id){
        $builder = $this->db->table('t_cancelacion');
        $builder->set('status', 'Entregada');
        $builder->where('id', $id);
        $builder->update();
    }
}