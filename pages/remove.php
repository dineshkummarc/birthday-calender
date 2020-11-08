<?php

$servername = 'localhost';
$database = 'birthdaycalender';
$username = 'root';
$password = '';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    try {
    
        // Zet de query klaar door middel van de prepare method
        $stmt = $conn->prepare("DELETE FROM `birthdays` WHERE id=:id");
        $stmt->bindParam(":id", $_GET["id"]);
 
        // Voer de query uit
        $stmt->execute();
 
    }
    // Vang de foutmelding af
    catch(PDOException $e){
        // Zet de foutmelding op het scherm
        echo "Connection failed: " . $e->getMessage();
    }
    header('Location: ../');
?>