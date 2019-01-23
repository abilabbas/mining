<?php include"config.php"; ?>
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





  <body class="text-center">
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" onSubmit="retun validasi()" class="form-signin">
      <img class="mb-4" src="assets/img/logodoorjek.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
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
                  
                  echo '<div class=alert alert-danger" role="alert">Tolong masukkan email dan password anda </div>';
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
                      } elseif ($rows['status'] == "analis")
                      header("location:analis/index.php");
                      exit();
                    }
                  else
                  { 

                    echo $kondisi ='<div class="alert alert-danger" role="alert">'.'Email dan password anda tidak ada'.'</div>';
                  }
                }
              }
            }


          ?>

      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      
      <button class="btn btn-lg btn-primary" name="login" btn-block" type="submit">Sign in</button>
      
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>


      
      
  </body>
</html>

