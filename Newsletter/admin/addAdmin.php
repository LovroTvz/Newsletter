<?php 
session_start();

if(!isset($_SESSION['current_admin']) ||$_SESSION['logged_in'] !== true){
    header('Location: ../admin.php');
    exit();
}

require_once "../include/database.php";

function dohvati($db_conn){
    if(!is_null($db_conn)){

        $statement = $db_conn->prepare("SELECT * FROM admins ");
    
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    return [];
}


function unesi($name, $email, $pass, $db_conn){
        if(!is_null($db_conn)){
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            $statement = $db_conn->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
            $statement->execute([$name, $email, $hashed_password]);
        }
    }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'add_admin') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    unesi($name, $email, $password, $db_conn);
}

$admins = dohvati($db_conn);

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

   <style>
        .disabled-link{
    pointer-events: none;
    color: grey;
}</style>

   <script>

        $(function(){
            $("form[name='adminUnos']").validate({
                rules:{
                    name:{
                        required:true,
                        minlength: 5
                    },
                    email:{
                        required: true,
                        email:true
                    },
                    password:{
                        required: true,
                        minlength: 8
                    }
                },
                messages:{
                    name:{
                        required:"Potrebno je unijeti ime",
                        minlength: "Duzina veca od 5"
                    },
                    email:{
                        required: "Potrebno je unijeti email",
                        email: "Potrebno je unijeti email"
                    },
                    password:{
                        required: "Potrebno je unijeti sifru",
                        minlength: "Duzina veca od 8"
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
        <h2>Add admin</h2>
           <form action="" method="post" name="adminUnos" class="addAdmin">
                <div class="inputField">
                    <div class="field">
                        <label for="name">Name:</label><br>
                        <input type="text" name="name" id="name"><br>
                    </div>
                    <div class="field">
                        <label for="email">Email:</label><br>
                        <input type="email" name="email" id="email">
                    </div>
                </div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password"><br>
                <input type="hidden" name="action" value="add_admin">
                <button type="submit">Add admin</button>

           </form>
           <hr>
           <table width=100% class="admin-content">
           <?php foreach ($admins as $key =>$admin) :?>
            <tr>
            <td>
                
                <td><?= $admin->name ?></td>
                <td><?= date("d-m-Y",strtotime($admin->date_creation)) ?></td>
                
            </tr>
            <?php endforeach ?>
           </table>
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
                    
                    if (checkbox.checked) {
                        editLink.classList.remove('disabled-link');
                    } else {
                        editLink.classList.add('disabled-link');
                    }
                });
            });
        });
        </script>
</body>
</html>