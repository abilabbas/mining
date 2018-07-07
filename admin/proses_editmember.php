<?php include "header.php";?>

<?php
  include "../config.php";
  if(isset($_POST['updatemember']))
  {
    $id_member= $_POST['id_member'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    

    $sql = "UPDATE member SET email='$email', nama='$nama', alamat='$alamat', nohp='$nohp' WHERE id_member='$id_member'";
    //$sql = mysqli_query($conn,"INSERT INTO member (email,nama,alamat,nohp,password) VALUES ('$email','$nama','$alamat','$nohp','$security')");
    $query = mysqli_query($conn, $sql);
    
    if( $query ) {
    header('Location: members.php');
    } else {
      die("Gagal menyimpan");
    }
}
else
{
  echo "data tidak ada";
}

?>


  
