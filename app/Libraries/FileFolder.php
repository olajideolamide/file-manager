<?php

namespace App\Libraries;


class FileFolder
{

    private $id;
    private $name;
    private $file_name;
    private $description;
    private $mime;
    private $created_at;
    private $updated_at;
    private $deleted_at;
    private $user_id;
    private $size;
    private $item_count;
    private $extension;
    private $parent_id;
    private $type;

    private $drive_model;



    public function __construct($id)
    {
        $this->id = $id;
        $db = \Config\Database::connect();
        $this->drive_model = model('DriveModel', true, $db);
    }

    public function getEntry()
    {
        var_dump($this->drive_model->getFile($this->id));
    }
}
