<?php include "../config.php";?>
<?php
	function jalan($sql){
		global $conn;
		$query = $conn->query($sql);

		//looping untuk mengambil setiap baris data
		while($hasil[] = $query->fetch_object());
		array_pop($hasil);
		return $hasil;
	}

	function ambilSemuaProductAda(){
		$sql = "Select * from product inner join 100_trans on 100_trans.stock_code=product.code group by 100_trans.stock_code";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilProductTesting(){
		$sql = "Select * from product inner join 100_trans on 100_trans.stock_code=product.code";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilProductTestingLimit($limit){
		$sql = "Select * from product inner join 100_trans on 100_trans.stock_code=product.code inner join category on category.id_category=product.id_category group by 100_trans.stock_code limit $limit";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilProductTestingCariLimit($limit,$cari){
		$sql = "Select * from product inner join 100_trans on 100_trans.stock_code=product.code inner join category on category.id_category=product.id_category where product.name like '%$cari%' group by 100_trans.stock_code limit $limit";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilRecentTestingLimit($limit){
		$sql = "Select * from product inner join 100_trans on 100_trans.stock_code=product.code order by 100_trans.id desc limit $limit  ";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilIndukYangAda(){
		$sql="SELECT category.id_parent from category inner join product on product.id_category=category.id_category inner join 100_trans on 100_trans.stock_code=product.code group by category.id_parent";
		$hasil=jalan($sql);
		return $hasil;
	}


	function ambilKategori($id){
		$sql ="select * from category where id_category = $id";
		$hasil = jalan($sql);
		return $hasil;
	}
	function ambilProductKategori($limit,$id){
		$sql = "select * from product inner join category on category.id_category = product.id_category where category.id_category=$id limit $limit";
		$hasil = jalan($sql);
		return $hasil;
	}
	function ambilRandomAda($n){
		$induk=ambilIndukYangAda();
		$ran=$induk[rand(0,count($induk)-1)]->id_parent;

		$sql = "select * from product inner join 100_trans on 100_trans.stock_code=product.code inner join category on category.id_category=product.id_category  where category.id_parent=$ran group by 100_trans.stock_code limit $n";
	
		$hasil = jalan($sql);
		return $hasil;

	}
	function ambilSingle($kode){
		$sql = "select * from product inner join category on category.id_category = product.id_category where product.code = '$kode'";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilSingleLoop($ini){
		$sql="select * from product inner join inisial on inisial.product_code = product.code inner join category on category.id_category=product.id_category where inisial.inisial = '".$ini."'";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilSingleLoopAda($ini){
		$sql="select * from product inner join  category on category.id_category=product.id_category inner join 100_trans on 100_trans.stock_code=product.code where 100_trans.ini='".$ini."' group by 100_trans.stock_code";
		$hasil = jalan($sql);
		return $hasil;
	}
	function ambilSales($kode){
		$sql ="select count(*) as jumlah from full_produk where stock_code = '$kode'";
		$hasil = jalan($sql);
		return $hasil;
	}

	function relatedProduct($kode){
		$sql="select * from 100_trans where stock_code='$kode' group by stock_code";
		$hasil=jalan($sql);
		if(count($hasil)!=0)
			$ini=$hasil[0]->ini;
		else
			return [];
		// $ini=ambilIniId($kode);
		$data=ambilConfWhere(2);
		$list=array();
		// echo $ini;
		foreach($data as $d){
			$a=explode(",",$d->seq);
			$awal=$a[0];
			if($ini==$awal){
				if(array_search($ini,$a)==0){
					for($j=0;$j<count($a);$j++){
						$list[]=$a[$j];
					}
				}

			}else{
				continue;
			}
		}
		$ll=array_values(array_unique($list));
		return $ll;
	}
	function ambilIniId($code){
		$sql = "select * from inisial where product_code = '$code'";
		$hasil = jalan($sql);
		return $hasil[0]->inisial;
	}

	function ambilConfWhere($idx){
		$arr=[" < 1"," = 1"," > 1 "];
		$sql = "select * from tt_fre_seq where l_rasio ".$arr[$idx];
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilProdukLimitAda($cat,$limit,$offset){
		$sql="select * from product inner join category on category.id_category=product.id_category inner join 100_trans on 100_trans.stock_code=product.code where category.id_parent=$cat group by product.code limit $limit ";
		$hasil=jalan($sql);
  		if(count($hasil)==0){
			$sql = "select * from product inner join category on category.id_category=product.id_category inner join 100_trans on 100_trans.stock_code=product.code where category.id_category=$cat group by product.code limit $limit ";
			$hasil = jalan($sql);
		}
		return $hasil;
	}
	function hapus_produk($id){
		global $conn;
		$sql= "delete from product where code='".$id."'";
		$delete=$conn->query($sql);
		if($delete == TRUE){
			setcookie('pesan_produk',2,time()+60,'/');
			header("location: v_produk.php");
		}else{
			setcookie('pesan_produk',1,time()+60,'/');
			header("location: v_produk.php");
		}
	}
	function ambilKatRandom($n){
		$sql = "SELECT product.id_category,category.category FROM `product` inner join category on category.id_category=product.id_category GROUP BY product.id_category limit $n";
		$hasil = jalan($sql);
		return $hasil;
	}
	function ambilInduk($n=null){
		if(!isset($n))
			$n=7;
		$sql = "select * from category where id_parent=0 limit $n";
		$hasil = jalan($sql);
		return $hasil;
	}
	function ambilSemuaKat(){
		$sql ="select * from category";
		$hasil = jalan($sql);
		return $hasil;
	}
	function ambilSemuaKatAda(){
		$sql ="select * from category inner join product on product.id_category=category.id_category inner join 100_trans on 100_trans.stock_code=product.code group by category.category";
		$hasil = jalan($sql);
		return $hasil;
	}
	function ambilInisialAda(){
		$sql="SELECT * FROM `tt_ini` inner join 100_trans on 100_trans.ini=tt_ini.ini inner join product on product.code=100_trans.stock_code group by tt_ini.ini";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function recentProductAda(){
		$sql ="SELECT * from product inner join 100_trans on 100_trans.stock_code=product.code inner join category on category.id_category=product.id_category group by 100_trans.stock_code order by product.price desc limit 5";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilVertikal($limit){
		$sql= "select * from transaksi LEFT JOIN member ON member.id_member = transaksi.id_member INNER JOIN layanan ON layanan.id_layanan = transaksi.id_layanan INNER JOIN produk ON produk.id_produk = transaksi.id_produk ORDER BY transaksi.id_member limit $limit";
		$hasil = jalan($sql);
		return $hasil;		
	}
	function ambilChildCat($id){
		$sql = "select * from category where id_parent=$id";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilChildCatAda($id){
		$sql="select category.id_category,category.category from category inner join product on product.id_category=category.id_category inner join 100_trans on 100_trans.stock_code=product.code where id_parent=$id group by category.category";
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilAdmin($username){
		$sql="select * from admin where username='".$username."'";
		$hasil=jalan($sql);
		return $hasil;
	}
	function tambah_produk(){
		global $conn;
		$true=1;
		foreach($_POST as $key => $p){
			if(empty($p))
			{
				$true=0;
				break;
			}
		}
		if($true==1){
			$sql="insert into product values ('".$_POST['kode']."','".$_POST['price']."','".$_POST['nama']."','".mysqli_real_escape_string($conn,$_POST['url'])."','".$_POST['kat']."')";
			echo $sql;
			$insert = $conn->query($sql);
			if($insert == TRUE){
				setcookie('pesan_tambah_produk',2,time()+60,'/');
				header("location: tambah_produk.php");
			}else{
				setcookie('pesan_tambah_produk',1,time()+60,'/');
				header("location: tambah_produk.php");
			}
		}else{
			setcookie('pesan_tambah_produk',0,time()+60,'/');
			header("location: tambah_produk.php");
		}
	}
	function tambah_category(){
		global $conn;
		$sql="insert into category values (NULL,'".$_POST['category']."','".$_POST['kat']."')";
		echo $sql;
		$insert = $conn->query($sql);
		if($insert == TRUE){
			setcookie('pesan_tambah_produk',2,time()+60,'/');
			header("location: tambah_category.php");
		}else{
			setcookie('pesan_tambah_produk',1,time()+60,'/');
			header("location: tambah_category.php");
		}
	}
	function edit_produk(){
		global $conn;
		$sql="update product set price=".$_POST['price'].",name='".$_POST['nama']."',url='".mysqli_real_escape_string($conn,$_POST['url'])."',id_category=".$_POST['kat']." where code='".$_GET['id']."'";
		echo $sql;
		$update=$conn->query($sql);
		if($update == TRUE){
			setcookie('pesan_tambah_produk',2,time()+60,'/');
			header("location: edit_produk.php?id=".$_GET['id']."");
		}else{
			setcookie('pesan_tambah_produk',1,time()+60,'/');
			header("location: edit_produk.php?id=".$_GET['id']."");
		}
	}
	function edit_category(){
		global $conn;
		$sql="update category set category='".$_POST['category']."',id_parent='".$_POST['kat']."' where id_category='".$_POST['id']."'";
		echo $sql;
		$update=$conn->query($sql);
		if($update == TRUE){
			setcookie('pesan_tambah_produk',2,time()+60,'/');
			header("location: edit_category.php?id=".$_POST['id']."");
		}else{
			setcookie('pesan_tambah_produk',1,time()+60,'/');
			header("location: edit_category.php?id=".$_POST['id']."");
		}	
	}
	function ambilSemuaAdmin(){
		$sql="select * from admin";
		$hasil=jalan($sql);
		return $hasil;
	}
	function login($username,$pass){
		$user=ambilAdmin($username);
		if(count($user)==1){
			$pass=md5($pass);
			$user=$user[0];

			if($user->username==$username && $user->password==$pass){
				session_start();
				$_SESSION['username']=$user->username;
				$_SESSION['user_id']=$user->id;
				header("location:index.php");
			}else{
				setcookie('pesan_login',2,time()+60,'/');
		        header("location: login.php");				
			}
		}else{
			setcookie('pesan_login',1,time()+60,'/');
	        header("location: login.php");
		}
	}
	function ambilTempSeq($id){
		$sql= "select * from tt_fre".$id."_seq"; 
		$hasil = jalan($sql);
		return $hasil;	
	}

	function ambilConf(){
		$sql = "select * from tt_fre_seq";
		$hasil = jalan($sql);
		return $hasil;	
	}
	
	function ambilConfWhereRasio($idx,$con){
		$arr=[" < 1"," = 1"," > 1 "];
		$sql = "select * from tt_fre_seq where l_rasio ".$arr[$idx]." and con >= ".$con;
		$hasil = jalan($sql);
		return $hasil;	
	}
	function ambilLengkapTemp($id){
		$sql = "select * from tt_fre_seq where id=$id";
		$hasil = jalan($sql);
		return $hasil;		
	}
	function cekIniAda($ini){
		$sql="select * from tt_fre1_seq inner join 100_trans on 100_trans.ini = tt_fre1_seq.seq inner join product on product.code=100_trans.stock_code where seq='".$ini."'";
		$hasil = jalan($sql);
		return $hasil;			
	}
	function cekIni2($ini){
		$sql = "select * from tt_fre_seq  where seq='".$ini."'";
		// echo $sql;
		$hasil = jalan($sql);
		return $hasil;	
	}
	function logout(){
		session_start();
		unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        session_destroy();
        header("location: login.php");
	}
?>