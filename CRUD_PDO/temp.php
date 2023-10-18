<?php
// try{
//     $user="root";
//     $password="";
//     $server = "mysql:host=localhost;dbname=userdb";
//     echo "from constructor";
//     $con=new PDO($server,$user,$password);
//     $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//     echo "Connection Successfull with Database: ";
//     }
// catch(PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
//     die();
//     }

    
    // $query = "INSERT INTO students (fullname, email, phone, course) VALUES (?, ?, ?, ?)";
    //     $statement = $conn->prepare($query);
    //     $statement->bindParam(1, $fullname);
    //     $statement->bindParam(2, $email);
    //     $statement->bindParam(3, $phone);
    //     $statement->bindParam(4, $course);
    //     $query_execute = $statement->execute();


    // public function getData($table,$data=[],$condition=[]){
    //     try {
    //         $sql="SELECT ";
    //         $count=0;
    //         if(count($data)){
    //             foreach($data as $column){
    //                 $count++;
    //                 $sql.="$column ";
    //                 if(count($data)!=$count){
    //                     $sql.=", ";
    //                 }
    //             }
    //         }
    //         else{
    //             $sql.="* ";
    //         }
           
    //         if(count($condition)){
    //             $sql.=" where";
    //             $count=0;
    //             foreach($condition as $column=>$value){
    //                 $count++;
    //                 if(gettype($value)=="string")
    //                 $sql.=$column."="."'$value' ";
    //                 else
    //                 $sql.=$column."=".$value;

    //                 if(count($data)!==$count){
    //                     $sql.="And ";
    //                 }
    //             }
    //         }
    //         $sql.="from $table";
            
    //         $stmt = $this->con->prepare($sql);
    //         $stmt->execute();
            
    //         // set the resulting array to associative
    //         $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    //         if($result)
    //             return ["status"=>1,"Data"=>$result];
    //         else{
    //             return ['status' => false, "message" => $this->con->error ];
    //         }
    //       } 
    //       catch(PDOException $e) {
    //         echo "Select Query failed !: " . $e->getMessage();
    //       }
    //       $con= null;
    // }

$array=["name"=>"ks","rollno"=>19];
$arr=array_keys($array);
print_r($arr);