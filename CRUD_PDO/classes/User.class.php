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
/*-------------------------checking the available fields------------------------------*/
    /**
     * Undocumented function
     *
     * @param [type] $list
     * @return Array
     */
    public function checkList($list)
    {
        $columns = ($list);
        $result = "";
        $diff = array_diff($columns, $this->fields);
      
        if ((count($diff)==0)&&(count($list)==count($this->fields))) {

            return ["status"=> true, "message" => "identical"];
        } 
        else if (count($diff)!=0) {
            foreach ($diff as $colm) {
                echo $colm;
                if (!in_array($colm, $this->fields)) {
                    $result .= " $colm";
                }
            }
            // http_response_code(200);
            return ["status" =>  false, "message" => "$result are invalid fields"];
        } else {
            return ["status" => true, "message" => "subArray"];
        }
    }

/*-----------------------------Selection------------------------*/
    /**
     * Undocumented function
     *
     * @param array $data
     * @param array $condition
     * @return void
     */
    public function selectQuery($data = [], $condition = [])
    {	
        $result=$this->checkList($data);
        if( $result["status"]){
            $result=$this->checkList(array_keys($data));
            if($result["status"])
            return $this->db->getData($data, $condition);
            else $result;
        }
        else
        return $result;
    }

    //insertion....................
    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return void
     */
    public function insertQuery($data)
    {
        $verify = $this->checkList(array_keys(($data)));
        if (isset($verify["status"]) && $verify["status"]) {
            if(isset($data["email"])){
                if ($this->db->verifyEmail($data["email"])) {
					http_response_code(422);
                    return ["status" => false, "message" => "email already registered !"];
                }
                $result = $this->db->insertData($data);
				return ["status"=>true,"message"=>"Used added!", "data" => $result];
            }
            else
            return ["status"=>false,"message"=>"Email is mandatory !"];
        } else {
            if(!in_array("email",array_keys($data)))
            return ["status"=>false,"message"=>"Email is mandatory !"];
         
        }
        
    }
/*-----------------------------Deletion------------------------*/
        /**
         * Undocumented function
         *
         * @param array $userData
         * @return void
         */
    public function deleteQuery($userData=[]){
        $verify = $this->checkList(array_keys(($userData)));
        if ($verify["status"]) {
            if(isset($userData["email"])){
                if ($this->db->verifyEmail($userData["email"])) {
                    return $this->db->deleteData($userData);
                }
                return ["status"=>false,"message"=>"User not Found !"];
            }
            else{
                return $this->db->deleteData($userData);
            }
        } 
        else {
            return $verify;
        }
    }
/*-----------------------------Updation------------------------*/
        /**
         * Undocumented function
         *
         * @param [type] $userData
         * @param [type] $newData
         * @return void
         */
    public function updateQuery($userData,$newData){
        $verifyExis = $this->checkList(array_keys(($userData)));
        $verifyNew = $this->checkList(array_keys(($newData)));
        if ($verifyExis["status"]&&$verifyNew["status"]) {
            if(isset($userData["email"])){
                if ($this->db->verifyEmail($userData["email"])) {
                    if(isset($userData["email"])){
                        if($this->db->verifyEmail($newData["email"])){
                            return ["status"=>false,"message"=>"Entered email ID already exist!"];
                        }
                        return $this->db->updateData($userData,$newData);
                    }
                    return $this->db->updateData($userData,$newData);
                }
                return ["status"=>false,"message"=>"User not Found !"];
            }
            else{
                if(isset($newData["email"])){
                    if($this->db->verifyEmail($newData["email"])){
                        return ["status"=>false,"message"=>"Entered email ID already exist!"];
                    }
                    return $this->db->updateData($userData,$newData);
                }
                return $this->db->updateData($userData,$newData);
            }
        } 
        else {
            return $verifyExis;
        }
    }  
}
