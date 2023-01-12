<?php 
namespace Modules\Solicitudes\Models;

use CodeIgniter\Model;

class AccionPersonal_Model extends Model{
    protected $table      = 't_accionpersonal';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha', 'nombre_recomendado','cedula_recomendado','tipo_accion',
    'cargo_actual','cargo_propuesto','nombre_sustituido','cedula_sustituido','observacion', 'usuario', 
    'centro_educativo','puesto','distrito', 'status','activa'];

    public function getPension()
    {
        $builder = $this->db->table('t_accionpersonal');
        return $builder->get();
    }

    public function getAccionbyUser($user){
        $builder = $this->db->table('t_accionpersonal');
        return $builder->getWhere(['usuario' => $user]);
    }
    public function getAccionActivas(){
        $builder = $this->db->table('t_accionpersonal');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->where(['nivel !='=> 'A1']);
        $builder->Where(['activa' => 'SI']);
        return $builder->get();
    }

    public function getAccionActivas_A1(){
        $builder = $this->db->table('t_accionpersonal');
        $builder->orderBy('distrito', 'DESC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['activa' => 'SI']);
        return $builder->get();
    }

    public function savePension($data){
        $query = $this->db->table('t_accionpersonal')->insert($data);
        return $query;
    }
 
    public function updatePension($data, $id)
    {
        $query = $this->db->table('t_accionpersonal')->update($data, array('id' => $id));
        return $query;
    }
 
    public function deletePension($id)
    {
        $query = $this->db->table('t_accionpersonal')->delete(array('id' => $id));
        return $query;
    } 

    public function aprobar($id){
        $builder = $this->db->table('t_accionpersonal');
        $builder->set('status', 'Aprobada');
        $builder->where('id', $id);
        $builder->update();
    }

    public function aceptar($id){
        $builder = $this->db->table('t_accionpersonal');
        $builder->set('status', 'Aceptada');
        $builder->where('id', $id);
        $builder->update();
    }

    public function devolver($id){
        $builder = $this->db->table('t_accionpersonal');
        $builder->set('status', 'Devuelta');
        $builder->where('id', $id);
        $builder->update();
    }

    public function rechazar($id){
        $builder = $this->db->table('t_accionpersonal');
        $builder->set('status', 'Rechazada');
        $builder->where('id', $id);
        $builder->update();
    }

    public function enviar($id){
        $builder = $this->db->table('t_accionpersonal');
        $builder->set('status', 'Enviado');
        $builder->where('id', $id);
        $builder->update();
    }

    public function getReporte($user){
        $builder = $this->db->table('t_accionpersonal');
        $builder->orderBy('fecha', 'ASC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['distrito' => $user]);
        $builder->where(['nivel !='=> 'A1']);
        $builder->where(['activa' => 'SI']);
        return $builder->get();
    }
    public function getReporte_A1($user){
        $builder = $this->db->table('t_accionpersonal');
        $builder->orderBy('fecha', 'ASC');
        $builder->Where(['status' => 'Aceptada']);
        $builder->Where(['distrito' => $user]);
        $builder->Where(['activa' => 'SI']);
        return $builder->get();
    }
}