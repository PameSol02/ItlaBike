<?php
include("template.php");
require_once('app/init.php');

plantilla::iniciar();

$hasAd = false;
if (isset($_GET['id'])) {
	$id = $_GET['id'] + 0;

	$anuncio = UserDB::getAd($id);
	$hasAd = true;
}

if ($_POST) {
	$anuncio = new stdClass();

	$anuncio->categoria = $_POST['iCategoria'];
	$anuncio->titulo = $_POST['iTitulo'];
	$anuncio->descripcion = $_POST['iDescripcion'];
	$anuncio->precio = $_POST['iPrecio'];
	$anuncio->marca = $_POST['iMarca'];
	$anuncio->modelo = $_POST['iModelo'];

	if ($_POST['iAccion'] == 'Vender') {
		$anuncio->accion = '1';
	} else {
		$anuncio->accion = '2';
	}

	$images = array();

	if ($_FILES['iFoto1']['name'] != '') {
		$route = $_FILES['iFoto1']['tmp_name'];
		$destination = "images/adImages".$_FILES['iFoto1']['name'];
		copy($route, $destination);
		array_push($images, $destination);
	}

	if ($_FILES['iFoto2']['name'] != '') {
		$route = $_FILES['iFoto2']['tmp_name'];
		$destination = "images/adImages".$_FILES['iFoto2']['name'];
		copy($route, $destination);
		array_push($images, $destination);
	}

	if ($_FILES['iFoto3']['name'] != '') {
		$route = $_FILES['iFoto3']['tmp_name'];
		$destination = "images/adImages".$_FILES['iFoto3']['name'];
		copy($route, $destination);
		array_push($images, $destination);
	}

	if ($_FILES['iFoto4']['name'] != '') {
		$route = $_FILES['iFoto4']['tmp_name'];
		$destination = "images/adImages".$_FILES['iFoto4']['name'];
		copy($route, $destination);
		array_push($images, $destination);
	}

	if ($_FILES['iFoto5']['name'] != '') {
		$route = $_FILES['iFoto5']['tmp_name'];
		$destination = "images/adImages".$_FILES['iFoto5']['name'];
		copy($route, $destination);
		array_push($images, $destination);
	}

	$anuncio->images = $images;
	$anuncio->usuarioId = $_SESSION['user_id'];

	$success = false;
	if ($hasAd) {
		$anuncio->anuncioId = $id;
		var_dump($anuncio);
		$success = UserDB::updateAd($anuncio);
		var_dump($success);
	} else {
		$success = UserDB::insertAd($anuncio);
	}

	if ($success == true) {
		echo "<script type=\"text/javascript\">
			alert('Su anuncio ha sido creado exitosamente.!');
			window.location = 'index.php'; 
		</script>";
	} else {
		echo "<script type=\"text/javascript\">alert('Ha ocurrido un error creando su anuncio, por favor intente mas tarde.')</script>";
	}
	
}

?>

<div class="container">
	<h2>Publicar Anuncios</h2>
	<div class ="col-md-6">
		<form class="text-primary" enctype="multipart/form-data" autocomplete="off" method="post">
			<div class="form-group">
				<label for="iCategoria">Categoría:</label>
				<select class="form-control" id="iCategoria" name="iCategoria" required>
					<option value="Chopper">Chopper</option>
					<option value="Tandem">Tandem</option>
					<option value="Triathlon">Triathlon</option>
					<option value="DownHill">Down Hill</option>
					<option value="CrossCountry">Cross Country</option>
				</select>
			</div>
			<div class="form-group">
				<label for="iTitulo">Título:</label>
				<input type="text" class="form-control" id="iTitulo" name="iTitulo" placeholder="Título" required="required" value="<?php if($hasAd){ echo $anuncio->titulo;}?>">
			</div>
			<div class="form-group">
				<label for="iDescripcion">Descripción:</label>
				<textarea id="iDescripcion" class="form-control" name="iDescripcion" required rows="5"><?php if($hasAd){ echo $anuncio->descripcion;}?></textarea>
			</div>
			<div class="form-group">
				<label class="control-label" for="iPrecio">Precio:</label>
				<input type="number" name="iPrecio" id="iPrecio" class="form-control" required value="<?php if($hasAd){ echo $anuncio->precio;}?>">
			</div>
			<div class="form-group">
				<label for="iMarca">Marca:</label>
				<input type="text" class="form-control" id="iMarca" name="iMarca" placeholder="Marca" required="required" value="<?php if($hasAd){ echo $anuncio->marca;}?>">
			</div>
			<div class="form-group">
				<label for="iModelo">Modelo:</label>
				<input type="text" class="form-control" id="iModelo" name="iModelo" placeholder="Introduzca su provincia" required="required" value="<?php if($hasAd){ echo $anuncio->modelo;}?>">
			</div>
			<div class="form-group">
				<label for="iAccion">Acción:</label>
				<select class="form-control" id="iAccion" name="iAccion">
					<option value="Vender">Vender</option>
					<option value="Alquilar">Alquilar</option>
				</select>
			</div>
			<div class="form-group">
				<label>Imagenes:</label>
				<div class="">
					<label>Imagen 1</label>
					<input type="file" name="iFoto1" name="iFoto1" class="form-control">
					<label>Imagen 2</label>
					<input type="file" name="iFoto2" name="iFoto2" class="form-control">
					<label>Imagen 3</label>
					<input type="file" name="iFoto3" name="iFoto3" class="form-control">
					<label>Imagen 4</label>
					<input type="file" name="iFoto4" name="iFoto4" class="form-control">
					<label>Imagen 5</label>
					<input type="file" name="iFoto5" name="iFoto5" class="form-control">
				</div>
			</div>
			<div class="col-md-offset-8 col-xs-offset-8">
				<button type="primary" class="btn btn-default">Cancelar</button>
				<button type="info" class="btn btn-success">Guardar</button>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript"></script>