<?php
require_once './app/models/user.model.php';
require_once './app/controllers/api.controller.php';

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

class AuthApiController extends ApiController {
    private $model;

    public function __construct() {
        parent::__construct();

        $this->model = new UserModel();
    }

    public function getToken($params = null) {
        // Obtener "Basic base64(user:pass)
        $basic = $this->helper->getAuthHeader();
    
        if(empty($basic)){
            $this->view->response(MSG_ERROR_NOT_AUTHORIZED, 401);
            return;
        }
        $basic = explode(" ",$basic); // ["Basic" "base64(user:pass)"]
        if($basic[0]!=BASIC){
            $this->view->response(MSG_ERROR.BLANK_SPACE.BASIC, 401);
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
                ALG => HS256,
                TYP => JWT
            );
            $payload = array(
                ID => ONE,
                NAME => JUAN,
                EXP => time()+3600
            );
            $header = base64url_encode(json_encode($header));
            $payload = base64url_encode(json_encode($payload));
            $signature = hash_hmac(SHA256, "$header.$payload",KEY_SECRET, true);
            $signature = base64url_encode($signature);
            $token = "$header.$payload.$signature";
             $this->view->response($token);
        }else{
            $this->view->response(MSG_ERROR_NOT_AUTHORIZED, 401);
        }
    }


}
