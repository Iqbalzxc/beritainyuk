<?php 
if(isset($_POST['tambahkategori']))
{

	global $connect;

	$hasil = mysqli_query($connect,"INSERT INTO kategori (Kategori,Terbit) VALUES ('".$_POST['kategori']."','".$_POST['terbit']."') ");
}

if(isset($_POST['editkategori']))
{

	global $connect;

	$hasil = mysqli_query($connect,"UPDATE kategori SET Kategori='".$_POST['kategori']."',Terbit='".$_POST['terbit']."' WHERE ID='".$_POST['ID']."' ");

}


if (isset($_GET['act']) && $_GET['act'] == 'edit') {

	$id = (int)$_GET['id'];
	
	global $connect;
	$sql = mysqli_query($connect,"SELECT * FROM kategori WHERE ID = '$id' ");
	while($r = mysqli_fetch_array($sql)) {
		extract($r);

		$kategori = $Kategori;
		$terbit = $Terbit;
		$ID = $ID;
	}

}

if (isset($_GET['act']) && $_GET['act'] == 'hapus') {

	$id = (int)$_GET['id'];

	global $connect;

	$sql = mysqli_query($connect,"DELETE FROM kategori WHERE ID = '$id' ");

	header('Location:./?mod=kategori');

}

 ?>

<div class="w100">
	<form action="./?mod=kategori" method="POST">

		<input type="hidden" name="ID" value="<?=(isset($ID) ? $ID : '');?>">

		<fieldset>
			<legend>Tambah Kategori</legend>

			<div class="formnama w30">Kategori:<br>
			<input type="text" name="kategori" placeholder="Nama Kategori" value="<?=(isset($kategori) ? $kategori : '');?>" class="form100" required>
			</div>

			<div class="formnama w30">Tampilkan:<br>

				<select name="terbit">
					<option value="1" <?=((isset($terbit) && $terbit==1) ? 'selected' : ''); ?>>Yes</option>
					<option value="0" <?=((isset($terbit) && $terbit==0) ? 'selected' : ''); ?>>No</option>
				</select>

			</div>

			<input type="submit" name="<?=(isset($ID) ? 'editkategori' : 'tambahkategori');?>" value="<?=(isset($ID) ? 'Edit' : 'Tambah');?>" class="btn-primary">
		</fieldset>
	</form>
	
</div>
<div class="clear"></div>

<div class="w100">
		<fieldset>
			<legend>List Kategori</legend>

			<div class="w100 fl list bg_dark">
				<div class="w5 fl center">ID</div>
				<div class="w50 fl">Kategori Name</div>
				<div class="w40 fr">Aksi</div>
				<div class="clear"></div>
			</div>

			<?php 

			global $connect;

			$sql = mysqli_query($connect,"SELECT * FROM kategori ORDER BY ID DESC");
			while($r = mysqli_fetch_array($sql))
			{
				extract($r);
			?>

			<div class="w100 fl list">
				<div class="w5 fl center"><?=$ID?></div>
				<div class="w50 fl"><?=$Kategori?></div>
				<div class="w40 fr">
					<a href="./?mod=kategori&act=edit&id=<?=$ID?>" class="btn btn-primary small">Edit</a> <a href="./?mod=kategori&act=hapus&id=<?=$ID?>" class="btn btn-red small">Delete</a> 

				</div>
				<div class="clear"></div>
			</div>

			<?php 
			}
			 ?>

		</fieldset>
</div>
<div class="clear"></div>
