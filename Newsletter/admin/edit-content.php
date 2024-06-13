<?php 
session_start();

if(!isset($_SESSION['current_admin']) ||$_SESSION['logged_in'] !== true){
    header('Location: ../admin.php');
    exit();
}

$article_id = (int)$_GET['id'];
require_once "../include/database.php";

if(!is_null($db_conn)){

    $statement = $db_conn->prepare("SELECT * FROM articles 
                                    WHERE id = ?");

    $statement->execute([$article_id]);
    $the_article = $statement->fetch(PDO::FETCH_OBJ);
}

if(isset($_POST) && count($_POST) > 0){

    require_once "../include/database.php";
    
   $title = $_POST['title'];
   $postDescr = $_POST['postDesc'];
   $path = $_POST['postImage'];
   $text = $_POST['postText'];
    
   if(!is_null($db_conn)){

    $insert = $db_conn->prepare("UPDATE articles SET title = ?, excerpt = ?, content = ?, author = ?, pictures = ? WHERE id = ?");
    
    $insert->execute([$title, $postDescr, $text, $_SESSION['current_admin']->name, $path, $article_id]);
    if($insert){
        if(!is_null($db_conn)){

            $statement = $db_conn->prepare("SELECT * FROM articles 
                                            WHERE id = ?");
        
            $statement->execute([$article_id]);
            $the_article = $statement->fetch(PDO::FETCH_OBJ);
        }
    }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News portal | Lovro Buljat</title>

    <link href="../style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
   <script src="js/form-validation.js"></script>

   <script>

        $(function(){
            $("form[name='edit']").validate({
                rules:{
                    title:{
                        required:true,
                        minlength: 5
                    },
                    postDec:{
                        required: true,
                        minlength: 10
                    },
                    postImage:{
                        required: true
                    },
                    postText:{
                        required: true,
                        minlength: 20
                    }
                },
                messages:{
                    title:{
                        required:"Potrebno je unijeti naslov",
                        minlength: "Duzina veca od 5"
                    },
                    postDec:{
                        required: "Potrebno je unijeti opis",
                        minlength: "Duzina veca od 10"
                    },
                    postImage:{
                        required: "Potrebno je odabrati sliku"
                    },
                    postText:{
                        required: "Potrebno je unijeti tekst clanka",
                        minlength: "Duzina veca od 20"
                    },
                }, submitHandler: function(form){
                    form.submit();
                }
            })
        })
   </script>
</head>
<body>
    <!--Nav-->
    <header class="admin-header">
        <a href="admin-dashboard.php"><h1>Newsletter</h1></a>
        <div class="adminHeader">

            <nav class="admin-menu">
                <ul>
                    <li>
                        <a href="">Manage</a>
                    <ul>
                        <a href="content.php"><li>Content</li></a>
                        <a href="addAdmin.php"><li>Administrators</li></a>
                        </ul>
                    </li>
                </ul>
            </nav>


<aside>
    <nav>
    <ul class="welcome">
            <li><?php echo $_SESSION['current_admin']->name; ?></li>
            <a href="logout.php"><li>Sign out</li></a>
        </ul>
    </nav>
</aside>
</div>
</header>
        <main class="container">
            <form action="" method="post" name="edit"class="savePost">
                <h2><?= $the_article->title ?></h2>

                <label>Post title:</label><br>
                <input type="text" name="title" id="title" value="<?= $the_article->title ?>"><br>

                <label>Post description:</label><br>
                <input type="text" name="postDesc" id="postDesc" value="<?= $the_article->excerpt ?>">

                <label for="">Post image:</label><br>
                <input type="file" name="postImage" id="postImage" value="<?= $the_article->pictures ?>">

                <label for="">Post text:</label><br>
                <textarea name="postText" id="postText"><?= $the_article->content ?></textarea><br>
                <button type="submit">Edit post</button>

            </form>
        </main>

        <footer class="adminFooter">
        <p style="font-size: 1.5rem; color:black">
                Lovro Buljat, lbuljat@tvz.hr, 2024
            </p>
        </footer>
</body>
</html>