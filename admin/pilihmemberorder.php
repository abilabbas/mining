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
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              
            </div>
          </div>

<div class="container">
      <div class="jumbotron mt-3">
        <h1>Cari Member</h1>
        <nav class="navbar navbar-light bg-light">
        <p class="lead">Cari member untuk order. Jika member belum ada klik  <a class="text-muted" href="addmember.php">Add Member</a> </p>
          <form action="<?php $_SERVER['PHP_SELF'];?>" method="get" class="form-inline">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search members" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
         </form>
        </nav>
      </div>
    </div>
<!--  -->




        
        <h4>Table Members</h4>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id User</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Alamat</th>
                  <th>Ponsel</th>
                  <th>Action</th>
                </tr>
              </thead>
<?php

if(isset($_GET['search']))
{
  $codesearch = $_GET['search'];
  
  $query = mysqli_query($conn, "SELECT * FROM member WHERE nama LIKE '%$codesearch%' OR email LIKE '%$codesearch%' OR alamat LIKE '%$codesearch%'"); 
  
  $jumlahsearch = mysqli_num_rows($query);

  for($i=1; $i<=$jumlahsearch; $i++)
  while($rows = mysqli_fetch_array($query))
  {
  
                echo '<tbody>';
                echo '<tr>';
                
                  echo '<td></td>';
                  echo '<td>' . $rows['id_member'].'</td>';
                  echo '<td>' . $rows['nama'].'</td>';
                  echo '<td>' . $rows['email'].'</td>';
                  echo '<td>' . $rows['alamat'].'</td>';
                  echo '<td>' . $rows['nohp'].'</td>';
                  echo '<td><a href="detailmember.php?code='.$rows["id_member"].'" class="badge badge-info">Detail</a> <a href="editmember.php?update='.$rows['id_member'].'" class="badge badge-secondary">Edit</a> <a href=d_member.php?code='.$rows["id_member"].'" class="badge badge-danger">Delete</a></td>';

                echo '</tr>';
                
                
              echo '</tbody>';
  }
}

  while($rows = mysqli_fetch_array($query))
  { 
                
                echo '<tbody>';
                echo '<tr>';
                  
                  echo '<td></td>';
                  echo '<td>' . $rows['id_member'].'</td>';
                  echo '<td>' . $rows['nama'].'</td>';
                  echo '<td>' . $rows['email'].'</td>';
                  echo '<td>' . $rows['alamat'].'</td>';
                  echo '<td>' . $rows['nohp'].'</td>';
                  echo '<td><a href="detailmember.php?code='.$rows["id_member"].'" class="badge badge-info">Detail</a> <a href="editmember.php?update='.$rows['id_member'].'" class="badge badge-secondary">Edit</a> <a href=d_member.php?code='.$rows["id_member"].'" class="badge badge-danger">Delete</a></td>';
                  
                echo '</tr>';
                
                
              echo '</tbody>';
              
              
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
