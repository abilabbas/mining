<?php include "header.php";?>
<?php
    
    $min_support = 10;

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
    

    if ($result = $conn->query("select group_concat(member.id_member , transaksi.createdate , layanan.layanan_name , produk.produk_name separator ',')
            from transaksi left join layanan 
             on (transaksi.id_layanan = layanan.id_layanan) left join produk
             on (transaksi.id_produk = produk.id_produk) left join member
             on (transaksi.id_member = member.id_member) 
             group by transaksi.id_order order by transaksi.id_member", MYSQLI_USE_RESULT)) {
            
            while ($b = $result->fetch_row()) {
                $trx[] = $b[0];
            }
            $result->close();
        }

    // MENDAPATKAN JUMLAH KEMUNCULAN BARANG
        foreach ($item as $value) {
            $total_per_item[$value] = 0;
            foreach($trx as $item_trx) {            
                if(strpos($item_trx, $value) !== false) {
                    $total_per_item[$value]++;
                
                }
            }
        }

        $item1 = count($item) - 1; // minus 1 from count
        $item2 = count($item);
    

        // MENDAPAT JUMLAH GABUNGAN Item
        for($i = 0; $i < $item1; $i++) {
            for($j = $i+1; $j < $item2; $j++) {
                $item_pair = $item[$i].' | '.$item[$j]; 
                $item_array[$item_pair] = 0;
                //$item_arrayF[$item_pair] = 0;
                $item_arrayMS[$item_pair] = 0;
                foreach($trx as $item_trx) {
                    if((strpos($item_trx, $item[$i]) !== false) && (strpos($item_trx, $item[$j]) !== false)) {
                        
                        $item_array[$item_pair]++;
                       
                        $filteredArray = array_values(array_filter($item_array));  
                        $filterArray = array_filter($item_array, function ($var) {return (strpos($var, '0') === false); }); 
                             
                    }
                    if ($item_array[$item_pair] >= $min_support)
                        {
                            $item_arrayMS[$item_pair];
                        }

                }
            }
        }


        

       


    echo "<pre>";
    echo "Tranksaksi <br>";
    //print_r($trx );
    echo "Item <br>";
    //print_r($item );
    echo "Total Per Item <br>";
    //print_r($total_per_item);
    echo "JUMLAH GABUNGAN <br>";
    print_r($item_array);
    echo "Filter <br>";
    print_r($filteredArray);
    //print_r($item_arrayMS);

    echo "Filter Array<br>";
    print_r($filterArray);

    echo "\r\nStep 3: Jumlah Gabungan Item\r\n";
    
    foreach ($item_array as $ia_key => $ia_value) {
        $theitems = explode(' | ',$ia_key);
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

    echo $item_total;
    echo "</pre>";
?>