<?php
require_once "../Newsletter/include/database.php";

if (!is_null($db_conn) && isset($GET['id'])) {
    $id = intval($_GET['id']);

    $statement = $db_conn->prepare("SELECT pictures FROM articles WHERE id = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $article = $statement->fetch(PDO::FETCH_OBJ);

    if ($article && !empty($article->pictures)) {
        header("Content-Type: image/jpeg" );
        echo base64_encode(file_get_contents(addslashes($article->pictures)));
    } else {
        http_response_code(404);
        echo "Imageeeeee is not hereeeeee";
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
}
?>