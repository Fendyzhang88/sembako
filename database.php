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
        Database Sembako
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Database Sembako</h3>
          <div class="pull-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah</button>
            <a href="database-cetak.php">
              <button class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Cetak Excel</button>
            </a>
          </div>
        </div>
        <div class="box-body">
          <?php
          if($_SERVER['REQUEST_METHOD']=='POST'){
            if($_POST['status']=='tambah'){
              $no_kk = $_POST['no_kk'];
              $no_ktp = $_POST['no_ktp'];
              $nama = strtoupper($_POST['nama']);
              $alamat = strtoupper($_POST['alamat']);
              $no_kupon = $_POST['no_kupon'];
              $jenis = $_POST['jenis'];

              //cek kk sudah ada
              $q = $database->query("select * from tbl_warga where no_kk = '$no_kk'");
              if(!$warga = $q->fetch_array(MYSQLI_ASSOC)){
                $insert = $database->query("insert into tbl_warga values(NULL, '$no_kk', '$no_ktp', '$nama', '$alamat', '$no_kupon', '$jenis')");
                ?>
                <div class="alert alert-success">Data berhasil disimpan</div>
                <?php
              }else{
                ?>
                <div class="alert alert-danger">No KK sudah terdaftar mohon periksa kembali</div>
                <?php
              }
            }else if($_POST['status']=='ubah'){
              $id_warga = $_POST['id_warga'];
              $no_ktp = $_POST['no_ktp'];
              $nama = strtoupper($_POST['nama']);
              $alamat = strtoupper($_POST['alamat']);
              $no_kupon = $_POST['no_kupon'];
              $jenis = $_POST['jenis'];

              $update = $database->query("update tbl_warga set 
              no_ktp = '$no_ktp',
              nama = '$nama',
              alamat = '$alamat',
              no_kupon = '$no_kupon',
              jenis = '$jenis'
              where id = '$id_warga'");
              ?>
              <div class="alert alert-success">Data berhasil disimpan</div>
              <?php
            }else if($_POST['status']=='hapus'){
              $id_warga = $_POST['id_warga'];

              $delete = $database->query("delete from tbl_warga where id = '$id_warga'");
              ?>
              <div class="alert alert-success">Data berhasil disimpan</div>
              <?php
            }
            unset($_SERVER['REQUEST_METHOD']);
          }
          ?>
          <table id="data3" class="table table-bordered table-striped table-hover">
            <thead>
              <th width="5%">No</th>
              <th>No KK</th>
              <th>No KTP</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>No Kupon</th>
              <th>Jenis</th>
              <th>Opsi</th>
            </thead>
            <tbody>
              <?php
              $i = 1;
              $q = $database->query("select * from tbl_warga order by id desc");
              while($warga = $q->fetch_array(MYSQLI_ASSOC)){
                ?>
                <tr>
                  <td data-title="No"><?php echo $i; ?></td>
                  <td data-title="No KK"><?php echo $warga['no_kk']; ?></td>
                  <td data-title="No KTP"><?php echo $warga['no_ktp']; ?></td>
                  <td data-title="Nama"><?php echo $warga['nama']; ?></td>
                  <td data-title="Alamat"><?php echo $warga['alamat']; ?></td>
                  <td data-title="No Kupon"><?php echo $warga['no_kupon']; ?></td>
                  <td data-title="Jenis"><?php echo $warga['jenis']; ?></td>
                  <td data-title="Opsi">
                    <button class="btn btn-warning" data-toggle="modal" data-target="#ubah<?php echo $warga['id']; ?>"><i class="fa fa-pencil"></i> Ubah</button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#hapus<?php echo $warga['id']; ?>"><i class="fa fa-trash"></i> Hapus</button>
                  </td>
                </tr>
                <?php
                $i++;
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- Modal -->
      <div id="tambah" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Tambah Database</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="post">
                <input type="hidden" name="status" value="tambah">
                <div class="form-group">
                  <label class="col-sm-2 control-label">No KK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_kk" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">No KTP</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_ktp" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="alamat" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">No Kupon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_kupon" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jenis</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="jenis" required>
                      <option value="">--PILIH SALAH SATU--</option>
                      <option value="Gratis">Gratis</option>
                      <option value="Subsidi">Subsidi</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>

      <?php
      $q = $database->query("select * from tbl_warga order by id desc");
      while($warga = $q->fetch_array(MYSQLI_ASSOC)){
        ?>
        <!-- Modal -->
        <div id="ubah<?php echo $warga['id']; ?>" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ubah Database</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" method="post">
                  <input type="hidden" name="status" value="ubah">
                  <input type="hidden" name="id_warga" value="<?php echo $warga['id']; ?>">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">No KK</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="no_kk" value="<?php echo $warga['no_kk']; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">No KTP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="no_ktp" value="<?php echo $warga['no_ktp']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $warga['nama']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="alamat" required><?php echo $warga['alamat']; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">No Kupon</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="no_kupon" value="<?php echo $warga['no_kupon']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Jenis</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="jenis" required>
                        <option value="">--PILIH SALAH SATU--</option>
                        <option value="Gratis" <?php if($warga['jenis']=='Gratis'){ echo 'selected'; }?>>Gratis</option>
                        <option value="Subsidi" <?php if($warga['jenis']=='Subsidi'){ echo 'selected'; }?>>Subsidi</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>

        <!-- Modal -->
        <div id="hapus<?php echo $warga['id']; ?>" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hapus Database</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" method="post">
                  <input type="hidden" name="status" value="hapus">
                  <input type="hidden" name="id_warga" value="<?php echo $warga['id']; ?>">
                  <div class="form-group">
                    <div class="col-sm-12">
                      Apakah anda yakin ingin menghapus data <?php echo $warga['nama']; ?> ?
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-7">
                      <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Ya</button>
                      <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
        <?php
      }
      ?>

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
</body>
</html>
