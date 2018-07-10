<<<<<<< HEAD:login.php
<?php
require_once("config.php");

if (isset($_POST['login']))
{
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  $sql = "SELECET * FROM users WHERE username=:username OR email=:email";
  $stmt = $db->prepare($sql);

  //bind parameter ke query
  $params = array
  (
      ":username" => $username,
      ":email" => $username
  );

  $stmt ->execute($params);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  //jika user terdaftar
  if($user)
  {
    //verif password
    if(password_verify($password, $user["password"]))
    {
      //buat session
      session_start();
      $_SESSION["user"] = $user;
      //apabila login sukses, alihkan ke index
      header("Location: index.php");
    }
  }
}
?>

=======
<?php include"config.php"; ?>
>>>>>>> master:signin.php
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.png">

    <title>Sign in - DoorjekAnalytic</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="https://bootstrap-themes.github.io/dashboard/assets/css/toolkit-light.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>
<<<<<<< HEAD:login.php
    <form method="post" name="login" action="index.php" class="form-signin">
      <img class="mb-4" src="assets/img/logodoorjek.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">username</label>
      <input type="text" id="inputUsername" class="form-control" placeholder="username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>

    <!-- Modal -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
=======





  <body class="text-center">
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" onSubmit="retun validasi()" class="form-signin">

    <?php 

require_once("config.php");

session_start();
    if(isset($_SESSION['userSession']))
    {
      header('location:admin/index.php');
      exit();
    }
      else
    {
      if(isset($_POST['login']))
      {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        
        if((empty($email) === true) || (empty($password) === true))
        {
          echo "<div class='danger'>Tolong masukkan email dan password anda </div>";
        }
        else 
        {
          $scurity = md5($password);
          $query = mysqli_query($conn,"SELECT * FROM admin WHERE (email ='$email') and password = '$scurity'");
          $total = mysqli_num_rows($query);
          $rows = mysqli_fetch_array($query);
        
          if($total === 1)
          {
            $_SESSION['userSession'] = $_POST['email'];
            
            if($rows['status'] == "admin" ) 
            {
              header("location:admin/index.php");
              exit();
              } elseif ($rows['level'] == "analis")
              header("location:analis/index.php");
              exit();
            }
          else
          {
            echo "<div class='danger'>email dan password anda tidak ada</div> ";
          }
        }
      }
    }


  ?>

      <img class="mb-4" src="assets/img/logodoorjek.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      
      <button class="btn btn-lg btn-primary" name="login" btn-block" type="submit">Sign in</button>
      
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>


      
      
>>>>>>> master:signin.php
  </body>
</html>

