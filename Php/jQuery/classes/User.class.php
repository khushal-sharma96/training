<?php

class User
{
    private $db;
    private $table = 'users';
    private  $fields = array("name", "password", "email");
    public function __construct()
    {
        $this->db = new DB($this->table);
    }
    public function searchUser($userName = "")
    {
        if ($userName) {
            return $this->db->searchName($userName);
        } else {
            return ['status' => false, 'message' => 'No such user found'];
        }
    }

    public function uploadFile($image)
    {
        return $this->db->upload($image);
    }

    public function getImage()
    {
        try {
            $path = '/images/ks.jpg';
            $image = 'http://192.168.1.20/Training/Php/jQuery/classes' . $path;
            return $image;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
    public function downloadImage()
    {
        $targetImage = __DIR__ . '/images/ks.jpg';
        header('Content-Type: image/jpeg');
        header('Content-Disposition: attachment; filename="downloaded_image.jpg"');
        header('Cache-Control: must-revalidate');
        header('Pragma: private');
        header('Content-Length: ' . filesize($targetImage));
        return file_get_contents($targetImage);
    }
}
