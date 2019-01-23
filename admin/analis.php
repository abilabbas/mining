<?php include "header.php";?>
<?php
$limit = 10;
$queryorder = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN member ON member.id_member = transaksi.id_member INNER JOIN layanan ON layanan.id_layanan = transaksi.id_layanan INNER JOIN produk ON produk.id_produk = transaksi.id_produk ORDER BY transaksi.id_member LIMIT  $limit");
$jumlah = mysqli_num_rows($queryorder);
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
                <a class="nav-link" href="members.php">
                  <span data-feather="users"></span>
                  Members
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="analis.php">
                  <span data-feather="bar-chart-2"></span>
                  Analis
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Analis</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <!--<button class="btn btn-sm btn-outline-secondary">Share</button>-->
                <!--<button class="btn btn-sm btn-outline-secondary">Export</button>-->
              </div>
              
            </div>
          </div>

        
<!--- grafik info ---->

<div class="container">
      <!-- <div class="jumbotron mt-3"> -->
      <h4>Pengujian Sistem</h4>
        
        <p class="lead">Cari berdasarkan tanggal dan lihat analisis data.</p>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="needs-validation" novalidate>
      <div class="form-group row">
                <div class="col-md-4 mb-3">
                      <label for="validationDefault02">Tanggal Awal</label>
                      <!--<input type="search" name="tglawal" class="form-control" id="validationDefault02">-->
                      <input class="form-control mr-sm-2" type="search" name="tglawal" placeholder="Format: yyyy-mm-dd | ex: 2017-04-25">
                </div>
                <div class="col-md-4 mb-3">
                      <label for="validationDefault02">Tanggal Akhir</label>
                      <!--<input type="search" name="tglakhir" class="form-control" id="validationDefault02" placeholder="Format: yyyy-mm-dd | ex: 2017-12-25">-->
                      <input class="form-control mr-sm-2" type="search" name="tglakhir" placeholder="Format: yyyy-mm-dd | ex: 2017-12-25">
                </div>
      </div>

      <div class="form-group row">
        <div class="col-md-4 mb-3">   
          <button name="caridata" class="btn btn-primary my-2 my-sm-0"  type="submit">Tampilkan Data</button>
        </div>
</form> 
        <div class="col-md-4 mb-3">
          <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="input-group col col-lg-6">
            <select name="maxrows" class="custom-select" id="inputGroupSelect04">
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
              <option value="250">250</option>
              <option value="500">500</option>
              <option value="<?php echo $jumlahorder; ?>">All</option>
            </select>
            <div class="input-group-append">
              <button name="maxrows2" class="btn btn-outline-secondary" type="submit">Rows</button>
            </div>
            </div>
          </form>
        </div>
        <div class="col-md-4 mb-3">
          <!--<button name="proses" class="btn btn-success my-2 my-sm-0"  type="submit">Proses</button>  -->
          <a class="btn btn-info my-2 my-sm-0" href="datasequence.php" role="button">View Data Sequence »</a>
        </div>
      </div>   


    
        
      <!-- </div> -->
    </div>
<!--  -->



<?php
  
  if(isset($_POST['maxrows2'])){
 
  $limit = $_POST['maxrows'];

  $queryorder = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN member ON member.id_member = transaksi.id_member INNER JOIN layanan ON layanan.id_layanan = transaksi.id_layanan INNER JOIN produk ON produk.id_produk = transaksi.id_produk ORDER BY transaksi.id_member LIMIT  $limit");
  //$queryorder = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN member ON member.id_member = transaksi.id_member INNER JOIN layanan ON layanan.id_layanan = transaksi.id_layanan INNER JOIN produk ON produk.id_produk = transaksi.id_produk ORDER BY transaksi.id_order ");
}
?>

          <h4>Table Orders</h4>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Id User (SID)</th>
                  <th>Date Order (EID)</th>             
                  <th colspan="2">Item</th>
                  
                </tr>
              </thead>
              
<?php
  
$i=1;
if(isset($_POST['caridata']))
{
   
  $tglawal = $_POST['tglawal'];
  $tglakhir = $_POST['tglakhir'];
 
  $queryorder2 = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN member ON member.id_member = transaksi.id_member INNER JOIN layanan ON layanan.id_layanan = transaksi.id_layanan INNER JOIN produk ON produk.id_produk = transaksi.id_produk  WHERE dateorder between '$tglawal' AND '$tglakhir' ORDER BY transaksi.dateorder"); 
  
  if($tglawal == 0 && $tglakhir == 0){
      $kondisi = "Harap masukkan tanggal <b>Klik <a href='analis.php'>Refresh</a></b> <br> ";
      echo '<div class="alert alert-danger" role="alert">';
      echo $kondisi;
      echo '</div>';
  }

  while($order = mysqli_fetch_array($queryorder2))
  {
  
                echo '<tbody>';
                echo '<tr>';
                
                  echo '<th scope="row">'.$i.'</th>';
                  echo '<td data-toggle="tooltip" data-placement="top" title="'.$order['nama'].'">' . $order['id_member'].'</td>';
                  echo '<td>' . $order['dateorder'].'</td>';
                  echo '<td colspan="2">' . $order['layanan_name'].' '. $order['produk_name'].'</td>';
                echo '</tr>';
                
                
              echo '</tbody>';
              $i++;
                $jumlahsearch = $i;
  }
echo 'Periode '.$tglawal .' s.d '. $tglakhir;
}
else{

  while($order = mysqli_fetch_array($queryorder))
  { 
   //$idorder = $order['id_order'];
   //$sort = array($idorder);
   //sort($sort);
   
           
                echo '<tbody>';
                echo '<tr>';
                  

                  echo '<th scope="row">'.$i.'</th>';
                  echo '<td data-toggle="tooltip" data-placement="top" title="'.$order['nama'].'">' . $order['id_member'].'</td>';
                  echo '<td>' . $order['dateorder'].'</td>';
                  echo '<td colspan="2">' . $order['layanan_name'].' <i class="icofont icofont-rotate-horizontal">arrow_right</i> '. $order['produk_name'].'</td>';
                echo '</tr>';
                
                
              echo '</tbody>';
              $i++;
              
  }
}
$jumlahsearch = mysqli_num_rows($queryorder);
?>
           

            </table>
          </div>

<div class="row">
  <div class="col-12 col-md-8">Showing <?php echo $jumlahsearch ; ?> of  <?php echo $jumlahorder ; ?> entries</div>
  <hr> <br>
  <div class="col-6 col-md-4">
  <nav aria-label="...">
 
</nav>
</div>

</main>
</div>
</div>    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs --><!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>-->
  </body>
</html>
