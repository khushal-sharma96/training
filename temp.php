<?php
    class Prent{
        protected $admin;
    }
    class chld extends Prent{
        public function __construct(){
            $this->admin="KS";
            echo $this->admin;
        }
    }
    $obj=new chld();
?>