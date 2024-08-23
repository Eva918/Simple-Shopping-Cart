<!DOCTYPE html>

<?php
    session_start();

    if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new PDO("mysql:host=localhost;dbname=admin_db","root","");

    $query = "SELECT * FROM user WHERE email = ?";

    $result = $conn->prepare($query);
    $result->execute([$email]);

        if($row = $result->fetch()){
            if(md5($password) == $row['email']){
                $_SESSION['email'] = $row['email'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['user_role'] = $row['user_role'];

                if($row['user_role'] == "member"){
                    header('Location: login_session_user.php');
                }else if($row['user_role'] == "admin"){
                    header('Location: admin-vew-user.php');
                }
            }else {
                header('Location: user_login.php');
                session_abort();
            }
        }else{
            header('Location: user_login.php');
            session_destroy();
        }
    }
?>

<html lang="en">
    <head>
        <title>Web Design and Development</title>
        <meta charset="utf-8">
        <meta nam="viewport"
        content="width=devise-width, intial-scale=1, shrinkl-to-fit=no">
        <!--Boostrap CSS File-->
        <link rel="stylesheet"
        href=
        "https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity=
        "sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
    </head>

    <body>
        <div class="cointainer" style="margin-top:30px">
        <!--Header Section-->
        <header class="jumbotron text-center row"
        style="margin-bottom:2px; background: linear-gradient(white, #0073e6); padding:20px;">
        <?php include('header-admin.php'); ?>
        </header>

        <!--Body Section-->
        <div class="row" style="padding-left: 0px;">
        <nav class="col-sm-2">
            </br>
        </nav>

        <!--Center Column Content Section-->
        <div class="col-sm-8">
            <h3 class="text-center">Welcome, please log in first</h3>
            <p>
                <form styele="padding-left:200px;" method="post" action="user_login.php">
                    <label class="col-sm-4 col-form-label">Email:</label>
                    <input type="text" name="email" /><br />
                    </br>
                    <label class="col-sm-4 col-form-label">Password:</label>
                    <input type="password" name="password" /><br />
                    </br>
                    <button class="btn btn-primary" type="submit" name="submit" id="Login">Login</button>
                    </br>
                    </br>
                    <p>Don&apo;t have an account? <a href="user_register.php">Register </p>
                </form>
        </div>
        </div>

        <!--Footer Content Section-->
        <footer class="text-center" style="padding-bottom:1px; padding-top:8px;">
            <?php include('footer.php'); ?>
        </footer>
        </div>
    </body>
</html>