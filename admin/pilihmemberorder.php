<?php include "header.php";?>



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
            <h1 class="h2">Add Order</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                
              </div>
              
            </div>
          </div>

<div class="container">
      <div class="jumbotron mt-3">
        <h1>Cari Member</h1>
       
        <p class="lead">Cari member untuk order. Jika member belum ada klik  <a class="text-muted" href="addmember.php">Add Member</a> </p>
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="GET" class="form-inline">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search members" >
          <button name="searchbtn" class="btn btn-outline-success my-2 my-sm-0"  type="submit">Search</button>

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
              <option value="<?php echo $jumlahmember; ?>">All</option>
            </select>
            <div class="input-group-append">
              <button name="maxrows2" class="btn btn-outline-secondary" type="submit">Rows</button>
            </div>
            </div>
            </form>
          </div>
          
</div>

<!--sort-->
<?php
  
  if(isset($_POST['maxrows2'])){
 
  $limit = $_POST['maxrows'];

  $query = mysqli_query($conn, "SELECT * FROM member LIMIT  $limit");
  //$queryorder = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN member ON member.id_member = transaksi.id_member INNER JOIN layanan ON layanan.id_layanan = transaksi.id_layanan INNER JOIN produk ON produk.id_produk = transaksi.id_produk ORDER BY transaksi.id_order ");
}
?>
<!--end sort-->


        
        <h4>Table Members</h4>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id User</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Ponsel</th>
                  <th>Action</th>
                </tr>
              </thead>
<?php

$i=1;
if(isset($_GET['search']))
{
  $codesearch = $_GET['search'];
  
  $query = mysqli_query($conn, "SELECT * FROM member WHERE nama LIKE '%$codesearch%' OR email LIKE '%$codesearch%'"); 
  
  $jumlahsearch = mysqli_num_rows($query);

  for($i=1; $i<=$jumlahsearch; $i++)
  while($rows = mysqli_fetch_array($query))
  {
  
                echo '<tbody>';
                echo '<tr>';
                
                  echo '<th scope="row">'.$i.'</th>';
                  echo '<td>' . $rows['id_member'].'</td>';
                  echo '<td>' . $rows['nama'].'</td>';
                  echo '<td>' . $rows['email'].'</td>';
                  echo '<td>' . $rows['nohp'].'</td>';
                  echo '<td><a href="orderform.php?code='.$rows["id_member"].'" ><button class="btn btn-success my-2 my-sm-0">Order</button></a>';
                 
                echo '</tr>';
                
                
              echo '</tbody>';
              $i++;
  }
}

  while($rows = mysqli_fetch_array($query))
  { 
                
                echo '<tbody>';
                echo '<tr>';
                  
                  echo '<th scope="row">'.$i.'</th>';
                  echo '<td>' . $rows['id_member'].'</td>';
                  echo '<td>' . $rows['nama'].'</td>';
                  echo '<td>' . $rows['email'].'</td>';
                  
                  echo '<td>' . $rows['nohp'].'</td>';
                   echo '<td><a href="orderform.php?code='.$rows["id_member"].'" ><button class="btn btn-success my-2 my-sm-0">Order</button></a>';
                 
                echo '</tr>';
                
                
              echo '</tbody>';
              $i++;              
  }
$jumlahsearch = mysqli_num_rows($query);
?>
            </table>
          </div>

<div class="row">
  <div class="col-12 col-md-8">Showing  <?php echo $jumlahsearch ; ?> of  <?php echo $jumlahmember ; ?> entries</div>
  <div class="col-6 col-md-4">
  <nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item ">
      <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>

        </main>
      </div>
    </div>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

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
