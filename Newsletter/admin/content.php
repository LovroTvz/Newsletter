<?php 
session_start();

if(!isset($_SESSION['current_admin']) ||$_SESSION['logged_in'] !== true){
    header('Location: ../admin.php');
    exit();
}

require_once "../include/database.php";


function dohvati($db_conn){
    if(!is_null($db_conn)){

        $statement = $db_conn->prepare("SELECT * FROM articles 
                                    ORDER BY publish_date
                                    DESC LIMIT 3");
    
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    return [];
}

function izbrisi($id, $db_conn){
    if(!is_null($db_conn)){
        $statement = $db_conn->prepare("DELETE  FROM articles WHERE id = ?");

        $statement->execute([$id]);
    }
}

if(isset($_POST['action']) && $_POST['action'] == 'delete') {
    if(isset($_POST['article_id'])) {
        $articleId = $_POST['article_id'];
        izbrisi($articleId, $db_conn); 
        $articles = dohvati($db_conn); 
        echo json_encode(['success' => true]); 
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Article ID not provided']);
        exit;
    }
}

$articles = dohvati($db_conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News portal | Lovro Buljat</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        .disabled-link{
    pointer-events: none;
    color: grey;
}
    </style>

    <link href="../style.css" rel="stylesheet">
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
        <main class="admin-container">
            
        <form action="">
            <h2>Content</h2>

            <table width=100% class="admin-content">

            <?php foreach ($articles as $key =>$article) :?>
                <tr>
                <td>
                <input type="checkbox" id="checkbox-<?= $article->id ?>" class="article-checkbox" data-article-id="<?= $article->id ?>">
                </td>
                <td>
                    <?= $article->title ?>
                </td>
                <td>
                <?= date("d-m-Y",strtotime($article->publish_date)) ?>
                </td>
                <td>
                <a href="edit-content.php?id=<?= $article->id ?>" class="edit-link disabled-link" id="edit-<?= $article->id ?>">Edit</a>
                </td>
                <td>
                <a href="#" class="delete-link disabled-link" id="delete-<?= $article->id ?>" data-article-id="<?= $article->id ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach ?>
            </table>
        </form><br>
            
        </main>

        <footer class="adminFooter">
            <p style="font-size: 1.5rem; color:black">
                Lovro Buljat, lbuljat@tvz.hr, 2024
            </p>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.article-checkbox');
            
            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const articleId = checkbox.getAttribute('data-article-id');
                    const editLink = document.getElementById('edit-' + articleId);
                    const deleteLink = document.getElementById('delete-' + articleId);
                    
                    if (checkbox.checked) {
                        editLink.classList.remove('disabled-link');
                        deleteLink.classList.remove('disabled-link');
                    } else {
                        editLink.classList.add('disabled-link');
                        deleteLink.classList.add('disabled-link');
                    }
                });
            });
        });

        $(document).ready(function () {
            $('.delete-link').click(function (event) {
                event.preventDefault();
                var articleId = $(this).data('article-id');
                
                if (confirm('Are you sure you want to delete this article?')) {
                    $.ajax({
                        url: '',
                        type: 'POST',
                        data: { action: 'delete', article_id: articleId },
                        success: function () {
                            $('#delete-' + articleId).closest('tr').remove();
                        },
                        error: function (xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });
        </script>
</body>
</html>