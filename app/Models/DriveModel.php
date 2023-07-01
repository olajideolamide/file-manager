<?php

namespace App\Models;

use \Config\MimesIcons;
use \Config\FileTypes;

class DriveModel
{
    public $db;

    public function __construct(&$db)
    {
        $this->db = $db;
    }


    public function create($data)
    {
        $builder = $this->db->table('file');
        $builder->insert($data);
        return $this->db->insertID();
    }

    public function update($id, $data)
    {
        $builder = $this->db->table('file');
        $builder->set($data);
        $builder->where('id', $id);
        $builder->update();
        return;
    }


    public function createFolder($data)
    {
        $builder = $this->db->table('file');
        $builder->insert($data);

        return $this->db->insertID();
    }

    public function path($id)
    {
        $path = array();
        $parent_id = $id;
        while (true) {
            $sql = "SELECT id, name, parent_id FROM file WHERE file.id = ?";
            $query = $this->db->query($sql, array($parent_id));
            $file = $query->getRowArray();

            $path[] = $file;
            $parent_id = $file["parent_id"];


            if (empty($file["parent_id"])) break;
        }

        return array_reverse($path);
    }

    public function getFile($id, $prepare = false)
    {

        $sql = "SELECT file.*, user.first_name, p_file.name as parent_name FROM file LEFT JOIN user ON file.user_id = user.id LEFT JOIN file as p_file ON p_file.id = file.parent_id WHERE file.id = ?";

        $query = $this->db->query($sql, array($id));

        if ($prepare === true) return $this->prepareDriveData($query->getResult('array'));
        return $query->getResult('array');
    }




    public function getFileFolderByName($name, $parent = null)
    {


        $sql = "SELECT file.*, user.first_name, p_file.name as parent_name FROM file LEFT JOIN user ON file.user_id = user.id LEFT JOIN file as p_file ON p_file.id = file.parent_id WHERE file.name = ? ";

        $options = array();
        $options[] = $name;

        if (empty($parent)) $sql .= " AND file.parent_id IS NULL";
        else {
            $sql .= " AND file.parent_id = ?";
            $options[] = $parent;
        }


        $query = $this->db->query($sql, $options);
        return $query->getRowArray();
    }

    public function getFolderByName($name, $parent = null)
    {


        $sql = "SELECT file.*, user.first_name, p_file.name as parent_name FROM file LEFT JOIN user ON file.user_id = user.id LEFT JOIN file as p_file ON p_file.id = file.parent_id WHERE file.name = ? AND file.type = 'FOLDER' ";

        $options = array();
        $options[] = $name;

        if (empty($parent)) $sql .= " AND file.parent_id IS NULL";
        else {
            $sql .= " AND file.parent_id = ?";
            $options[] = $parent;
        }


        $query = $this->db->query($sql, $options);
        return $query->getRowArray();
    }


    public function getFolders($options, $prepare = false)
    {
        //TODO get is always going to be limited by workspace ID. The workspace ID permission is checked before hitting the model
        //TODO this applies to all the functions in this model
        $query_filters = array();
        $sql = "SELECT file.*, user.first_name FROM file LEFT JOIN user ON file.user_id = user.id WHERE file.type = 'FOLDER'";

        if(!empty($options["parent"])){
            $sql .= " AND file.parent_id = ?";
            $query_filters[] = $options["parent"];
        }else{
            $sql .= " AND file.parent_id IS NULL";
        }

        $sql .= " ORDER BY file.updated_at DESC";

        $query = $this->db->query($sql, array($query_filters));

        if ($prepare === true) return $this->prepareDriveData($query->getResult('array'));
        return $query->getResult('array');
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

        $sql = "SELECT file.*, user.first_name, p_file.name as parent_name FROM file LEFT JOIN user ON file.user_id = user.id LEFT JOIN file as p_file ON p_file.id = file.parent_id WHERE file.user_id = ?";

        if (!empty($search)) {
            $sql .= " AND file.name LIKE '%" . $search . "%'";
        }


        if (empty($search)) {
            if (!empty($parent)) {
                $sql .= " AND file.parent_id = ?";
                $query_filters[] = $parent;
            } else {
                $sql .= " AND file.parent_id IS NULL";
            }
        }

        $sql .= " ORDER BY type DESC";

        if (!empty($sort)) {
            $sql .= ", $sort $dir";
        } else {
            $sql .= ", file.updated_at DESC";
        }



        $query = $this->db->query($sql, $query_filters);


        if ($prepare === true) return $this->prepareDriveData($query->getResult('array'));
        return $query->$query->getResult('array');
    }


    public function prepareDriveData($data)
    {

        $response = array();
        foreach ($data as $i => $row) {
            $icon = MimesIcons::guessIconFromExtension((string) $row["extension"]);


            if (empty($icon)) $icon = "file";
            if ($row["type"] == "FOLDER") $icon = "folder";

            $response[$i]["id"] = $row["id"];
            $response[$i]["name"] = $row["name"];
            $response[$i]["icon"] = "fa-" . $icon;
            if ($row["type"] == "FILE") $response[$i]["size"] = $row["size"];
            $response[$i]["type"] = $row["type"];
            $response[$i]["file_type"] = FileTypes::guessFileTypeFromExtension((string) $row["extension"]);

            if ($response[$i]["file_type"] == "photo") {
                //TODO use the app url
                $response[$i]["thumb_url"] = "/api/photo/thumb/" . $row["id"];
            }

            $response[$i]["extension"] = $row["extension"];
            if ($row["type"] == "FOLDER") $response[$i]["size"] = "11";
            $response[$i]["mime"] = $row["mime"];
            $response[$i]["owner"] = $row["first_name"];
            $response[$i]["parent_id"] = $row["parent_id"];
            $response[$i]["parent_name"] = !empty($row["parent_name"]) ? $row["parent_name"] : "Root";
            $response[$i]["updated_at"] = date("jS M Y", strtotime($row["updated_at"]));
            $response[$i]["created_at"] = date("jS M Y", strtotime($row["created_at"]));
            $response[$i]["hash"] = trim(base64_encode(str_pad($row["id"] . '|', 10, 'padding')), "=");
        }



        return $response;
    }


    /**
     * resolve a path and get the real parent of file.
     * create the folder tree if it does not exist
     */
    public function getRealParent($path, $parent, $queue_id, $user_id)
    {
        $path_array = explode("/", $path);

        if (count($path_array) <= 1) return $parent;

        foreach ($path_array as $key => $node) {
            if ($key === array_key_last($path_array)) return $parent;

            $current_folder = $this->getFolderByName($node, $parent, $queue_id);


            if (empty($current_folder)) {

                //create the folder
                $file_data = array();
                $file_data["name"] = $node;
                $file_data["type"] = "FOLDER";
                $file_data["created_at"] = date("Y-m-d H:i:s");
                $file_data["updated_at"] = date("Y-m-d H:i:s");
                $file_data["user_id"] =  $user_id;
                if (!empty($parent)) $file_data["parent_id"] =  $parent;
                $parent = $this->createFolder($file_data);
            } else {
                $parent = $current_folder["id"];
            }
        }
    }
}
