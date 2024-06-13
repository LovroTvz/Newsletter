<?php 
session_start();

echo password_hash('MatijaCvek', PASSWORD_DEFAULT);

 $invalid = "";
    if(isset($_POST) && count($_POST) > 0){

        require_once "../Newsletter/include/database.php";
        
        $email = $_POST['email1'];
        $password = $_POST['password1'];

        

        if(!is_null($db_conn)){

            $get_email = $db_conn->prepare("SELECT * FROM admins WHERE email = ?");
            
            $get_email->execute([$email]);

            $admin = $get_email->fetch(PDO::FETCH_OBJ);


            if($admin){

               if(password_verify($password, $admin->password)){

                $_SESSION['current_admin'] = $admin;
                $_SESSION['logged_in'] = true;
                header('Location: admin/admin-dashboard.php');
                exit();
               }else{
                    $invalid = "Invalid credentials";
               }
            } 
        }else{
            $invalid = "There is no such user";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News portal | Lovro Buljat</title>

    <link href="style.css" rel="stylesheet">
    <script type="text/javascript" src="jquery-1.11.0.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
   <script src="js/form-validation.js"></script>

    <script >

    $(function(){
        $("form[name='prijava']").validate({
            rules: {
                email1:{
                    required: true,
                    email:true
                },
                password1:{
                    required: true,
                    minLenght: 4,

                }
            },
            messages:{
                email1:{
                    required: "Potrebno je upisati email",
                    email: "Potrebno je upisati email točno"
                },
                password1:{
                    required: "Potrebnu je unijeti šifru",
                    minLenght: "Dužina mora biti veća od 4"
                },
            },
              submitHandler: function(form){
                form.submit();
              }  
        })
    }
)

</script>
</head>
<body>
   <!--Nav-->
   <?php include("include/header.php"); ?>

   <main class="container">
        <form action="admin.php" name="prijava" method="post" class="signIn">
            <h2>Login</h2>

            <label>Email:</label><br>
            <input type="email" name="email1" id="email1"><br>
            <label>Password:</label><br>
            <input type="password" name="password1" id="password1" place><br>
            <a href=""><button type="submit">Log in</button></a>
            <p><?= $invalid ?></p>
        </form>

    </main>

    <?php include("include/footer.php");?>
</body>
</html>