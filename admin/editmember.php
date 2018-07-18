<?php include "header.php";?>

<?php
if(isset($_GET['update']))
{
$uid = $_GET['update'];
$sql = mysqli_query($conn,"SELECT * FROM member WHERE id_member='$uid'");
$member = mysqli_fetch_array($sql);

}
if( mysqli_num_rows($sql) < 1 ){     
  die("data tidak ada"); 
} 
 

?>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="index.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="orders.php">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="members.php">
                  <span data-feather="users"></span>
                  Members
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="analis.php">
                  <span data-feather="bar-chart-2"></span>
                  Analis
                </a>
              </li>
            </ul>

            
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Member</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                ccccccccccccccc
              </div>
              
            </div>
          </div>

<!--info-->
        <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Info</span>
            <span class="badge badge-secondary badge-pill"></span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Member Doorjek</h6>
                <div class="text-muted">Last Update</div>
              </div>
              <span class="text-muted"><?php echo $jumlahmember ; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Doormobil Complete</h6>
                <div class="text-muted">Brief description</div>
              </div>
              <span class="text-muted"><?php echo $jumlahdoormobil; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Doormotor Complete</h6>
                <div class="text-muted">Brief description</div>
              </div>
              <span class="text-muted"><?php echo $jumlahdoormotor; ?></span>
            </li>
            
            <li class="list-group-item d-flex justify-content-between">
              <span>Total Order</span>
              <strong><?php echo $jumlahorder ; ?></strong>
            </li>
          </ul>
        </div>
<!--info end-->

        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Form Edit</h4>

 

          <form  action="proses_editmember.php" method="POST" class="needs-validation" novalidate>
            

        <input type="hidden" name="id_member" value="<?php echo $member['id_member'] ?>" />

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
          <div class="col-sm-10">
          
            <input type="text"  name="nama" class="form-control" placeholder="nama" value="<?php echo $member['nama'] ?>">
          
          </div>
        </div>

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" name="email" class="form-control" placeholder="email" value="<?php echo $member['email'] ?>">
          
          </div>
        </div>

        

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Ponsel</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" name="nohp" class="form-control" placeholder="+62" value="<?php echo $member['nohp'] ?>">
         
          </div>
        </div>
<hr>
        <div class="form-group row">
      
        </div>

       
            <div class="row">

              <div class="col-md-6 mb-3">
                <a class="btn btn-dark btn-lg" href="members.php" role="button" >Back</a>
                
              </div>
              <div class="col-md-6 mb-3">
               <button name="updatemember" value="updatemember" class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
              </div>
            </div>   
          </form>
        </div>
      </div>


    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

<script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
