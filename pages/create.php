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


if ($_POST["name"] != "" && $_POST["date"] != "") {
    try {
    
        // Zet de query klaar door middel van de prepare method
        $stmt = $conn->prepare("INSERT INTO `birthdays`(`name`, `date`) VALUES (:names,:dates)");
        $stmt->bindParam(":names", $_POST["name"]);
        $stmt->bindParam(":dates", $_POST["date"]);
 
        // Voer de query uit
        $stmt->execute();
 
    }
    // Vang de foutmelding af
    catch(PDOException $e){
        // Zet de foutmelding op het scherm
        echo "Connection failed: " . $e->getMessage();
    }
    header('Location: ../');
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthday calender</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
</head>
<body>
    <div id="page">
        <h1 id="title">Birthday Calender</h1>
        <nav>
        <a href="../">home</a>
        <a href="">add</a>
        </nav>
        <div id="cardCenter">
            <form action="" method="post">
                <label for="name">Name : </label> <br>
                <input id="name" type="text" name="name"value=""> <br> <br>

                <label for="date">date : </label> <br>
                <input id="date" type="date" name="date"value=""> <br> <br>

                <input type="submit" value="submit">
            </form>
        </div>
    </div>
</body>
</html>