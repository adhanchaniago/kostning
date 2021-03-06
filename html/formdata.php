<?php

  session_start();
  if(!isset($_SESSION["login"])){
  // echo $_SESSION["login"];
  header("Location: ../security/login.php");
  exit;
  }

  require '../atribut/fungsi.php';

  $jumlahdataperhalaman=4;

  $jumlahdata = count(query("SELECT * FROM kostning"));

  $jumlahhalaman = ceil($jumlahdata/$jumlahdataperhalaman);

  $halamanaktif = (isset($_GET["halaman"])?$_GET["halaman"]:1);

  $dataawal=($jumlahdataperhalaman*$halamanaktif)-$jumlahdataperhalaman;

  $kostning=query("SELECT * FROM kostning LIMIT $dataawal,$jumlahdataperhalaman");


  // $kostning=query("SELECT * FROM kostning");
  if (isset($_POST["cari"])) {
    $kostning = cari($_POST["keyword"]);
  }
  $d=1;
?>
<?php include '../atribut/head.php'; ?>
<body>
<header>
  <div class="overlay "></div>
  <div class="container h-100">
    <div class="d-flex h-100">
      <div class="w-100 "><br>

  <form action="../security/logout.php" class="logout">
    <button class="bg-danger fa fa-sign-out">Logout</button>
  </form><br>

  <div class="row">
    <div class="col-xs-8"><h1>Data Anak Kost</h1></div>
    <div class="col-xs-4">
      <form action="" method="post" class="form_cari pull-right input-group-button">
        <input type="text" autofocus placeholder="isinen bosss!!" name="keyword" size="15" > 
        <button type="submit" name="cari">Cari</button>
      </form>
    </div>
  </div>

  <div class="row">
    <?php foreach ($kostning as $row ) {
    ?>
    <div class="col-sm-6 ">
      <div class="panel panel-primary">
        <div class="panel-heading"><?php echo $row["nama"];?></div>
        <div class="panel-body">
          <div class="row ">
            <div class="col-sm-3">
              <!-- <img src="../img/pp.jpg" class="img-responsive img-rounded" style="height:200px" alt="Image"> -->
              <img src="../img/profile/<?php echo $row["gambar"];?>" style="height:200px" alt="Image" class="img-responsive img-rounded ">
            </div>
            <div class="col-sm-9">
              <div class="row">
                <b class="col-sm-4">Kampus</b> <b class="col-sm-8">: <?php echo $row["kampus"];?></b><br>
                <b class="col-sm-4">Jurusan</b> <b class="col-sm-8">: <?php echo $row["jurusan"];?></b><br>
                <b class="col-sm-4">Alamat</b> <b class="col-sm-8">: <?php echo $row["alamat"];?></b><br>
                <b class="col-sm-4">Telp</b> <b class="col-sm-8">: <?php echo $row["telp"];?></b><br>
                <b class="col-sm-4">Thn_Tinggal</b> <b class="col-sm-8">: <?php echo $row["tahun"];?></b>
              </div>
            </div>     
          </div>
        </div>
      </div>
    </div>
        <?php }?>
  </div>

<form class="aksi text-center panel panel-footer">
  <!--navigasi-->
  <?php if ($halamanaktif>1): ?>
    <a href="?halaman=<?= $halamanaktif-1 ?>" style="font-weight: bold;color: blue">&laquo;</a>
  <?php endif; ?>

  <?php for($i=1; $i<=$jumlahhalaman; $i++){ ?>
    <?php if($i == $halamanaktif): ?>
      <a href="?halaman=<?= $i; ?>" style="font-weight: bold;color: black; font-size: 19px"><?php echo $i; ?></a>
    <?php else: ?>
      <a href="?halaman=<?= $i; ?>" style="font-weight: bold;color: blue; font-size: 15px"><?php echo $i; ?></a>
    <?php endif; ?>
  <?php } ?>

  <?php if($halamanaktif<$jumlahhalaman): ?>
    <a href="?halaman=<?= $halamanaktif+1 ?>" style="font-weight: bold;color: blue">&raquo;</a>
  <?php endif ?>
</form><br>

      </div>
    </div>
  </div>
</header>

</body>
<?php include '../atribut/foot.php'; ?>