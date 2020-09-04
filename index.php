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

try {

    // Zet de query klaar door midel van de prepare method. Voeg hierbij een
     
    $stmt = $conn->prepare("SELECT * FROM birthdays ORDER BY `date` desc");
    

    // Voer de query uit
    $stmt->execute();

    // Haal alle resultaten op en maak deze op in een array
    // In dit geval weten we zeker dat we maar 1 medewerker op halen (de where clause), 
    //daarom gebruiken we hier de fetch functie.
    $result = $stmt->fetchall();
    

}
catch(PDOException $e){

    echo "Connection failed: " . $e->getMessage();
}
// Maak de database verbinding leeg. Dit zorgt ervoor dat het geheugen
// van de server opgeschoond blijft
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthday calender</title>
    <link rel="stylesheet" href="styles/style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
</head>
<body>
    <div id="page">
        <h1 id="title">Birthday Calender</h1>
        <nav>
        <a href="">home</a>
        <a href="pages/create.php">add</a>
        </nav>
        <?php foreach($result as $birthday) { ?>
            <div class="card">
                <h1><?= $birthday["name"]; ?></h1>
                <h3><?= $birthday["date"];?></h3>
                <a href="pages/edit.php?id=<?= $birthday["id"]; ?>">edit</a>
                <a href="pages/remove.php?id=<?= $birthday["id"]; ?>">remove</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>