<?php
    error_reporting(0);
    include 'db.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin 
    WHERE admin_id = 1");
    $a= mysqli_fetch_object($kontak);
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
    <h1>WARUNG WANSUR</h1>
    <ul>
        <a href="index.php">Beranda</a>
        <li><a href="produk.php">Produk</a></li>
        <?php if(isset($_SESSION["pelanggan"])):?>
        <li><a href="logout.php"></a>Logout</li>     
        <?php else:?>
        <li><a href="login-pelanggan.php">Login</a></li>
        <?php endif?>
     
    </ul>
    </div>
 </header>
<!-- search -->
<div class="search">
    <div class="container">
        <form action="produk.php" >
            <input type="text" name="search" placeholder="Cari Produk" value ="<?php echo $_GET['search']?>" required>
            <input type="hidden" name="kat" value ="<?php echo $_GET['kat']?>">
            <input type="submit" name="cari" value="Cari Produk">
        </form> 
      </div>
    </div>
    
  
        <!-- new product -->
        <div class="section">
            <div class="container">
                <h3>Produk </h3>
             <div class="box">
                <?php
                    if($_GET['search'] != '' || $_GET['kat'] !=''){
                        $where = "AND product_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
                    }
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY product_id DESC
                    ");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                    <a href="detail-produk.php?id=<?php echo $p['product_id']?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['product_image'] ?>">
                            <p class="nama"><?php echo substr($p['product_name'],0,30)?></p>
                            <p class="harga">Rp.<?php echo number_format($p['product_price'])?></p>
                            </div>
                     </a>
                    <?php }}else{ ?>
                        <p>Produk tidak ada</p>
                    <?php  } ?>
             </div>
            </div>
        </div>
        <!-- footer -->
        <div class="footer">
            <div class="container">
                <h4>Alamat</h4>
                <p><?php echo $a->admin_address?></p>

                <h4>Email</h4>
                <p><?php echo $a->admin_email?></p>

                <h4>No. Hp</h4>
                <p><?php echo $a->admin_telp?></P>
                <small>Copyright &copy; 2022 - Husni tamrin</small>
            </div>
        </div>
</body>
</html>