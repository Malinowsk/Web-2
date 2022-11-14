<?php
require_once './app/constantes/constantes.php';

class ApiView {

    public function response($data, $status = 200) {
        header(CONTENT_TYPE);
        header(HEDER_HTTP . $status . BLANK_SPACE . $this->_requestStatus($status));
        
        // convierte los datos a un formato json
        echo json_encode($data);
    }

    private function _requestStatus($code){
        $status = array(
          200 => OK, // se ejecuto correctamente
          201 => CREATED, // se ejecuto correctamente el insert
          204 => PAYMENT_REQUIRED,// no lo uso , pero es para indicar que la respuesta fue exitosa pero no posee contenido
          400 => BAD_REQUEST,
          401 => UNAUTHORIZED, // el request no ah sido ejecutado porque carece de credenciales validas de autenticacion
          403 => FORBIDDEN, // prohibido (se quien eres)
          404 => NOT_FOUND,
          500 => INTERNAL_SERVER_ERROR // error del lado del servidor
        );
        return (isset($status[$code])) ? $status[$code] : $status[500];
      }
  
}