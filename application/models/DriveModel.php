<?php

class DriveModel extends CI_Model
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
    }

    public function create($file_data)
    {
        $this->db->insert('file', $file_data);
        return $this->db->insert_id();
    }


    public function createFolder($data)
    {
        $this->db->insert('file', $data);
        return $this->db->insert_id();
    }




    public function insertClient($data)
    {
    }

    public function getFile($id, $prepare = false)
    {

        try {
            $sql = "SELECT file.*, user.first_name FROM file LEFT JOIN user ON file.user_id = user.id WHERE file.id = ?";

            $query = $this->db->query($sql, array($id));

            if ($prepare === true) return $this->prepareDriveData($query->result_array());
            return $query->result_array();
        } catch (Exception $e) {
            return array();
        }
    }


    public function getDrive($user_id, $options, $prepare = false)
    {

        //sleep(10);
        $sort_options = array("name", "size", "updated_at");
        $sort_dir_options = array("ASC", "DESC");
        $query_filters = array();
        $append_query = array();
        $search = $options['search'];
        $sort = in_array($options['sort'], $sort_options) ? $options['sort'] : null;
        $dir = in_array($options['dir'], $sort_dir_options) ? $options['dir'] : null;
        $parent = $options['parent'];

        $query_filters[] = $user_id;




        try {
            $sql = "SELECT file.*, user.first_name FROM file LEFT JOIN user ON file.user_id = user.id WHERE file.user_id = ?";

            if (!empty($search)) {
                $sql .= " AND name LIKE '%" . $search . "%'";
            }


            if (empty($search)) {
                if (!empty($parent)) {
                    $sql .= " AND parent_id = ?";
                    $query_filters[] = $parent;
                } else {
                    $sql .= " AND parent_id IS NULL";
                }
            }

            $sql .= " ORDER BY type DESC";





            if (!empty($sort)) {
                $sql .= ", $sort $dir";
            }

            $query = $this->db->query($sql, $query_filters);

            if ($prepare === true) return $this->prepareDriveData($query->result_array());
            return $query->result_array();
        } catch (Exception $e) {
            return array();
        }
    }


    public function prepareDriveData($data)
    {

        $this->config->load('mime_icons');

        $response = array();
        foreach ($data as $i => $row) {
            $icon = $this->config->item($row["extension"], 'mime_icons');

            if (empty($icon)) $icon = "file";
            if ($row["type"] == "FOLDER") $icon = "folder";

            $response[$i]["id"] = $row["id"];
            $response[$i]["name"] = $row["name"];
            $response[$i]["icon"] = $icon;
            $response[$i]["size"] = $row["size"];
            $response[$i]["type"] = $row["type"];
            if ($row["type"] == "FOLDER") $response[$i]["size"] = "11";
            $response[$i]["mime"] = $row["mime"];
            $response[$i]["owner"] = $row["first_name"];
            $response[$i]["parent_id"] = $row["parent_id"];
            $response[$i]["updated_at"] = date("jS M Y H:i", strtotime($row["updated_at"]));
        }

        return $response;
    }
}
