<?php


class BaseModel
{
    protected $db;
    protected $user_role;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->user_role  = $_SESSION['user']['user_role'];
    }
}