<?php include "header.php";?>

<?php
 $tglakhirq = $qtglakhir['dateorder'];
 $tglakhir = $tglakhirq ;
 $tglawalq = $qtglawal['dateorder'];
 $tglawal = $tglawalq ;

  if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
        from transaksi left join layanan 
       on (transaksi.id_layanan = layanan.id_layanan) left join produk
       on (transaksi.id_produk = produk.id_produk) 
       WHERE dateorder between '$tglawal' AND '$tglakhir' 
       group by transaksi.id_order", MYSQLI_USE_RESULT)) 
  {

      while ($b = $result->fetch_row()) {
      $trxA[] = $b[0];
      }

      $result->close();
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
      <h4>Filter Sequence</h4>
        
        <!-- <p class="lead">This example is a quick exercise to illustrate how the bottom navbar works.</p> -->

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="GET" class="needs-validation" novalidate>
      
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
                <div class="col-md-2 mb-3">
                      <label for="validationDefault02">Min Support</label>
                      <input type="text" name="minSup" class="form-control" id="validationDefault02" placeholder="0" value="">
                </div>
                
      </div><!---end-->
      <div class="form-group row">
                <div class="col-md-4 mb-3">
                      <a class="btn btn-secondary my-2 my-sm-0" href="analis.php" role="button">Back</a> 
                </div>
                <div class="col-md-4 mb-3">
                      <button name="caridata" class="btn btn-primary my-2 my-sm-0"  type="submit">Tampilkan Data</button>
                </div>
                <div class="col-md-4 mb-3">
                      <button type="submit" name="filter" class="btn btn-success my-2 my-sm-0"><i class="icofont">filter</i> Filter</button>
                      <a class="btn btn-info my-2 my-sm-0" href="dataconfidence.php" role="button">View Data Frequent »</a> 
                </div>
                
                
      </div><!---end-->
      
</form>     
</div><!--container-->



<div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            
          </div>
          <div class="col-4 text-center">
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">

          </form>
          </div>
</div>
       
          <h4>Table Sequence</h4>


          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="thead-light">
                <tr>
                  <th>ID</th>
                  <th>Sequence</th>            
                  <th>Jumlah Kemunculan</th>
                  <th>Nilai Support</th>
                </tr>
              </thead>

<?php

if(isset($_GET['caridata']))
{
  $tglawal = $_GET['tglawal'];
  $tglakhir = $_GET['tglakhir'];
  $minSup = $_GET['minSup'];

 

   if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
        from transaksi left join layanan 
       on (transaksi.id_layanan = layanan.id_layanan) left join produk
       on (transaksi.id_produk = produk.id_produk) 
       WHERE dateorder between '$tglawal' AND '$tglakhir' 
       group by transaksi.id_order", MYSQLI_USE_RESULT)) 
  {      
      while ($b = $result->fetch_row()) {
        $trx2[] = $b[0];
      }
      
        $result->close();
  }

  
  if ($tglakhir == 0 && $tglawal == 0) {
            $kondisi = "Harap input tanggal awal dan akhir <b>Klik <a href='datasequence.php'>Refresh</a></b> <br> ";
            echo '<div class="alert alert-danger" role="alert">';
            echo $kondisi;
            echo '</div>';
  } else {
          
          echo '<tbody>';                  
                  $no=1;
                
               foreach ($item as $value) {
                    $temp1 = $total_per_item[$value] = 0;
                    foreach($trx2 as $item_trx) {            
                        if(strpos($item_trx, $value) !== false) {
                           $total_per_item [$value]++;
                          $temp1++ ; 
                        }
                    }

                  echo '<th scope="row">'.$no.'</th>';
                  echo '<td>' . $value.'</td>';
                  echo '<td>' . $temp1.'</td>';
                  
                  $nsup = 0;
                  if ($temp1 == 0) {
                    $hasil_bagi = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                    $nsup = (int)(($temp1 / $jumlahorder)*100);
                  }
                  
                  echo '<td>' . $nsup.'%</td>';
                  echo '</tr>';
                $no++;

              } //end                           

          echo '</tbody>';              
  } //jika tdk nol

      if(isset($_GET['filter'])){

      $tglawal = $_GET['tglawal'];
      $tglakhir = $_GET['tglakhir'];
            
      } //endFilter
      echo 'Periode: '.$tglawal .' s.d '. $tglakhir;
} //endcari data  
elseif(isset($_GET['filter'])) 
{

  $tglawal = $_GET['tglawal'];
  $tglakhir = $_GET['tglakhir'];
  $tgl1 = $tglawal;
  $tgl2 = $tglakhir;
  echo 'Periode: '.$tglawal .' s.d '. $tglakhir;
  $minSup = $_GET['minSup'];

if($tgl1 != 0){
  $tglawal = $_GET['tglawal'];
  $tglakhir = $_GET['tglakhir'];
  if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
        from transaksi left join layanan 
       on (transaksi.id_layanan = layanan.id_layanan) left join produk
       on (transaksi.id_produk = produk.id_produk) 
       WHERE dateorder between '$tglawal' AND '$tglakhir' 
       group by transaksi.id_order", MYSQLI_USE_RESULT)) 
  {

      while ($b = $result->fetch_row()) {
      $trx2[] = $b[0];
      }

      $result->close();
  }
} else {

 $tglakhirq = $qtglakhir['dateorder'];
 $tglakhir = $tglakhirq ;
 $tglawalq = $qtglawal['dateorder'];
 $tglawal = $tglawalq ;

  if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
        from transaksi left join layanan 
       on (transaksi.id_layanan = layanan.id_layanan) left join produk
       on (transaksi.id_produk = produk.id_produk) 
       WHERE dateorder between '$tglawal' AND '$tglakhir' 
       group by transaksi.id_order", MYSQLI_USE_RESULT)) 
  {

      while ($b = $result->fetch_row()) {
      $trx2[] = $b[0];
      }

      $result->close();
  }

}

  if ($minSup == 0) {
      $kondisi = "Harap input nilai minimum support untuk melakukan filter <b>Klik <a href='datasequence.php'>Refresh</a></b> <br> ";
      echo '<div class="alert alert-danger" role="alert">';
      echo $kondisi;
      echo '</div>';
  } else { //jika inputan tidak 0
          
              echo '<tbody>';                  
              $no=1;

               // menghitung jumlah item
               foreach ($item as $value) {
                    $temp1 = $total_per_item[$value] = 0;
                    foreach($trx2 as $item_trx) {            
                        if(strpos($item_trx, $value) !== false) {
                           $total_per_item [$value]++;
                          $temp1++ ; 
                        }
                    }

                    //mencari nilai support
                      $nsup = 0;
                      if ($temp1 == 0){
                          $hasil_bagi = "Tak terhingga ";
                      } else { //jika pembagi tidak 0
                         $nsup = (int)(($temp1 / $jumlahorder)*100); // nsup = item / total order
                      }

                    if($nsup >= $minSup){

                      echo '<th scope="row">'.$no.'</th>';
                      echo '<td>' . $value.'</td>'; //item
                      echo '<td>' . $temp1.'</td>'; // jumlah kemunculan
                      echo '<td>' . $nsup.'%</td>';
                      echo '</tr>';
                    } //endMinSup

                  $no++;
                  
                } //endperulangan  

              echo '</tbody>';
              // echo $tgl1 .' s.d '. $tgl2;                         
                
  } //endjikaNol
  
   if(isset($_GET['filter'])){

      $tglawal = $_GET['tglawal'];
      $tglakhir = $_GET['tglakhir'];
            
    } //endFilter dalam filter
} //endFilter
else {     
          echo '<tbody>';                  
                  $no=1;
                
               foreach ($item as $value) {
                    $temp1 = $total_per_item[$value] = 0;
                    foreach($trxA as $item_trx) {            
                        if(strpos($item_trx, $value) !== false) {
                           $total_per_item [$value]++;
                          $temp1++ ; 
                        }
                    }

                  echo '<th scope="row">'.$no.'</th>';
                  echo '<td>' . $value.'</td>';
                  echo '<td>' . $temp1.'</td>';
                  
                  $nsup = 0;
                  if ($temp1 == 0) {
                    $hasil_bagi = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                    $nsup = (int)(($temp1 / $jumlahorder)*100);
                  }
                  
                  echo '<td>' . $nsup.'%</td>';
                  echo '</tr>';
                $no++;

              } //end                           

          echo '</tbody>';

} //endelse
$tgl1=+1;
?>
    </table>
    </div>
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
  </body>
</html>