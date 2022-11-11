<?php

require_once './app/views/api.view.php';
require_once './app/helpers/auth-api.helper.php';

abstract class ApiController
{
    protected $view;
    protected $helper;
    private $data;

    function __construct()
    {
        $this->view = new ApiView();
        $this->helper = new AuthApiHelper();
        $this->data = file_get_contents('php://input');
    }

    function getData()
    {
        return json_decode($this->data);
    }

}