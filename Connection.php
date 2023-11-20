<?php
define("SERVER","localhost");
define("DB_NAME","employeeDB");
define("PASS","");
define("USER","root");
define("TABLE","employeeData");

class DbConn{
  public $conn;
  public function getAccess(){
    $conn=mysqli_connect(SERVER,USER,PASS,DB_NAME);
    return $conn;
  }
}


  class Insertion extends DbConn{
    public function __construct(){
      $conn=mysqli_connect(SERVER,USER,PASS,DB_NAME);
      
        if(!$conn){
          die("Something went wrong in connection with database!!");
        }
    }

    public function insertData($fname,$lname,$age,$gender,$address){
      $this->conn=$this->getAccess();
      $result=mysqli_query($this->conn,"insert into employeeData (fname,lname,age,gender,address) values('$fname','$lname',$age,'$gender','$address');");
      return $result;
    }
  }

  class FetchAll extends DbConn{
      public function __construct(){
        $conn=mysqli_connect(SERVER,USER,PASS,DB_NAME);
        
          if($conn){
            echo "Connected With Database Successfully.";
          }
          else{
            die("Something went wrong in connection with database!!");
          }
      }

    //Fetching Whole Data....................
    public function fetchData(){
      $this->conn=$this->getAccess();
      $result=mysqli_query($this->conn,"select * from TABLE");
      return $result;
    }
  }
  class FetchOne extends DbConn{
      public function __construct(){
        $conn=mysqli_connect(SERVER,USER,PASS,DB_NAME);
        
          if($conn){
            echo "Connected With Database Successfully.";
          }
          else{
            die("Something went wrong in connection with database!!");
          }
      }

    //Fetching Whole Data....................
      public function fetchData($userID){
        $this->conn=$this->getAccess();
        $result=mysqli_query($this->conn,"select * from TABLE where userID=$userID");
        return $result;
      }
  }
  class DeleteAll extends DbConn{
    public function __construct(){
      $conn=mysqli_connect(SERVER,USER,PASS,DB_NAME);
      
        if($conn){
          // echo "Connected With Database Successfully.";
        }
        else{
          die("Something went wrong in connection with database!!");
        }
    }

  //Deleting Whole Data....................
    public function deleteData(){
      $this->conn=$this->getAccess();
      $result=mysqli_query($this->conn,"delete from employeeData");
      return $result;
    }
  }

  class DeleteOne extends DbConn{
    public function __construct(){
      $conn=mysqli_connect(SERVER,USER,PASS,DB_NAME);
      
        if($conn){
          echo "Connected With Database Successfully.";
        }
        else{
          die("Something went wrong in connection with database!!");
        }
    }

  //Deleting One Record....................
    public function deleteData($userID){
      $this->conn=$this->getAccess();
      $table=TABLE;
      $result=mysqli_query($this->conn,"delete from $table where userID=$userID");
      return $result;
    }
  }

class UpdateData extends DbConn{
  public function __construct(){
    $conn=mysqli_connect(SERVER,USER,PASS,DB_NAME);
    
      if($conn){
        echo "Connected With Database Successfully.";
      }
      else{
        die("Something went wrong in connection with database!!");
      }
  }
  public function updateData($userID){
    $this->conn=$this->getAccess();
    $table=TABLE;
    $result=mysqli_query($this->conn,"update $table set fname='$fname',lname='$lname',age=$age,gender='$gender',address='$address' where userID=$userID");
      return $result;
  }
}
?>
