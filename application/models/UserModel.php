<?php

class UserModel extends CI_Model
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        // Call the parent constructor
        parent::__construct();
    }

    public function getUser($id)
    {
        try {
            $sql = "SELECT user.* FROM user WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        } catch (Exception $e) {
            return array();
        }
    }

    public function getUserByEmail($email)
    {
        try {
            $sql = "SELECT user.* FROM user WHERE email = ?";
            $query = $this->db->query($sql, array($email));
            return $query->row_array();
        } catch (Exception $e) {
            return array();
        }
    }
}
