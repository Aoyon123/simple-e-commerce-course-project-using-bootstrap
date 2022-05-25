<?php
include 'db/db.php';

//include("./controller/acti")

session_start();

$connect2 = new DB();

$email = $password = "";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $password = MD5($pwd);
    
    $condition = "WHERE email ='$email' AND password ='$password'";
    
    $table_name= "tableuser";
    
    $columns = "email,password"; 
    $result = $connect2->select($columns,$table,$condition,"","","","");
    if ($result->num_rows > 0)
    {
        $_SESSION['email'] = $email;
       
        header("Location: home.php");
    } else 
    {
        echo "Your Id or Password is Incorrect";
        
    }  
}
?>