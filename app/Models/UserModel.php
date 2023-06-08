<?php

namespace App\Models;

class UserModel
{
    public $db;

    public function __construct(&$db)
    {
        $this->db = $db;
    }


    public function getUserByEmail($email)
    {
        $query   = $this->db->query('SELECT * FROM user');
        $result = $query->getRowArray();
        return $result;
    }
}
