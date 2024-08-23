<!DOCTYPE html>

<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=admin_db","root","");

    if(isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $registration_date = date("Y-m-d");
        $user_level = $_POST['user_level'];
        $role = "member";

        $query = "INSERT INTO user (first_name, last_name, email, password,registration_date,user_level, user_role) VALUES(?,?,?,?,?,?,?)";

        $result = $conn->prepare($query);
        $result->execute([$first_name,$last_name,$email,$password,$registration_date,$user_level,$role]);

        echo "You have successfully registered";
        header('refresh:2; url=user_login.php');  
    }
}

catch(Exception $e){
    $errorstring = "<p class='text-center col-sm-8' style='color:red'>";
    $errorstring .= "System Error<br />You could not be registered due ";
    $errorstring .= "to a system error. We apologize for any inconvenience.</p>";
    echo "<p class=' text-center col-sm-2' style='color:red'>$errorstring</p>";
    header('refresh:2; url=user_login.php');
    exit();
}
?>

<html lang="en">
    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS File -->
        <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
        <script src="verify.js"></script>
</head>

<body>
    <div class="container" style="margin-top:30px">
    <!-- Header Section -->
    <header class="jumbotron text-center row" style="margin-bottom:2px; background:linear-gradcient(white, #0073e6); padding:20px;">
    <?php include('header-admin.php'); ?>
</header>

<!-- Body Section -->
<div class="row" style="padding-left:0px;">
<nav class="col-sm-2">
</br>
</nav>
<div class="col-sm-8">
    <h3 class="text-center">Registration</h3>
    <form action="user_register.php" method="post" name="register" id="register">
        <div class="form-group row">
            <label for="first_name" class="col-sm-4 col-form-label">First Name:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" maxlength="30" required>
</div>
</div>
<div class="form-group row">
    <label for="last_name" class="col-sm-4 col-form-label">Last Name:</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" maxlength="40" required>
</div>
</div>
<div class="form-group row">
<label for="email" class="col-sm-4 col-form-label">E-mail:</label>
    <div class="col-sm-8">
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" maxlength="60" required>
</div>
</div>
<div class="form-group row">
    <label for="password" class="col-sm-4 col-form-label">Password:</label>
    <div class="col-sm-8">
        <input type="password" clas="form-control" id="password" name="password" placeholder="Password" maxlength="60" required>
</div>
</div>

<div class="form-group row">
    <label for="user_level" class="col-sm-4 col-form-label">User Level:</label>
    <div class="col-sm-8">
        <input list="user_level" name="user_level" class="form-control" required>
        <datalist id="user_level">
            <option value=1>
            <option value=2>
            <option value=3>
</datalist>
</div>
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <input id="submit" class="btn btn-primary" type="submit" name="submit" value="REGISTER NOW">
</br>
</br>
<p><a href="user_login.php">Back to login<p>
</div>
</div>
</form>
</div>
</div>

<!-- Footer Content Section -->
<footer class="text-center" style="padding-bottom:1px; padding-top:8px;">
<?php include('footer.php'); ?>
</footer>

</div>
</body>
</html>