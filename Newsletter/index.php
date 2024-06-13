<?php 
    require_once "../Newsletter/include/database.php";

    if(!is_null($db_conn)){

        $pg_limit = 3;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        $start_point = ($page - 1) * $pg_limit;

        $stmt = $db_conn->prepare("SELECT * FROM articles");
        $stmt->execute();
        $total_articles = $stmt->rowCount();

        $number_of_pages = ceil($total_articles / $pg_limit);


        $statement = $db_conn->prepare("SELECT * FROM articles 
                                    ORDER BY id
                                    DESC LIMIT $start_point, $pg_limit");

        $statement->execute();
        $articles = $statement->fetchAll(PDO::FETCH_OBJ);
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
        <section class="articles">

        <?php 
            foreach($articles as $key => $article){
                print '<article>
                <img src="./images/'.$article->pictures.'">
                <div class="news_display">
                    <h1><a href="single.php?id='.$article->id.'">'.$article->title.'</a></h1>
                    <p>'.$article->excerpt.'</p>
                    <time>Published on '.date("d-m-Y",strtotime($article->publish_date)).' by '.$article->author.'</time>
                </div>
            </article>';
            };
        ?>
        </section>

        <nav class="pagination">
            <ul>

            <?php if($page >1) :?>
                <li><a href="index.php?page=<?php echo ($page - 1); ?>">&laquo; Prev.</a></li>
                <?php endif ?>
                <?php for($i = 1; $i <= $number_of_pages; $i++) : ?>
                <li><a href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor ?>

                <?php if ($page < $number_of_pages) : ?>
                <li><a href="index.php?page=<?php echo ($page + 1); ?>">Next &raquo;</a></li>
                <?php endif ?>
            </ul>
        </nav>
    </main>

    <?php include("include/footer.php");?>
</body>
</html>