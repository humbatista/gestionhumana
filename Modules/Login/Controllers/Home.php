<?php

namespace Modules\Login\Controllers;

use App\Controllers\BaseController;
use Modules\Login\Models\Usuario_model;

class Home extends BaseController{

    public function index()
    {
        $mensaje = session('mensaje');
        return view('login', ["mensaje" => $mensaje]);
    }

    public function inicio(){
        return redirect()->to(base_url('solicitudes'));
    }

    public function admin(){
        return redirect()->to(base_url('admin'));
    }
    public function dashboard(){
        return redirect()->to(base_url('empleados/dashboard'));
    }
    public function login(){
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');
        $Usuario = new Usuario_model();

        $datosUsuario = $Usuario->obtenerUsuario(['username' => $usuario]);

        if (count($datosUsuario) > 0 && password_verify($password, $datosUsuario[0]['password'])) {
            $data = [
                        "usuario" => $datosUsuario[0]['username'],
                        "nombre" => $datosUsuario[0]['name'],
                        "type" => $datosUsuario[0]['type'],
                        "nivel" =>$datosUsuario[0]['nivel'],
                        "distrito" => $datosUsuario[0]['distrito_id'],
                        "empleado" => $datosUsuario[0]['empleado'],
                    ];
            $session = session();
            $session-> set($data);
            
            if ($datosUsuario[0]['type'] === 'A'){
                return redirect()->to(base_url('/administrador'))->with('mensaje','1');
            } elseif ($datosUsuario[0]['type'] === 'U') {
                return redirect()->to(base_url('/inicio'))->with('mensaje','1');
                } elseif ($datosUsuario[0]['type'] === 'T')   {
                    return redirect()->to(base_url('/dashboard'))->with('mensaje','1');
                } else {
                    return redirect()->to(base_url('/'))->with('mensaje','0');
                }
        } else return redirect()->to(base_url('/'))->with('mensaje','0');
    }
    public function salir() {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
