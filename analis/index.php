<?php include "header.php";?>


    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="orders.php">
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
            <h1 class="h2">Dashboard Analis</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
               
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
          
    </main>
  </div>
</div>
<!--  -->



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
