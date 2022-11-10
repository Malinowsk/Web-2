<?php
require_once './app/models/user.model.php';
require_once './app/controllers/api.controller.php';

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

class AuthApiController extends Controller {
    private $model;

    public function __construct() {
        parent::__construct();

        $this->model = new UserModel();
    }

    public function getToken($params = null) {
        // Obtener "Basic base64(user:pass)
        $basic = $this->helper->getAuthHeader();
    
        if(empty($basic)){
            $this->view->response('No autorizado', 401);
            return;
        }
        $basic = explode(" ",$basic); // ["Basic" "base64(user:pass)"]
        if($basic[0]!="Basic"){
            $this->view->response('La autenticación debe ser Basic', 401);
            return;
        }

        //validar usuario:contraseña
        $userpass = base64_decode($basic[1]); // user:pass
        $userpass = explode(":", $userpass);
        $user = $userpass[0];
        $pass = $userpass[1];

        $record=$this->model->getUserByEmail($user);

        if($record && $user == $record->email && password_verify($pass,$record->password)){
            //  crear un token
            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            $payload = array(
                'id' => "1",
                'name' => "Juan",
                'exp' => time()+3600
            );
            $header = base64url_encode(json_encode($header));
            $payload = base64url_encode(json_encode($payload));
            $signature = hash_hmac('SHA256', "$header.$payload", "Clave1234", true);
            $signature = base64url_encode($signature);
            $token = "$header.$payload.$signature";
             $this->view->response($token);
        }else{
            $this->view->response('No autorizado', 401);
        }
    }


}
