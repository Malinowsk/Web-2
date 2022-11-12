<?php

require_once './app/views/api.view.php';
require_once './app/helpers/auth-api.helper.php';
require_once './app/constantes/constantes.php';

class ApiController
{
    protected $view;
    protected $helper;
    private $data;

    function __construct()
    {
        $this->view = new ApiView();
        $this->helper = new AuthApiHelper();
        $this->data = file_get_contents(PHP_INPUT);
    }

    function getData()
    {
        return json_decode($this->data);
    }

}