<?php include "header.php";?>
<?php
$limit = 10;
$queryorder = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN member ON member.id_member = transaksi.id_member INNER JOIN layanan ON layanan.id_layanan = transaksi.id_layanan INNER JOIN produk ON produk.id_produk = transaksi.id_produk ORDER BY transaksi.id_member LIMIT  $limit");
$jumlah = mysqli_num_rows($queryorder);

$id=1;
 if(!empty($_POST['opti'])){
   $id=$_POST['opti'];
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
      <div class="jumbotron mt-3">
      <h4>Filter Sequence</h4>
        
        <p class="lead">This example is a quick exercise to illustrate how the bottom navbar works.</p>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="needs-validation" novalidate>
      

          <a class="btn btn-primary my-2 my-sm-0" href="dataconfidence.php" role="button">Back</a>  
          <button name="proses" class="btn btn-success my-2 my-sm-0"  type="submit">Proses</button> 

              
           
</form>     
        
      </div>
    </div>
<!--  -->

<div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            
          </div>
          <div class="col-4 text-center">
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
         <!-- <form action="<?php // $_SERVER['PHP_SELF'];?>" method="get" class="col-4 d-flex justify-content-end align-items-center">
            <a class="text-muted" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
            </a>
            <input type="text" class="form-control bsx" name="search" placeholder="Search orders">
          </form>-->
</div>

<?php
  
  if(isset($_POST['maxrows2'])){
 
  $limit = $_POST['maxrows'];

  $queryorder = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN member ON member.id_member = transaksi.id_member INNER JOIN layanan ON layanan.id_layanan = transaksi.id_layanan INNER JOIN produk ON produk.id_produk = transaksi.id_produk ORDER BY transaksi.id_member LIMIT  $limit");
  //$queryorder = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN member ON member.id_member = transaksi.id_member INNER JOIN layanan ON layanan.id_layanan = transaksi.id_layanan INNER JOIN produk ON produk.id_produk = transaksi.id_produk ORDER BY transaksi.id_order ");
}
?>
          

          
          <!-- ============================================================= -->
          <h4>Table Sequence</h4>
<div class="table-responsive">
            <table class="table table-hover">
           
        <thead>
                <tr>
                  <th>ID</th>
                  <th>Frequent</th>            
                  <th>Sequence</th> 
                  <th>Confidence</th> 
                  
                </tr>
              </thead>
              <tbody>

              <?php
              //TOTAL PER ITEM
              


        $no=0;
        for($i = 0; $i < $item1; $i++) {
            for($j = $i+1; $j < $item2; $j++) {
                $item_pair = $item[$i].' | '.$item[$j]; 
                $temp1 = $item_array[$item_pair] = 0;
                
                foreach($belian as $item_belian) {
                    if((strpos($item_belian, $item[$i]) !== false) && (strpos($item_belian, $item[$j]) !== false)) {
                      
                          $item_array[$item_pair]++;  
                          $temp1++ ; 
                        
                    }
                }
                echo '<th scope="row">'.$no.'</th>';
                echo '<td>' . $item_pair.'</td>';
                echo '<td>' . $temp1.'</td>';
                $con = 0;
                foreach ($item as $value) {
                    $temp2 = $total_per_item[$value] = 0;
                    foreach($belian as $item_belian) {            
                        if(strpos($item_belian, $value) !== false) {
                           $total_per_item [$value]++;
                          $temp2++ ; 
                        
                    }
                }
                //echo 'value= '.$value.' item= '.$item[$i].' temp2= '.$temp2.'<br>';
                if(($value == $item[$i]) || ($item[$i] == $value)){
                  //$con = ($temp1/$temp2);
                  if ($temp1 == 0) {
                      $hasil_bagi = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                      $con = ($temp1/$temp2);
                  }

                }
                
              }
                
                echo '<td>' . $con.'</td>';
                echo '</tr>';
                
                
              echo '</tbody>';
              $no++;

            }
        }
        
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
