<?php

    $article_id = (int)$_GET['id'];

    require_once "../Newsletter/include/database.php";

    if(!is_null($db_conn)){

        $statement = $db_conn->prepare("SELECT * FROM articles 
                                        WHERE id = ?");

        $statement->execute([$article_id]);
        $the_article = $statement->fetch(PDO::FETCH_OBJ);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News portal | Lovro Buljat</title>

    <link href="style.css" rel="stylesheet">
</head>
<body>
   <!--Nav-->
   <?php include("include/header.php"); ?>
    <!--Content-->
    <main class="container">
        <section>
         
        <article>
                <img src= "images/<?= $the_article->pictures ?>"><br>
                <time>Published <?= date("d-m-Y", strtotime($the_article->publish_date)) ?> by <?= $the_article->author ?></time>
                </div>
                <div class="single_display">
                    <h1><?= $the_article->title ?></h1>
                    <p><?= $the_article-> content?></p>
                    
                </div>
            </article>
        </section>


    </main>

    <?php include("include/footer.php");?>
</body>
</html>