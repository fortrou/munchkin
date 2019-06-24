<?php


abstract class BaseController
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    abstract public function init_work();
}