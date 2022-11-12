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
          200 => OK,
          201 => CREATED,
          204 => PAYMENT_REQUIRED,
          400 => BAD_REQUEST,
          401 => UNAUTHORIZED,
          403 => FORBIDDEN,
          404 => NOT_FOUND,
          500 => INTERNAL_SERVER_ERROR
        );
        return (isset($status[$code])) ? $status[$code] : $status[500];
      }
  
}