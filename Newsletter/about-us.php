<?php
     require_once "../Newsletter/include/database.php";

     if(!is_null($db_conn)){

        $statement = $db_conn->prepare("SELECT * FROM content");

        $statement->execute();
        $contents = $statement->fetch(PDO::FETCH_OBJ);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter | About us</title>

    <link rel="stylesheet" href="style.css">

    
</head>
<body>
    <?php include("include/header.php");?>

    <main class="container">
        <p style="font-size: 2rem;"><?php echo $contents->aboutUs ?></p>
    </main>

    <?php include("include/footer.php");?>
    
</body>
</html>