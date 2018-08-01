<?php include "header.php";?>
<?php

		$minimumSupportCount = 10;
		$minConfidence = 60 * 0.01;
		$supportCount 	= array();
		$orderedFrequentItem = array();
	 

		if ($result = $conn->query("select layanan_name from layanan", MYSQLI_USE_RESULT)) {
			while ($i = $result->fetch_row()) {
				$item[] = $i[0];
			}
		    $result->close();
		}
	

		if ($result = $conn->query("select produk_name from produk", MYSQLI_USE_RESULT)) {
			while ($i = $result->fetch_row()) {
				$item[] = $i[0];
			}
		    $result->close();
		}
	

		if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
		    from transaksi left join layanan 
			 on (transaksi.id_layanan = layanan.id_layanan) left join produk
			 on (transaksi.id_produk = produk.id_produk) 
			 group by transaksi.id_member", MYSQLI_USE_RESULT)) {

			
			while ($b = $result->fetch_row()) {
				$belian[] = $b[0];
			}
			
		    $result->close();
		}
	
		if ($result = $conn->query("select group_concat(layanan.layanan_name , produk.produk_name )
		    from transaksi left join layanan 
			 on (transaksi.id_layanan = layanan.id_layanan) left join produk
			 on (transaksi.id_produk = produk.id_produk) 
			 group by transaksi.id_produk", MYSQLI_USE_RESULT)) {

			
			while ($b = $result->fetch_row()) {
				$produk[] = $b[0]; 
			}
			
		    $result->close();
		}



		$item1 = count($item) - 1; // minus 1 from count
	    $item2 = count($item);
	

	
		// MENDAPATKAN JUMLAH KEMUNCULAN BARANG
	    foreach ($item as $value) {
	        $total_per_item[$value] = 0;
	        foreach($belian as $item_belian) {            
	            if(strpos($item_belian, $value) !== false) {
	                $total_per_item[$value]++;
	            }
	        }
	    }
	


	    // MENDAPAT JUMLAH GABUNGAN
	    for($i = 0; $i < $item1; $i++) {
	        for($j = $i+1; $j < $item2; $j++) {
	            $item_pair = $item[$i].'|'.$item[$j]; 
	            $item_array[$item_pair] = 0;
	            foreach($belian as $item_belian) {
	                if((strpos($item_belian, $item[$i]) !== false) && (strpos($item_belian, $item[$j]) !== false)) {
	                    $item_array[$item_pair]++;
	                }
	            }
	        }
	    }
	    
		for($i = 0; $i < $item1; $i++) {
	        for($j = $i+1; $j < $item2; $j++) {
	            $item_pair = $item[$i].'|'.$item[$j]; 
	            $item_arrayMS[$item_pair] = 0;
	            foreach($belian as $item_belian) {
	                if((strpos($item_belian, $item[$i]) !== false) && (strpos($item_belian, $item[$j]) !== false)) {
						if ($item_array[$item_pair] >= $minimumSupportCount && $item_array[$item_pair] != 0)
						{
							$item_arrayMS[$item_pair]++;
						}
	                }

	            }
	        }
	    }

	    // MENDAPAT JUMLAH GABUNGAN
	    for($i = 0; $i < $item1; $i++) {
	        for($j = $i+1; $j < $item2; $j++) {
	            $item_pair = $item[$i].'|'.$item[$j]; 
	            $item_array[$item_pair] = 0;
	            foreach($belian as $item_belian) {
	                if((strpos($item_belian, $item[$i]) !== false) && (strpos($item_belian, $item[$j]) !== false)) {
	                    $item_array[$item_pair]++;
	                }
	            }
	        }
	    }

	    

//end SPADE

    echo "<pre>";
    echo "\r\nStep 1: Jumlah Mengikut Item\r\n";
    print_r($total_per_item);
    echo "\r\nStep 2: Jumlah Gabungan Item\r\n";
    print_r($item_array);
    echo "\r\nStep 3: Jumlah Gabungan Item Minimum Support\r\n";
    print_r($item_arrayMS);

    

    //echo "\r\nStep 3: Association Rule\r\n";
    
    // MENDAPATKAN KIRAAN UNTUK ASSOCIATION RULES
    //foreach ($item_array as $ia_key => $ia_value) {
        //$theitems = explode('|',$ia_key);
        //for($x = 0; $x < count($theitems); $x++) {
            //$item_name = $theitems[$x];
            //$item_total = $total_per_item[$item_name];
            //$in_float = $ia_value / $item_total;
            //$in_percent = round($in_float * 100, 2);
            //$alt_item = $theitems[ ($x + 1) % count($theitems)];
            //echo "[+] $ia_key($ia_value) --> $item_name($item_total) => ". $in_float ."\r\n";
            //echo "    ". $in_percent ."% yang membeli $item_name juga membeli $alt_item\r\n\r\n";
        //}
    //}
    echo "\r\nSupport Count\r\n";
    print_r($supportCount);
    echo "\r\nSenarai Item\r\n";
    print_r($item);
    echo "\r\nSenarai Belian\r\n";
    print_r(array_count_values($belian));

    echo "\r\nSenarai Produk\r\n";
    print_r($produk);


    // MENDAPATKAN KIRAAN UNTUK ASSOCIATION RULES
    foreach ($item_array as $ia_key => $ia_value) {
        $theitems = explode('-',$ia_key);
        for($x = 0; $x < count($theitems); $x++) {
            $item_name = $theitems[$x];
            $item_total = $total_per_item[$item_name];
            $in_float = $ia_value / $item_total;
            $in_percent = round($in_float * 100, 2);
            $alt_item = $theitems[ ($x + 1) % count($theitems)];
            echo "[+] $ia_key($ia_value) --> $item_name($item_total) => ". $in_float ."\r\n";
            echo "    ". $in_percent ."% yang membeli $item_name juga membeli $alt_item\r\n\r\n";
        }
    }
    echo "</pre>";

?>	


