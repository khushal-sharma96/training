<?php

class DB{
    private $con;
    private $table= NULL;
    public function __construct($table = NULL){
        try{
			if($table){
				$this->table = $table;
			}
            $this->con=new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASSWORD);
            $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                die();
            }
    }
/*--------------------------------------Verify Email-----------------------------------*/
        /**
         * Undocumented function
         *
         * @param [type] $table
         * @param [type] $email
         * @return void
         */
    public function verifyEmail($email){
        $sql="select * from $this->table where email=?";
        $stmt=$this->con->prepare($sql);
        $stmt->bindValue(1,$email);
        $result=$stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($rows){
            return 1;
        }
        else{
            return 0;
        }
    }
/*--------------------------------------Insert-----------------------------------*/
        /**
         * Undocumented function
         *
         * @param [type] $table
         * @param [type] $data
         * @return void
         */
    public function insertData($data){
        try{
            $sql="insert into $this->table (";
            $fields=array_keys($data);
            $sql.=implode(",",$fields);
            $sql.=") values (";
            $count=0;
            foreach($data as $field=>$value){
                $count++;
                $sql.="?";
                if($count!==count($data))
                $sql.=", ";
            }
            $sql.=" )";
 
            $stmt=$this->con->prepare($sql);
            $count=1;
            foreach(array_values($data) as $value ){
                $stmt->bindValue($count,$value);
                $count++;
            }
            $result = $stmt->execute();
            if($result){
                return ["status"=>1,"msg"=>"Data Inserted Successfully."];
            }
            else{
                return ["status"=>0,"msg"=>"Error in Data Insertion."];
            }
        }
        catch(PDOException $e) {
            echo "Something went wrong in Insertion Process: " . $e->getMessage();
            die();
        }
    }


/*--------------------------------------Select-----------------------------------*/
        /**
         * Undocumented function
         *
         * @param [type] $table
         * @param array $data
         * @param array $condition
         * @return void
         */
    public function getData($data=[],$condition=[]){
		//print_r($condition);
        try {
            $sql="SELECT ";
            $count=0;
            if(count($data)){
                foreach(($data) as $column){
                    $count++;
                    $sql.="$column";
                    if(count($data)!=$count){
                        $sql.=", ";
                    }
                }
            }
            else{
                $sql.="* ";
            }
            $sql.=" from $this->table";
            if(count($condition)){
                $sql.=" where ";
                $count=0;
                foreach($condition as $column=>$value){
                    $count++;
                    if(gettype($value)=="string")
                    $sql.=$column."="."? ";
                    else
                    $sql.=$column."="."? ";
                    if(count($condition)!=$count){
                        $sql.="And ";
                    }
                }
            }
            $stmt=$this->con->prepare($sql);
            if(count($condition)){
                $count=0;
                foreach($condition as $column=>$value){
                    $count++;
                    $stmt->bindValue($count, $value);
                }
            }
            $stmt->execute();
            // set the resulting array to associative
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($result){
				//sprint_r($result);
				if(count($result)==1)
						return ["status"=>1,"info"=>$result];
				
                return ["status"=>1,"Data"=>$result];
			}
            else{
                return ['status' => false, "message" => "User Not found!" ]; //"$this->con->error"
            }
        }
           catch(PDOException $e) {
             echo "Select Query failed !: " . $e->getMessage();
           }
           $con= null;
    }
/*--------------------------------------Delete-----------------------------------*/
        /**
         * Undocumented function
         *
         * @param [type] $table
         * @param [type] $condition
         * @return void
         */
    public function deleteData( $condition){
        $sql="Delete from $this->table ";
        if(count($condition)){
            $sql.=" where ";
            $colum=array_keys($condition);
            $count=0;
            foreach($colum as $field){
                $count++;
                $sql.="$field=?";
                if($count!=count($colum))
                $sql.=", ";
            }
            $stmt=$this->con->prepare($sql);
            $values=array_values($condition);
            print_r($values);
            $count=0;
            foreach($values as $value){
                $count++;
                $stmt->bindValue($count,$value);
            }
        }
        try{
            $result=$stmt->execute();
            return ["status"=>true,"message"=>"Data deleted successfully :)"];
        }
        catch(PDOException $e){
            return["status"=>false,"message"=>"Errroorr: in Deletion"];
        }
        
    }
/*----------------------------Update -------------------------*/
        /**
         * Undocumented function
         *
         * @param [type] $table
         * @param [type] $userData
         * @param [type] $newData
         * @return void
         */
public function updateData( $userData,$newData){
    $sql="update $this->table set ";
    $count=0;
    foreach($newData as $colm=>$value){
        $sql.="$colm=?";
        $count++;
        if($count!=count($newData)){
            $sql.=", ";
        }
    }
    $sql.="where ";
    $count=0;
    foreach($userData as $colm=>$value){
        $sql.=" $colm=?";
        $count++;
        if($count!=count($userData))
            $sql.=" And ";
    }
    $stmt=$this->con->prepare($sql);
    $count=1;
    //.........for newData
    foreach($newData as $colm =>$value){
        $stmt->bindValue($count,$value);
        $count++;
    }
    foreach($userData as $colm =>$value){
        $stmt->bindValue($count,$value);
        $count++;
    }
    try{
        $stmt->execute();
        return["status"=>true,"message"=>"Data updated successfully."];
    }
    catch(PDOException $err){
        echo $err->getMessage();
        return["status"=>false,"message"=>"Error in deletion process "];
    }
}
}