<?php
session_start();
include("koneksi.php");
//include("cek-login.php");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("head.php"); ?>
</head>
<body class="hold-transition skin-purple fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <?php include("header.php"); ?>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <?php include("sidebar.php"); ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Halaman Utama
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <?php
        $total = 0;
        $gratis = 0;
        $subsidi = 0;
        $q = $database->query("select * from tbl_warga");
        while($warga = $q->fetch_array(MYSQLI_ASSOC)){
          $total++;
          if($warga['jenis']=='Gratis'){
            $gratis++;
          }else if($warga['jenis']=='Subsidi'){
            $subsidi++;
          }
        }
        ?>
        <div class="col-sm-4">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Database</span>
              <span class="info-box-number"><?php echo bilangan($total); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-sm-4">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Gratis</span>
              <span class="info-box-number"><?php echo bilangan($gratis); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-sm-4">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Subsidi</span>
              <span class="info-box-number"><?php echo bilangan($subsidi); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Grafik Persentase (%)</h3>
        </div>
        <div class="box-body">
          <div class="chart" id="database-chart" style="height: 400px; position: relative;"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <?php include("footer.php"); ?>
  </footer>

</div>
<!-- ./wrapper -->

<?php include("javascript.php"); ?>
<?php
$persen_gratis = ($gratis / $total) * 100;
$persen_subsidi = ($subsidi / $total) * 100;
?>
<script>
  //DONUT CHART
  var donut = new Morris.Donut({
    element: 'database-chart',
    resize: true,
    colors: ["#27a844", "#fec107"],
    data: [
      {label: "Gratis", value: <?php echo $persen_gratis; ?>},
      {label: "Subsidi", value: <?php echo $persen_subsidi; ?>},
    ],
    hideHover: 'auto'
  });
</script>
</body>
</html>
