<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Admin Login</title>
</head>
<body>
    <form method="POST">
      <div class="form-group">
          <?php
                if(isset($_SESSION['mess'])){
                    echo "<div class='alert alert-danger' role='alert'>
                        ".$_SESSION['mess']."          
                    </div>";
                }
          ?>
        
        <label for="exampleInputEmail1">Enter username</label>
        <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter username" name="user">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pass">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
</html>
<?php
if (isset($_POST['user']) && isset($_POST['pass']))
{
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['pass'] = $_POST['pass']; 
    header("location: index.php");
}