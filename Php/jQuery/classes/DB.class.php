<?php

class DB
{
    private $con;
    private $table = NULL;
    public function __construct($table = NULL)
    {
        try {
            if ($table) {
                $this->table = $table;
            }
            $this->con = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public function searchName($userName)
    {
        if ($userName) {
            $sql = 'select * from ' . $this->table . ' where name like "%' . $userName . '%"';

            try {
                $stmt = $this->con->prepare($sql);
                // echo $userName;
                // $stmt->bindValue(1, $userName);
                // echo $sql;
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($stmt->rowCount())
                    return ['status' => true, 'data' => $result];
                else
                    return ['status' => false, 'message' => 'No such User Found'];
            } catch (PDOException $e) {
                return ['status' => false, 'message' => $e->getMessage()];
            }
        } else {
            return ['status' => false, 'message' => 'No such User Found'];
        }
    }

    public function upload($image)
    {
        $targetDir = __DIR__ . '/images';
        if (!file_exists($targetDir)) {
            mkdir($targetDir);
        }
        //print_r($image);
        $fileUpload = move_uploaded_file($image['tmp_name'], $targetDir . "/" . $image['name']);
        if ($fileUpload)
            return ['status' => true, 'message' => $image['name'] . ' uploaded successfully.'];
        else
            return ['status' => false, 'message' => 'Something went wrong'];
    }
}
