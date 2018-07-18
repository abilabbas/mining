<?php include "header.php";?>
<?php 
 
include("../config.php"); 
 
// kalau tidak ada id di query string 
if( !isset($_GET['code']) ){     
  header('Location: orders.php'); } 
 
//ambil id dari query string 
  $code = $_GET['code']; 
 
// buat query untuk ambil data dari database 

  $queryorder = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN member ON member.id_member = transaksi.id_member LEFT JOIN layanan ON layanan.id_layanan = transaksi.id_layanan LEFT JOIN produk ON produk.id_produk = transaksi.id_produk LEFT JOIN payment ON payment.id_payment = transaksi.id_payment WHERE id_order='$code'");
  $jumlah = mysqli_num_rows($queryorder);
  $order = mysqli_fetch_assoc($queryorder);
 
// jika data yang di-edit tidak ditemukan 
  if($jumlah < 1 ){     
    die("data tidak ditemukan..."); 
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
                <a class="nav-link active" href="orders.php">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="members.php">
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
            <h1 class="h2">Detail Order</h1>
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
          <h4 class="mb-3">Detail User</h4>
          <form action="" method="" class="needs-validation" novalidate>
            

           
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Id User</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $order['id_member'] ?>" readonly>
          
          </div>
        </div>

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $order['nama'] ?>" readonly>
          
          </div>
        </div>

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $order['email'] ?>" readonly>
          
          </div>
        </div>

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $order['alamat'] ?>" readonly>
          
          </div>
        </div>

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Ponsel</label>
          <div class="col-sm-10">
         
            <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $order['nohp'] ?>" readonly>
         
          </div>
        </div>
            
         <h4 class="mb-3">Detail Status</h4>

         <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Status Progres</label>
          <div class="col-sm-10">
          <?php
            if ($order['status'] == 3){
                    echo '<input type="text" id="disabledTextInput" class="form-control" placeholder="Success" readonly>';
                  } else {
                    echo '<input type="text" id="disabledTextInput" class="form-control" placeholder="Cancel" readonly>';
                  }
          ?>
          
          </div>
        </div>

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">When</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $order['dateorder'] ?>" readonly>
          
          </div>
        </div>

        <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Alamat Order</label>
                <div class="col-sm-10">   
                      <textarea name="alamatorder" class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="<?php echo $order['alamatorder'] ?>" readonly></textarea>
                </div>
        </div>

        <h4 class="mb-3">Detail Produk</h4>

         <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama Produk</label>
          <div class="col-sm-10">
         
            <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $order['produk_name'] ?>" readonly>
          
          </div>
        </div>

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Pembayaran</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $order['payment_name'] ?>" readonly>
          
          </div>
        </div>

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Kupon</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder="" readonly>
          
          </div>
        </div>

        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Harga Produk</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Rp. <?php echo $order['produk_price'] ?>" readonly>
          
          </div>
        </div>
<!--
        <h4 class="mb-3">Detail Vehicle</h4>

         <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama Brand</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Jeep" readonly>
          
          </div>
        </div>

         <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Model</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Wrangler / Rubicon" readonly>
         
          </div>
        </div>

         <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Transmisi</label>
          <div class="col-sm-10">
         
            <input type="text" id="disabledTextInput" class="form-control" placeholder="Automatic" readonly>
          
          </div>
        </div>

         <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Tahun</label>
          <div class="col-sm-10">
          
            <input type="text" id="disabledTextInput" class="form-control" placeholder=">2016" readonly>
          
          </div>
        </div>
-->
        <div class="form-group row">
      
        </div>
            <div class="row">

              <div class="col-md-6 mb-3">
                <a class="btn btn-dark btn-lg" href="orders.php" role="button" >Back</a>
                
              </div>
              <div class="col-md-6 mb-3">
                
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
