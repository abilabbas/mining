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
            <h1 class="h2">Members</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <!--<button class="btn btn-sm btn-outline-secondary">Share</button>-->
                <!--<button class="btn btn-sm btn-outline-secondary">Export</button>-->
              </div>
            </div>
          </div>

        
          <!--============================--> 
          <div class="dh brg">
          <!--============================--> 
            <div class="eq fp afd amk asi">
              <div class="brh bpn"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                <div class="ago">
                  <span class="bpi"><b>MEMBERS</b></span>
                  <h2 class="bph">
                   <?php echo $jumlahmember ; ?>
                    <small class="bpj bpk">
                    <?php
                      $persen = $jumlahmember /$jumlahmember;
                      $persen2 = round($persen *100);
                      echo $persen2.'%';
                    ?>
                    </small>

                  </h2>
                  <hr class="bpr aei">
                </div>
                <img src="../assets/img/download1.png" class="img-fluid" alt="Responsive image">
              </div>
            </div>
             <!--============================--> 
            <div class="eq fp afd amk asi">
              <div class="brh bpq"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                <div class="ago">
                  <span class="bpi"><b>DOORMOBIL COMPLETE</b></span>
                  <h2 class="bph">
                    <?php echo $jumlahdoormobil; ?>
                    <small class="bpj bpl">
                      <?php
                      $persen = $jumlahdoormobil /$totaldoormobil;
                      $persen2 = round($persen *100);
                      echo $persen2;
                    ?>%
                    </small>
                  </h2>
                  <hr class="bpr aei">
                </div>
                <img src="../assets/img/download2.png" class="img-fluid" alt="Responsive image">
              </div>
            </div>
            <!--============================-->
            <div class="eq fp afd amk asi">
              <div class="brh bpo"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                <div class="ago">
                  <span class="bpi"><b>DOORMOTOR COMPLETE</b></span>
                  <h2 class="bph">
                    <?php echo $jumlahdoormotor; ?>
                    <small class="bpj bpk">
                    <?php
                      $persen = $jumlahdoormotor /$totaldoormotor;
                      $persen2 = round($persen *100);
                      echo $persen2;
                    ?>%
                    </small>
                  </h2>
                  <hr class="bpr aei">
                </div>
                <img src="../assets/img/download3.png"  class="img-fluid" alt="Responsive image">
              </div>
            </div> 
            <!--============================-->
            <div class="eq fp afd amk asi">
              <div class="brh bpp"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                <div class="ago">
                  <span class="bpi"><b>TOTAL ORDER</b></span>
                  <h2 class="bph">
                    <?php echo $jumlahorder ; ?>
                    <small class="bpj bpl">
                    <?php
                      $persen = $jumlahorder/$jumlahorder;
                      $persen2 = round($persen *100);
                      echo $persen2;
                    ?>%
                    </small>
                  </h2>
                  <hr class="bpr aei">
                </div>
                <img src="../assets/img/download4.png" class="img-fluid" alt="Responsive image">
              </div>
            </div>
            <!--=============end===============-->
          
          </div><!--end dh brg-->


<div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-md-4 mb-3">
            <a href="addmember.php" ><button class="btn btn-success my-2 my-sm-0"><i class="icofont">plus</i> Add Member</button></a>
          </div>
          <div class="col-md-4 mb-3 text-center">
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
          
          <form action="<?php $_SERVER['PHP_SELF'];?>" method="get" class="col-4 d-flex justify-content-end align-items-center">
            <div class="btn-group mr-2">
            <input type="text" class="form-control bsx" name="search" placeholder="Search members">
             <button name="search1" class="btn btn-primary my-2 my-sm-0"  type="submit"><i class="icofont">search_1</i></button>
            </div>
          </form>
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
<br/>
        <h4>Table Members</h4>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="thead-light">
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
if(isset($_GET['search1']))
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
                  echo '<td><a href="detailmember.php?code='.$rows["id_member"].'" class="badge badge-info"><i class="icofont">ui_zoom_in</i> Detail</a> <a href="editmember.php?update='.$rows['id_member'].'" class="badge badge-secondary"><i class="icofont">edit</i> Edit</a> <a href=d_member.php?code='.$rows["id_member"].'" class="badge badge-danger"><i class="icofont">ui_delete</i></a></td>';

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
                  echo '<td><a href="detailmember.php?code='.$rows["id_member"].'" class="badge badge-info"><i class="icofont">ui_zoom_in</i> Detail</a> <a href="editmember.php?update='.$rows['id_member'].'" class="badge badge-secondary"><i class="icofont">edit</i> Edit</a> <a href=d_member.php?code='.$rows["id_member"].'" class="badge badge-danger"><i class="icofont">ui_delete</i></a></td>';
                  
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
  <hr><br>
  <div class="col-6 col-md-4">
  <nav aria-label="...">
  <!-- <ul class="pagination">
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
  </ul> -->
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
