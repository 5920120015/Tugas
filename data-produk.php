<?php
session_start();
include 'db.php';
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WARUNG WANSUR</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="http://fonts.gogleapis.com/css2?familyQuicksand&display=swap" rel="stylesheet">
    
</head>
<body>
 <!-- header -->
 <header>
    <div class="container">
    <h1><a href="dashboard.php">WARUNG WANSUR</a></h1>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="Profil.php">Profil</a></li>
        <li><a href="data-Kategori.php">Data Kategory</a></li>
        <li><a href="data-Produk.php">Data Produk</a></li>
        <li><a href="keluar.php">Keluar</a></li>
    </ul>
    </div>
 </header>
 <!-- conten -->
 <div class="section">
 <div class="container">
    <h3>Data Produk</h3>
    <div class="box">
        <!-- tabel -->
    <table border="1" cellspacing="0" class="tabel">
    <tr>
        <th width="60px">No</th>
        <th>Kategori</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Setatus</th>
        <th width="150">Aksi</th>
    </tr>
    <body>
        <?php
        $no = 1;
        $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id)
        ORDER BY product_id DESC");

        if(mysqli_num_rows($produk) > 0){

        while ($row = mysqli_fetch_array($produk)) {
           
        
        ?>
     <tr>
        <td>    <?php echo   $no++  ?></td>
        <td>    <?php echo   $row   ['category_name']?></td>
        <td>    <?php echo   $row   ['product_name']?></td>
        <td> Rp.<?php echo   number_format($row['product_price']) ?></td>
        <td>    <a href="produk/<?php echo $row['product_image']?>" target="_blank"><img  src=  "produk/<?php echo $row['product_image']?>" width="50px"></a></td>
        <td>    <?php echo  ($row   ['product_status'] == 0)? 'Habis':'Ada';?></td>
       
       
        <td><button> <a href="edit-produk.php?id=<?php echo $row['product_id']?>">edit</a></button>|
        <button><a href="proses-hapus.php?idp=<?php echo $row['product_id']?>" onclick="return confirm('Yakin Ingin Hapus...?')">Hapus</a></td></button> 
        </td>
        </tr> 
     <?php }}else{?>
        <tr>
            <td clospan="7">Tidak Ada Data</td>
        </tr>  
    <?php }?>

    </body>
    </table><br>
    

    <button><p><a href="tambah-produk.php">Tambah Data</a></p></button> 
  


 </div>
 </div>

 </div>
<footer>
 <div class="container">
    <small>Copyright &copy; 2022 Husni tamrin</small>
    </footer>
    
 </div>
</body>
</html>