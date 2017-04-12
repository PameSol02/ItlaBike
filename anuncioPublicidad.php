<?php 
include("template.php");
require_once('app/init.php');

plantilla::iniciar();

if (isset($_GET['id'])) {
	$id = $_GET['id'] + 0;

	UserDB::deletePublicidad($id);
}

if ($_POST) {

	$link = $_POST['iLink'];
	$foto = "";
	if ($_FILES['iFoto1']['name'] != '') {
		$route = $_FILES['iFoto1']['tmp_name'];
		$destination = "images/adImages".$_FILES['iFoto1']['name'];
		copy($route, $destination);
		$foto = $destination;
	}

	$success = UserDB::insertPublicidad($link, $foto);

	if ($success == true) {
		echo "<script type=\"text/javascript\">
			alert('Su anuncio ha sido creado exitosamente.!');
		</script>";
	} else {
		echo "<script type=\"text/javascript\">alert('Ha ocurrido un error creando su anuncio, por favor intente mas tarde.')</script>";
	}
}

$ads = UserDB::getPublicidad();
?>

<div class="container">
	<h2>Publicar publicidad</h2>
	<div class ="col-md-6">
		<form class="text-primary" enctype="multipart/form-data" autocomplete="off" method="post">
			<div class="form-group">
				<label for="iLink">Link:</label>
				<input type="text" class="form-control" id="iLink" name="iLink" placeholder="Link" required>
			</div>
			<div class="form-group">
				<label>Imagen </label>
				<input type="file" name="iFoto1" name="iFoto1" class="form-control" required>
			</div>
			<div class="col-md-offset-8 col-xs-offset-8">
				<button type="primary" class="btn btn-default">Cancelar</button>
				<button type="info" class="btn btn-success">Guardar</button>
			</div>
		</form>
	</div>

	<table class="table table-striped table-hover">
					<thead>
					    <tr>
					    	<th>ID</th>
					      	<th>Link</th>
					      	<th></th>
					    </tr>
					</thead>
				    <tbody>
				    <?php  
				    	foreach ($ads as $ad) {
				    		$deleteLink = "anuncioPublicidad.php?id=" . $ad->anuncioPublicitarioId;
				    		echo <<<html
							
							<tr class="info">
								<td>$ad->anuncioPublicitarioId</td>
								<td>$ad->link</td>
								<td>
									<a href="$deleteLink" class="btn btn-danger">Eliminar</a>
								</td>
							</tr>
html;
				    	}
				    ?>
				    </tbody>
				</table>
</div>