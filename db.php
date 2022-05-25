<?php

class DB{
    public $host = "localhost";  
    public $username = "root";
    public $password = "";
    public $db = "crud18"; 
    public $conn;

  public function __construct()  
    {  
        $this->conn = new mysqli($this->host,$this->username,$this->password,$this->db);
        
//        if($this->conn->connect_errno){
//            die("Connection Failed: ".$this->conn->connect_errno);
//        }
      //  echo "Connected";
    }  
    
//     public function __construct()  
//    {  
//        mysql_connect($this -> host, $this -> username, $this -> password) or die(mysql_error("database"));  
//        mysql_select_db($this -> db) or die(mysql_error("database"));  
//    } 
    
      
//     public function insert($inputData)
//    {
//        $firstName = $inputData['firstName'];
//        $lastName = $inputData['lastName'];
//        $gender = $inputData['gender'];
//        $division = $inputData['division'];
//        $district = $inputData['district'];
//        $thana = $inputData['thana'];
//        $status=$inputData['status'];
//        $email = $inputData['email'];
//        $pwd= $inputData['password'];
//        $password = MD5($pwd);
//        $address = $inputData['address'];
//
//        $insertQuery = "INSERT INTO table(firstName,lastName,gender,division_id,district_id,thana_id,address,status,email,password) VALUES ('$email','$phone','$course')";
//        $result = $this->conn->query($insertQuery);
//        if($result){
//            return true;
//        }else{
//            return false;
//        }
//    }
    
    
    
//    public function select($query){
//        $result=$this->conn->query($query);
//        if($result->num_rows > 0){
//            return $result;
//        }else{
//            return FALSE;
//        }
//        
        
    //}
    
    public function select($columns,$table_name,$condition,$offset,$limit,$join,$orderby)
    {
      $sql2="SELECT ".$columns." FROM ".$table_name." ".$condition." ".$offset." ".$limit." ".$join." ".$orderby; 
      $result2=$this->conn->query($sql2);
      return $result2;
    }
    
    
    
    function delete($table_name,$id){
       $sql="DELETE FROM {$table_name} WHERE id= {$id}";
       $result= mysqli_query($this->conn,$sql);
//       echo "<pre>";
//       print_r($result);
//       exit;
       if(mysqli_query($this->conn,$sql)==TRUE){
           
           echo "new recorded deleted succesfully";
           
           header("Location:../userlist.php");
       }
       else{
           echo "Error: ".$sql."<br>".$this->connect_errno;
       }
    }
    
//    function update($table_name,$id){
//        $sql=""
//    }
//    
}

  




?>