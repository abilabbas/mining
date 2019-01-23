<?php include "header.php";?>
<?php 
 
include("../config.php"); 
include"../function.php";
 
// kalau tidak ada id di query string 
if( !isset($_GET['code']) ){     
  header('Location: orders.php'); } 
 
//ambil id dari query string 
  $code = $_GET['code']; 
 
// buat query untuk ambil data dari database 
  $sql = "SELECT * FROM member WHERE id_member=$code"; 
  $query = mysqli_query($conn, $sql);
   
  $member = mysqli_fetch_assoc($query); 
 
// jika data yang di-edit tidak ditemukan 
  if( mysqli_num_rows($query) < 1 ){     
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
            <h1 class="h2">Form Order</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                Pesanan dilakukan atas nama :<a href="#"> <?php echo $member['nama'] ?> </a>
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
              <span class="text-muted"><?php echo $jumlahdoormobil ; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Doormotor Complete</h6>
                <div class="text-muted">Brief description</div>
              </div>
              <span class="text-muted"><?php echo $jumlahdoormotor ; ?></span>
            </li>
            
            <li class="list-group-item d-flex justify-content-between">
              <span>Total Order</span>
              <strong><?php echo $jumlahorder ; ?></strong>
            </li>
          </ul>
        </div>
<!--info end-->  

<div class="col-md-8 order-md-1">

         
    <form action="proses_order.php" method="post" class="needs-validation" novalidate>

            <h4 class="mb-3">User</h4>
            
            <input type="hidden" name="id_member" value="<?php echo $member['id_member'] ?>" />

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                   <input type="text" id="disabledTextInput" name="nama" class="form-control" placeholder="<?php echo $member['nama'] ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" id="disabledTextInput" name="email" class="form-control" placeholder="<?php echo $member['email'] ?>" readonly>
                </div>
            </div>

            

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Ponsel</label>
                <div class="col-sm-10">
                    <input type="text" id="disabledTextInput" name="nohp" class="form-control" placeholder="<?php echo $member['nohp'] ?>" readonly>
                </div>
            </div>

            <h4 class="mb-3">Pilih Layanan</h4>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Layanan</label>
                <div class="col-sm-10">
                    <select name="id_layanan" class="custom-select" id="inputGroupSelect02">
                    <option selected>Choose...</option>
                        <?php
                          $querylayanan = mysqli_query($conn, "SELECT * FROM layanan");
                          while($layanan = mysqli_fetch_array($querylayanan))
                          {
                              echo "<option value=".$layanan['id_layanan'].">".$layanan['layanan_name']."</option>";
                          }
                         ?>
                   </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Pilih Paket</label>
                <div class="col-sm-10">
                      <select name="id_produk" class="custom-select" id="inputGroupSelect02">
                      <option selected>Choose...</option>
                          <?php
                            $queryproduk = mysqli_query($conn, "SELECT * FROM produk INNER JOIN layanan ON layanan.id_layanan = produk.id_layanan ");
                            while($produk = mysqli_fetch_array($queryproduk))
                            {
                                echo "<option value=".$produk['id_produk'].">".$produk['produk_name']." / Rp.".$produk['produk_price']." / ".$produk['produk_time']." Menit / ".$produk['layanan_name']."</option>";
                            }
                           ?>
                      </select>
                </div>
            </div>
            
             <h4 class="mb-3">Detail Vehicle</h4>

               <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nama Brand</label>
                <div class="col-sm-10">
                
                  <select name="id_vehicle" class="custom-select" id="inputGroupSelect02">
                    <option selected>Choose...</option>
                        <?php
                          $queryvehicle = mysqli_query($conn, "SELECT * FROM vehicle");
                          while($vehicle = mysqli_fetch_array($queryvehicle))
                          {
                              echo "<option value=".$vehicle['id_vehicle'].">".$vehicle['vehicle_brand']."</option>";
                          }
                         ?>
                   </select>
                
                </div>
              </div>

            <h4 class="mb-3">Detail Order</h4>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">   
                      <textarea name="alamatorder" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="opt_day" class="col-sm-2 col-form-label">Tanggal dan Waktu</label>
                <div class="form-group col-md-2">
                      <label for="validationDefault01">Tanggal</label>
                      <select  class="custom-select"  name="opt_day" id="opt_day">
                      <option>Tanggal</option>
                        <?php date_day(); ?>
                      </select>
                </div>

                <div class="form-group col-md-2">
                      <label for="validationDefault01">Bulan</label>
                      <select  class="custom-select"  name="opt_month" id="opt_month">
                      <option>Bulan</option>
                     <?php date_month(); ?>
                    </select>
                </div>

                <div class="form-group col-md-2">
                      <label for="validationDefault01">Tahun</label>
                      <select  class="custom-select"  name="opt_year" id="opt_year">
                      <option>Tahun</option>
                      <?php date_year(); ?>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                      <label for="validationDefault02">Waktu</label>
                      <input type="text" name="time" class="form-control" id="validationDefault02" placeholder="00:00 WIB" value="" required>
                </div>
            
            </div>
       
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Catatan</label>
                <div class="col-sm-10">   
                    <textarea name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Pembayaran</label>
                <div class="col-sm-10">
                    <select name="id_payment" class="custom-select" id="inputGroupSelect02">
                    <option selected>Choose...</option>
                    <?php
                      $querypayment = mysqli_query($conn, "SELECT * FROM payment");
                      while($id_payment = mysqli_fetch_array($querypayment))
                      {
                          echo "<option value=".$id_payment['id_payment'].">".$id_payment['payment_name']."</option>";
                      }
                     ?>
                    </select>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a class="btn btn-dark btn-lg" href="orders.php" role="button" >Back</a>
                </div>
                <div class="col-md-6 mb-3">
                    <button name="pesan" class="btn btn-primary btn-lg btn-block" type="submit">Order</button>
                </div>
            </div>   

    </form>         
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
