<?php include "header.php";?>

<?php

  if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
        from transaksi left join layanan 
       on (transaksi.id_layanan = layanan.id_layanan) left join produk
       on (transaksi.id_produk = produk.id_produk) 
       group by transaksi.id_order", MYSQLI_USE_RESULT)) {

      
      while ($b = $result->fetch_row()) {
        $trx[] = $b[0];
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
               
              </div>
              
            </div>
          </div>

        
<!--- grafik info ---->

<div class="container">
     
      <h4>Filter Frequent</h4>
        
       <!--  <p class="lead">Lakukan filter data untuk melihat hasil.</p> -->
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="GET" class="needs-validation" novalidate>

      <div class="form-group row">
                <div class="col-md-4 mb-3">
                      <label for="validationDefault02">Tanggal Awal</label>
                     
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
                <div class="col-md-2 mb-3">
                      <label for="validationDefault02">Min Confidence</label>
                      <input type="text" name="minCon" class="form-control" id="validationDefault02" placeholder="0" value="">
                </div>                 
                
      </div><!---end-->
      <div class="form-group row">
                <div class="col-md-4 mb-3">
                     <a class="btn btn-secondary my-2 my-sm-0" href="datasequence.php" role="button">Back</a>  
                      
                </div>
                <div class="col-md-4 mb-3">
                      <button name="caridata" class="btn btn-primary my-2 my-sm-0"  type="submit">Tampilkan Data</button> 
                </div>
                <div class="col-md-4 mb-3">
                      
                      <button type="submit" name="filter" class="btn btn-success my-2 my-sm-0"><i class="icofont">filter</i> Filter</button>

                </div>
                
      </div><!---end-->
      
</form>     
</div>        
<!--==========================-->

<div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 pt-1">
            
          </div>
          <div class="col-4 text-center">
            
          </div>
         
</div>

          

          
<!-- ============================================================= -->
<h4>Table Analisis</h4> 
<div class="table-responsive">
            <table class="table table-hover">
           
            <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Frequent</th>            
                  <th>Kemunculan</th> 
                  <th>Support</th> 
                  <th>Confidence</th> 
                  <th>Benchmark</th>
                  <th>Lift Ratio</th>
                  
                </tr>
              </thead>
<?php
if(isset($_GET['caridata']))
{
  $tglawal = $_GET['tglawal'];
  $tglakhir = $_GET['tglakhir'];
  $minSup = $_GET['minSup'];
  $minCon = $_GET['minCon'];

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
            $kondisi = "Harap input tanggal awal dan akhir <b>Klik <a href='dataconfidence.php'>Refresh</a></b> <br> ";
            echo '<div class="alert alert-danger" role="alert">';
            echo $kondisi;
            echo '</div>';
  } else {

        echo '<tbody>';    
         //TOTAL PER frequent
        $no =1;
        for($i = 0; $i < $item1; $i++) 
        {

            for($j = $i+1; $j < $item2; $j++) 
            {
                $item_pair = $item[$i].' <i class="icofont icofont-rotate-horizontal">arrow_right</i> '.$item[$j]; 
                $temp1 = $item_array[$item_pair] = 0;
                
                foreach($trx2 as $item_trx)
                {
                    if((strpos($item_trx, $item[$i]) !== false) && (strpos($item_trx, $item[$j]) !== false)) 
                    {
                      
                          $item_array[$item_pair]++;  
                          $temp1++ ; 
                    }
                }

                // menghitung jumlah item
                  foreach ($item as $value) 
                  {
                      $temp2 = $total_per_item[$value] = 0;
                      foreach($trx as $item_trx) 
                      {            
                          if(strpos($item_trx, $value) !== false) 
                          {
                             $total_per_item [$value]++;
                            $temp2++ ; 
                          }
                      }

                    //echo 'value= '.$value.' item= '.$item[$i].' temp2= '.$temp2.'<br>';
                    if(($value == $item[$i]) || ($item[$i] == $value)) //membandingkan item
                    {

                      //menghitung confidence
                      $con = 0;
                      if ($temp1 == 0) 
                      {
                          $hasil_bagi = "Tak terhingga ";
                      } else 
                      { //jika pembagi tidak 0
                          $con = (int)(($temp1/$temp2)*100);
                      }
                    }

                    if(($value == $item[$j]))
                    {
                      //mencari benchmark
                      $bench = 0;
                      if ($temp2 == 0 || $jumlahorder == 0) 
                      {
                        $hasil_bagi = "Tak terhingga ";
                      } else { //jika pembagi tidak 0
                        $bench = (int)(($temp2 / $jumlahorder)*100);
                        
                      }
                    } //end benchmark
                  }

                  //menghitung nilai support
                  $nsup = 0;
                  if ($temp1 == 0) 
                  {
                      $hasil = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                      $nsup = (int)(($temp1 / $jumlahorder)*100);       
                  }

                  //mencari lift ratio
                  $l_ratio = 0;
                  if ($con == 0 || $bench == 0) {
                    $hasil_bagi = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                    $l_ratio = ($con/$bench);
                  }

                if($con >= $minCon)
                {
                  if($nsup >= $minSup)
                  {
                    echo '<th scope="row">'.$no.'</th>';
                    echo '<td>' . $item_pair.'</td>'; //item frequent
                    echo '<td>' . $temp1.'</td>'; // jumlah kemunculan
                    echo '<td>' . $nsup.'%</td>'; //nilai support
                    echo '<td>' . $con.'%</td>'; //confidence
                    echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="<em>(Jumlah order mengandung <u>'.$item[$i].'</u> dan <u>'.$item[$j].'</u> / Total Order <u>'.$jumlahorder.'</u> )*100</em> = ( '.$temp1.' / '.$jumlahorder.' ) * 100">'. $bench.'%</td>';
                    echo '<td>'. number_format((float)$l_ratio, 1,'.','').'</td>';
                    echo '</tr>';
                    $no++; 
                  }
                } //endkondisiminsup
            } //endloop
        echo '</tbody>';
        } //endtotalperfrequent 
 }//endJikaNol
  if(isset($_GET['filter']))
  {

    $tglawal = $_GET['tglawal'];
    $tglakhir = $_GET['tglakhir'];

  }
  echo 'Periode: '.$tglawal .' s.d '. $tglakhir;
} 
  

if(isset($_GET['filter']))
{

  $minSup = $_GET['minSup'];
  $minCon = $_GET['minCon'];
  $tglawal = $_GET['tglawal'];
  $tglakhir = $_GET['tglakhir'];
  $tgl1 = $tglawal;
  $tgl2 = $tglakhir;

  echo 'Periode: '.$tgl1 .' s.d '. $tgl2;

  if($tgl1 != 0){
    if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
          from transaksi left join layanan 
         on (transaksi.id_layanan = layanan.id_layanan) left join produk
         on (transaksi.id_produk = produk.id_produk) 
         WHERE dateorder between '$tglawal' AND '$tglakhir' 
         group by transaksi.id_order", MYSQLI_USE_RESULT)) 
    {

        while ($b = $result->fetch_row()) 
        {
          $trx2[] = $b[0];
          $tgl1 = $tglawal;
          $tgl2 = $tglakhir;
        }
                  
        $result->close();
    }
  } else {

    if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
          from transaksi left join layanan 
         on (transaksi.id_layanan = layanan.id_layanan) left join produk
         on (transaksi.id_produk = produk.id_produk) 
         group by transaksi.id_order", MYSQLI_USE_RESULT)) 
    {

        while ($b = $result->fetch_row()) 
        {
        $trx2[] = $b[0];
        }          
        $result->close();
    }
  }



  if ($minSup == 0 && $minCon == 0) 
  {
      $kondisi = "Harap input nilai minimum support untuk melakukan filter <b>Klik <a href='dataconfidence.php'>Refresh</a></b> <br> ";
      echo '<div class="alert alert-danger" role="alert">';
      echo $kondisi;
      echo '</div>';
  } else { //jika inputan tidak 0 maka
      

        echo '<tbody>';    
         //TOTAL PER frequent
        $no =1;
        for($i = 0; $i < $item1; $i++) 
        {

            for($j = $i+1; $j < $item2; $j++) 
            {
                $item_pair = $item[$i].' <i class="icofont icofont-rotate-horizontal">arrow_right</i> '.$item[$j]; 
                $temp1 = $item_array[$item_pair] = 0;
                
                foreach($trx2 as $item_trx)
                {
                    if((strpos($item_trx, $item[$i]) !== false) && (strpos($item_trx, $item[$j]) !== false)) 
                    {
                      
                          $item_array[$item_pair]++;  
                          $temp1++ ; 
                    }
                }

                // menghitung jumlah item
                  foreach ($item as $value) 
                  {
                      $temp2 = $total_per_item[$value] = 0;
                      foreach($trx2 as $item_trx) 
                      {            
                          if(strpos($item_trx, $value) !== false) 
                          {
                             $total_per_item [$value]++;
                            $temp2++ ; 
                          }
                      }

                    //echo 'value= '.$value.' item= '.$item[$i].' temp2= '.$temp2.'<br>';
                    if(($value == $item[$i]) || ($item[$i] == $value)) //membandingkan item
                    {

                      //menghitung confidence
                      $con = 0;
                      if ($temp1 == 0) 
                      {
                          $hasil_bagi = "Tak terhingga ";
                      } else 
                      { //jika pembagi tidak 0
                          $con = (int)(($temp1/$temp2)*100);
                      }
                    }

                    if(($value == $item[$j]))
                    {
                      //mencari benchmark
                      $bench = 0;
                      if ($temp2 == 0 || $jumlahorder == 0) 
                      {
                        $hasil_bagi = "Tak terhingga ";
                      } else { //jika pembagi tidak 0
                        $bench = (int)(($temp2 / $jumlahorder)*100);
                        
                      }
                    } //end benchmark
                  }

                  //menghitung nilai support
                  $nsup = 0;
                  if ($temp1 == 0 || $jumlahorder == 0) 
                  {
                      $hasil = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                      $nsup = (int)(($temp1 / $jumlahorder)*100);       
                  }

                  //mencari lift ratio
                  $l_ratio = 0;
                  if ($con == 0 || $bench == 0) {
                    $hasil_bagi = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                    $l_ratio = ($con/$bench);
                  }

                if($con >= $minCon)
                {
                  if($nsup >= $minSup)
                  {
                    echo '<th scope="row">'.$no.'</th>';
                    echo '<td>' . $item_pair.'</td>'; //item frequent
                    echo '<td>' . $temp1.'</td>'; // jumlah kemunculan
                    echo '<td>' . $nsup.'%</td>'; //nilai support
                    echo '<td>' . $con.'%</td>'; //confidence
                    echo '<td>'. $bench.'%</td>';
                    echo '<td>'. number_format((float)$l_ratio, 1,'.','').'</td>';
                    echo '</tr>';
                    $no++; 
                  }
                } //endkondisiminsup
            } //endloop
          echo '</tbody>';
        } //endtotalperfrequent 
  } //endJikaNol 
} //endFilter
 else
{
  echo '<tbody>';    
         //TOTAL PER ITEM
        $no =1;
        for($i = 0; $i < $item1; $i++) 
        {

            for($j = $i+1; $j < $item2; $j++) 
            {
                $item_pair = $item[$i].' <i class="icofont icofont-rotate-horizontal">arrow_right</i> '.$item[$j]; 
                $temp1 = $item_array[$item_pair] = 0;
                
                foreach($trx as $item_trx) 
                {
                    if((strpos($item_trx, $item[$i]) !== false) && (strpos($item_trx, $item[$j]) !== false)) 
                    {
                      
                          $item_array[$item_pair]++;  
                          $temp1++ ; 
                    }
                }

                
                

                $nsup = 0;
                  if ($temp1 == 0) 
                  {
                      $hasil = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                      $nsup = (int)(($temp1 / $jumlahorder)*100);
                      
                  }

               

                  foreach ($item as $value) 
                {
                    $temp2 = $total_per_item[$value] = 0;
                    foreach($trx as $item_trx) 
                    {            
                        if(strpos($item_trx, $value) !== false) 
                        {
                           $total_per_item [$value]++;
                          $temp2++ ; 
                        }
                    }

                  //echo 'value= '.$value.' item= '.$item[$i].' temp2= '.$temp2.'<br>';
                  if(($value == $item[$i]) || ($item[$i] == $value))
                  {
                    //$con = ($temp1/$temp2);
                    $con = 0;
                    if ($temp1 == 0) {
                        $hasil_bagi = "Tak terhingga ";
                    } else { //jika pembagi tidak 0
                        $con = (int)(($temp1/$temp2)*100); //hitung mencari confidence
                        
                    }

                  }

                  if(($value == $item[$j])) //cek
                  {
                    //mencari benchmark
                    $bench = 0;
                    if ($temp2 == 0 || $jumlahorder == 0) 
                    {
                      $hasil_bagi = "Tak terhingga ";
                    } else { //jika pembagi tidak 0
                      $bench = (int)(($temp2 / $jumlahorder)*100);
                      
                    }
                  }//end benchmark

                } //end


                //mencari lift ratio
                $l_ratio = 0;
                if ($con == 0 || $bench == 0) {
                  $hasil_bagi = "Tak terhingga ";
                } else { //jika pembagi tidak 0
                  $l_ratio = ($con/$bench);

                }

                if($temp1 >= 1){
                echo '<th scope="row">'.$no.'</th>'; // nomor
                echo '<td>' . $item_pair.'</td>'; //item frequent
                echo '<td>' . $temp1.'</td>'; //jumlah kemunculan
                echo '<td>' . $nsup.'%</td>'; //nilai support      
                echo '<td>' . $con.'%</td>'; //confidence
                echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="<em>(Jumlah order mengandung <u>'.$item[$i].'</u> dan <u>'.$item[$j].'</u> / Total Order <u>'.$jumlahorder.'</u> )*100</em> = ( '.$temp1.' / '.$jumlahorder.' ) * 100">'. $bench.'%</td>'; //benchmark
                echo '<td>'. number_format((float)$l_ratio, 1,'.','').'</td>'; //lift ratio
                echo '</tr>';
                $no++; 
                } //minKemunculan = 1;

            }
        } 
  echo '</tbody>';
} //endELse        
?>
</table>
</div>

         

<!-- ==================================================================================================================================== -->

<h4>Table Rules</h4>
<div class="table-responsive">
            <table class="table table-hover">
           
        <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Rule</th>           
                  <th>Kemunculan</th> 
                  <th>Support</th>
                  <th>Confidence</th> 
                  <!-- <th>Benchmark</th> -->
                  <th>Lift Ratio</th>
                  
                </tr>
              </thead>
<?php
  
if(isset($_POST['caridata'])) //bagian rules ======================================================================================>
{
$tglawal = $_GET['tglawal'];
$tglakhir = $_GET['tglakhir'];
$minSup = $_POST['minSup'];
$minCon = $_POST['minCon'];

 
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
            
        $no =1;
        for($i = 0; $i < $item1; $i++) 
        {

            for($j = $i+1; $j < $item2; $j++) 
            {
                $item_pair = 'Jika Member memesan layanan <b>'. $item[$i].'</b> maka member akan memilih paket layanan <b>'.$item[$j].'</b>'; 
                $temp1 = $item_array[$item_pair] = 0;
                
                foreach($trx2 as $item_trx) 
                {
                    if((strpos($item_trx, $item[$i]) !== false) && (strpos($item_trx, $item[$j]) !== false)) 
                    {
                      
                          $item_array[$item_pair]++;  
                          $temp1++ ; 
                    }
                }

                //cari nilai support
                $nsup = 0;
                if ($temp1 == 0) {
                      $hasil = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                      $nsup = (int)(($temp1 / $jumlahorder)*100); 
                      
                  }

                //cari confidence
                $con = 0;
                foreach ($item as $value) 
                {
                    $temp2 = $total_per_item[$value] = 0;
                    foreach($trx2 as $item_trx) 
                    {            
                        if(strpos($item_trx, $value) !== false) 
                        {
                           $total_per_item [$value]++;
                          $temp2++ ; 
                        }
                    }
                    
                    //echo 'value= '.$value.' item= '.$item[$i].' temp2= '.$temp2.'<br>';
                    if(($value == $item[$i]) || ($item[$i] == $value))
                    {
                      //$con = ($temp1/$temp2);
                      if ($temp1 == 0) {
                          $hasil_bagi = "Tak terhingga ";
                      } else { //jika pembagi tidak 0
                          $con = (int)(($temp1/$temp2)*100);
                      }

                    }

                    if(($value == $item[$j]))
                    {
                      //mencari benchmark
                      $bench = 0;
                      if ($temp2 == 0 || $jumlahorder == 0) 
                      {
                        $hasil_bagi = "Tak terhingga ";
                      } else { //jika pembagi tidak 0
                        $bench = (int)(($temp2 / $jumlahorder)*100);
                        
                      }
                    }//end benchmark
                }

                //lift ratio
                $l_ratio = 0;
                if ($con == 0 || $bench == 0) {
                      $hasil_bagi = "Tak terhingga ";
                } else { //jika pembagi tidak 0
                      $l_ratio = $con/$bench;
                }

                if($con >= $minCon)
                {
                  if($nsup >= $minSup)
                  {
                   
                    echo '<th scope="row">'.$no.'</th>';
                    echo '<td data-toggle="tooltip" data-placement="top" title="dengan support '.$nsup.'% dan confidence '.$con.'%">' . $item_pair.'</td>'; //item rule
                    echo '<td>' . $temp1.'</td>'; //nilai item
                    echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="(Jumlah order mengandung <u>'.$item[$i].'</u> / total order)*100 = ( '.$temp1.' / '.$jumlahorder.' ) * 100">' . $nsup.'%</td>'; //nilai support                
                    if($item[$i] == 'Doormobil')
                    {               
                       echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="<em>(Jumlah order mengandung <u>'.$item[$i].'</u> dan <u>'.$item[$j].'</u> / Jumlah order mengandung <u>'.$item[$i].'</u> )*100</em> = ( '.$temp1.' / '.$totaldoormobil.' ) * 100">' . $con.'%</td>'; //confidence
                    } else {
                       echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="<em>(Jumlah order mengandung <u>'.$item[$i].'</u> dan <u>'.$item[$j].'</u> / Jumlah order mengandung <u>'.$item[$i].'</u> )*100</em> = ( '.$temp1.' / '.$totaldoormotor.' ) * 100">' . $con.'%</td>'; //confidence  
                    }//echo '<td>'. $bench.'</td>'; //benchmark
                    echo '<td data-toggle="tooltip" data-placement="top" data-html="true"  title="<em>Confidence / Benchmark</em> = '.$con.' / '.$bench.'">'. number_format((float)$l_ratio, 1,'.','').'</td>'; //lift ratio
                    echo '</tr>';
                      $no++; 
                  }
                } //endifMinSUp
                
              echo '</tbody>';
            }
        }

  } //endJikaNol 
    if(isset($_GET['filter'])) //FIlter dalam cari data ==================================================================>.
      {

        $tglawal = $_GET['tglawal'];
        $tglakhir = $_GET['tglakhir'];

      }
      echo 'Periode: '.$tglawal .' s.d '. $tglakhir;
} //endFilterRUle

elseif(isset($_GET['filter'])) //bagian rules
{
  $minSup = $_GET['minSup'];
  $minCon = $_GET['minCon'];
  $tglawal = $_GET['tglawal'];
  $tglakhir = $_GET['tglakhir'];
  $tgl1 = $tglawal;
  $tgl2 = $tglakhir;

  echo 'Periode: '.$tgl1 .' s.d '. $tgl2;

if($tgl1 != 0){
  if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
        from transaksi left join layanan 
       on (transaksi.id_layanan = layanan.id_layanan) left join produk
       on (transaksi.id_produk = produk.id_produk) 
       WHERE dateorder between '$tglawal' AND '$tglakhir' 
       group by transaksi.id_order", MYSQLI_USE_RESULT)) 
  {

      while ($b = $result->fetch_row()) {
      $trx3[] = $b[0];
      $tgl1 = $tglawal;
      $tgl2 = $tglakhir;
  }
                
      $result->close();
  }
} else {

  if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
        from transaksi left join layanan 
       on (transaksi.id_layanan = layanan.id_layanan) left join produk
       on (transaksi.id_produk = produk.id_produk) 
       group by transaksi.id_order", MYSQLI_USE_RESULT)) 
  {

      while ($b = $result->fetch_row()) {
      $trx3[] = $b[0];
  }
                
      $result->close();
  }
}


if ($minSup == 0 && $minCon == 0) {
    $kondisi = "Harap input nilai minimum support untuk mendapatkan rule. <b>Klik <a href='dataconfidence.php'>Refresh</a></b> <br> ";
      echo '<div class="alert alert-danger" role="alert">';
      echo $kondisi;
      echo '</div>';
} else { //jika pembagi tidak 0
    
        echo '<tbody>';    
            
        $no =1;
        for($i = 0; $i < $item1; $i++) 
        {

            for($j = $i+1; $j < $item2; $j++) 
            {
                
                $temp1 = $item_array[$item_pair] = 0;
                
                foreach($trx3 as $item_trx) 
                {
                    if((strpos($item_trx, $item[$i]) !== false) && (strpos($item_trx, $item[$j]) !== false)) 
                    {
                      
                          $item_array[$item_pair]++;  
                          $temp1++ ; 
                    }
                }

                //cari nilai support
                $nsup = 0;
                if ($temp1 == 0) {
                      $hasil = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                      $nsup = (int)(($temp1 / $jumlahorder)*100); 
                      
                  }

                //cari confidence
                $con = 0;
                foreach ($item as $value) 
                {
                    $temp2 = $total_per_item[$value] = 0;
                    foreach($trx3 as $item_trx) 
                    {            
                        if(strpos($item_trx, $value) !== false) 
                        {
                           $total_per_item [$value]++;
                          $temp2++ ; 
                        }
                    }
                    
                    //echo 'value= '.$value.' item= '.$item[$i].' temp2= '.$temp2.'<br>';
                    if(($value == $item[$i]) || ($item[$i] == $value))
                    {
                      //$con = ($temp1/$temp2);
                      if ($temp1 == 0) {
                          $hasil_bagi = "Tak terhingga ";
                      } else { //jika pembagi tidak 0
                          $con = (int)(($temp1/$temp2)*100);
                      }

                    }

                    if(($value == $item[$j]))
                    {
                      //mencari benchmark
                      $bench = 0;
                      if ($temp2 == 0 || $jumlahorder == 0) 
                      {
                        $hasil_bagi = "Tak terhingga ";
                      } else { //jika pembagi tidak 0
                        $bench = (int)(($temp2 / $jumlahorder)*100);
                        
                      }
                    } //end benchmark
                }


                //lift ratio
                $l_ratio = 0;
                if ($con == 0 || $bench == 0) {
                      $hasil_bagi = "Tak terhingga ";
                } else { //jika pembagi tidak 0
                      $l_ratio = $con/$bench;
                }

                $item_pair = 'Jika Member memesan layanan <b>'. $item[$i].'</b> maka member akan memilih paket layanan <b>'.$item[$j].'</b> dengan jumlah kemunculan sejumlah <i>'.$nsup.'%</i> dari total transaksi, dan kekuatan rule <i>'.$con.'%</i> dengan akurasi rule sebesar <i>'. number_format((float)$l_ratio, 1,'.','').'</i> '; 
                if($con >= $minCon)
                {
                  if($nsup >= $minSup)
                  {
                    echo '<th scope="row">'.$no.'</th>';
                    echo '<td data-toggle="tooltip" data-placement="top" title="dengan support '.$nsup.'% dan confidence '.$con.'%">' . $item_pair.'</td>'; //item rule
                    echo '<td>' . $temp1.'</td>'; //nilai item
                    echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="(Jumlah order mengandung <u>'.$item[$i].'</u> / total order)*100 = ( '.$temp1.' / '.$jumlahorder.' ) * 100">' . $nsup.'%</td>'; //nilai support                
                    if($item[$i] == 'Doormobil')
                    {               
                       echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="<em>(Jumlah order mengandung <u>'.$item[$i].'</u> dan <u>'.$item[$j].'</u> / Jumlah order mengandung <u>'.$item[$i].'</u> )*100</em> = ( '.$temp1.' / '.$totaldoormobil.' ) * 100">' . $con.'%</td>'; //confidence
                    } else {
                       echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="<em>(Jumlah order mengandung <u>'.$item[$i].'</u> dan <u>'.$item[$j].'</u> / Jumlah order mengandung <u>'.$item[$i].'</u> )*100</em> = ( '.$temp1.' / '.$totaldoormotor.' ) * 100">' . $con.'%</td>'; //confidence  
                    }
                    // echo '<td>'. $bench.'%</td>'; //benchmark
                    echo '<td data-toggle="tooltip" data-placement="top" data-html="true"  title="<em>Confidence / Benchmark</em> = '.$con.' / '.$bench.'">'. number_format((float)$l_ratio, 1,'.','').'</td>'; //lift ratio
                    echo '</tr>';
                      $no++; 
                  }
                } //endifMinSUp
                
              echo '</tbody>';
            }
        }

} //endFilterRUle

} //endJikaNol
else {

        echo '<tbody>';    
            
        $no =1;
        for($i = 0; $i < $item1; $i++) {

            for($j = $i+1; $j < $item2; $j++) {
                $item_pair = 'Jika Member memesan layanan <b>'. $item[$i].'</b> maka member akan memilih paket layanan <b>'.$item[$j].'</b>'; 
                $temp1 = $item_array[$item_pair] = 0;
                
                foreach($trx as $item_trx) {
                    if((strpos($item_trx, $item[$i]) !== false) && (strpos($item_trx, $item[$j]) !== false)) {
                      
                          $item_array[$item_pair]++;  
                          $temp1++ ; 
                        
                    }
                }

                $nsup = 0;
                if ($temp1 == 0) {
                      $hasil = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                      $nsup = (int)(($temp1 / $jumlahorder)*100);
                  }


                $con = 0;
                foreach ($item as $value) {
                    $temp2 = $total_per_item[$value] = 0;
                    foreach($trx as $item_trx) {            
                        if(strpos($item_trx, $value) !== false) {
                           $total_per_item [$value]++;
                          $temp2++ ; 
                        
                    }
                }

                //cari confidence
                //echo 'value= '.$value.' item= '.$item[$i].' temp2= '.$temp2.'<br>';
                if(($value == $item[$i]) || ($item[$i] == $value)){
                  //$con = ($temp1/$temp2);
                  if ($temp1 == 0) {
                      $hasil_bagi = "Tak terhingga ";
                  } else { //jika pembagi tidak 0
                      $con = (int)(($temp1/$temp2)*100);
                  }

                  }

                  if(($value == $item[$j]))
                  {
                    //mencari benchmark
                    $bench = 0;
                    if ($temp2 == 0 || $jumlahorder == 0) 
                    {
                      $hasil_bagi = "Tak terhingga ";
                    } else { //jika pembagi tidak 0
                      $bench = (int)(($temp2 / $jumlahorder)*100);
                      
                    }
                  }//end benchmark
                }

                //lift ratio
                $l_ratio = 0;
                if ($con == 0 || $bench == 0) {
                  $hasil_bagi = "Tak terhingga ";
                } else { //jika pembagi tidak 0
                  $l_ratio = $con/$bench;
                }

                if($temp1 >= 1){
                echo '<th scope="row">'.$no.'</th>';
                echo '<td data-toggle="tooltip" data-placement="top" title="dengan support '.$nsup.'% dan confidence '.$con.'%">' . $item_pair.'</td>'; //item rule
                echo '<td>' . $temp1.'</td>'; //nilai item
                echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="(Jumlah order mengandung <u>'.$item[$i].'</u> / total order)*100 = ( '.$temp1.' / '.$jumlahorder.' ) * 100">' . $nsup.'%</td>'; //nilai support                
                if($item[$i] == 'Doormobil')
                {               
                   echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="<em>(Jumlah order mengandung <u>'.$item[$i].'</u> dan <u>'.$item[$j].'</u> / Jumlah order mengandung <u>'.$item[$i].'</u> )*100</em> = ( '.$temp1.' / '.$totaldoormobil.' ) * 100">' . $con.'%</td>'; //confidence
                } else {
                   echo '<td data-toggle="tooltip" data-placement="top" data-html="true" title="<em>(Jumlah order mengandung <u>'.$item[$i].'</u> dan <u>'.$item[$j].'</u> / Jumlah order mengandung <u>'.$item[$i].'</u> )*100</em> = ( '.$temp1.' / '.$totaldoormotor.' ) * 100">' . $con.'%</td>'; //confidence  
                }//echo '<td>'. $bench.'</td>'; //benchmark
                echo '<td data-toggle="tooltip" data-placement="top" data-html="true"  title="<em>Confidence / Benchmark</em> = '.$con.' / '.$bench.'">'. number_format((float)$l_ratio, 1,'.','').'</td>'; //lift ratio
                
                echo '</tr>';
                  $no++; 
                } //endifMinKemnunculan
                
              echo '</tbody>';
                       

            }
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

    <script>$('#example').tooltip(options)</script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
      });


    </script>
  </body>
</html>
