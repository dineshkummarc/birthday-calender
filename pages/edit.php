<?php 

$servername = 'localhost';
$database = 'database';
$username = 'root';
$password = 'mysql';
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
        $stmt = $conn->prepare("UPDATE `birthdays` SET `name`=:names,`date`=:dates WHERE id=:id");
        $stmt->bindParam(":names", $_POST["name"]);
        $stmt->bindParam(":dates", $_POST["date"]);
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
} 



try {

    // Zet de query klaar door midel van de prepare method. Voeg hierbij een
     
    $stmt = $conn->prepare("SELECT * FROM birthdays where id=:id");
    $stmt->bindParam(":id", $_GET["id"]);

    // Voer de query uit
    $stmt->execute();

    // Haal alle resultaten op en maak deze op in een array
    // In dit geval weten we zeker dat we maar 1 medewerker op halen (de where clause), 
    //daarom gebruiken we hier de fetch functie.
    $result = $stmt->fetch();
    

}
catch(PDOException $e){

    echo "Connection failed: " . $e->getMessage();
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
                <input id="name" type="text" name="name"value="<?= $result["name"]; ?>"> <br> <br>

                <label for="date">date : </label> <br>
                <input id="date" type="date" name="date"value="<?= $result["date"]; ?>"> <br> <br>

                <input type="submit" value="submit">
            </form>
        </div>
    </div>
</body>
</html>