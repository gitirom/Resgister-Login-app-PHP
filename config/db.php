<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'login-project';

//set DSN - Database Source Name
$dsn = 'mysql:host=' . $host .'; dbname=' . $dbname;

try{
    //creat a PDO connection  instance
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);//set connection with oriented way   // you can with thes oriented object way grup the values like that $user = id , they return the id of the user in the data base
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//set Error to exception mod with oriented way 
   //echo "Connected succesfully ";
} catch(PDOException $e){
    echo"Connection failed: " . $e->getMessage();
}

?>