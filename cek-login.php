<?php
if(empty($_SESSION['id_operator']) || !isset($_SESSION['id_operator'])){
	?>
	<script type="text/javascript">
		window.location = 'index.php';
	</script>
	<?php
}
$id = dekripsi($_SESSION['id_operator']);
$q = $database->query("select * from tbl_operator where id = '$id'");
if($hasil = $q->fetch_array(MYSQLI_ASSOC)){
	$username = $hasil['username'];
	$tambah = $hasil['tambah'];
	$ubah = $hasil['ubah'];
	$hapus = $hasil['hapus'];
}else{
	?>
	<script type="text/javascript">
		window.location = 'logout.php';
	</script>
	<?php
}
?>