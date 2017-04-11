<?php
include("template.php");
include("database/userDB.php");
require_once('app/init.php');
plantilla::iniciar();

$hasAddress = false;
$addressArray = UserDB::getAddress($_SESSION['user_id']);
$address = new stdClass();
if ($addressArray != false){
	$hasAddress = true;
	$address = $addressArray[0];
}

if ($_POST) {

	if (isset($_POST['isAddress'])) {
		$address = new stdClass();

		$address->calle = $_POST['iCalle'];
		$address->numero = $_POST['iNumero'];
		$address->provincia = $_POST['iProvincia'];
		$address->sector = $_POST['iSector'];
		$address->ciudad = $_POST['iCiudad'];
		$address->pais = $_POST['iPais'];
		$address->usuarioId = $_SESSION['user_id'];

		$success = false;
		if ($hasAddress) {
			$response = UserDB::updateAddress($address);
			$success = $response;
		} else {
			$response = UserDB::insertAddress($address);
			$success = $response;
		}

		if ($success == true) {
			echo "<script type=\"text/javascript\">alert('Su dirección se ha guardado exitosamente.')</script>";
		} else {
			echo "<script type=\"text/javascript\">alert('Ha ocurrido un error guardando los datos.')</script>";
		}

	} else {
		$user = new stdClass();

		$user->nombre = $_POST['iNombre'];
		$user->apellido = $_POST['iApellido'];
		$user->foto = $_SESSION['user_image'];

		$response = UserDB::updateUserData($user);

		if ($response) {
			echo "<script type=\"text/javascript\">alert('Sus datos han sido actualizados.')</script>";
		} else {
			echo "<script type=\"text/javascript\">alert('Ha ocurrido un error guardando los datos.')</script>";
		}
	}
}

if (isset($_GET['addId'])) {
	$id = $_GET['addId'] + 0;

	$rs = UserDB::deleteAdd($id);

	if ($rs) {
		echo "<script type=\"text/javascript\">alert('El anuncio se ha eliminado exitosamente.')</script>";
	} else {
		echo "<script type=\"text/javascript\">alert('Ha ocurrido un error eliminando el anuncio.')</script>";
	}
}

$userAds = UserDB::getUserAd($_SESSION['user_id']);
?>

<div class="container">
	<div class="col-md-7 col-xs-7">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">Profile</a></li>
			<li class=""><a href="#address" data-toggle="tab" aria-expanded="false">Mi direccion</a></li>
			<li class=""><a href="#home" data-toggle="tab" aria-expanded="false">Mis anuncios</a></li>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade active in" id="profile">
				<br>
				<br>
				<div class="col-md-12 col-xs-12">
					<div class="col-md-3 col-xs-3">
						<img src="<?php echo $_SESSION['user_image'];?>" class="img-circle">
					</div>
					<div class="col-md-9 col-xs-9">
						<form method="post" action="profile.php" class="form-horizontal">
							<div class="form-group">
								<label for="iNombre" class="col-lg-2 control-label text-primary">Nombre</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" id="iNombre" name="iNombre" placeholder="Nombre" value="<?php echo $_SESSION['user_name'];?>">
								</div>
							</div>
							<div class="form-group">
								<label for="iApellido" class="col-lg-2 control-label text-primary">Apellido</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" id="iApellido" name="iApellido" placeholder="Apellido" value="<?php echo $_SESSION['user_lastName'];?>">
								</div>
							</div>
							<div class="form-group">
								<label for="iEmail" class="col-lg-2 control-label text-primary">Email</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" id="iEmail" name="iEmail" placeholder="Email" readonly value="<?php echo $_SESSION['user_email'];?>">
								</div>
							</div>
							<div class="form-group">
								<label for="iFoto" class="col-lg-2 control-label text-primary">Foto</label>
								<div class="col-lg-10">
									<input type="file" name="iFoto" id="iFoto" class="form-control">
								</div>
							</div>
							<button type="submit" class="btn btn-success">Guardar</button>
						</form>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="home">
				<?php if(count($userAds > 0)): ?>
				<table class="table table-striped table-hover">
					<thead>
					    <tr>
					    	<th>ID</th>
					      	<th>Título</th>
					      	<th>Modelo</th>
					      	<th>Marca</th>
					      	<th></th>
					    </tr>
					</thead>
				    <tbody>
				    <?php  
				    	foreach ($userAds as $ad) {
				    		$deleteLink = "profile.php?addId=" . $ad->anuncioId;
				    		$editLink = "anuncio.php?id=" . $ad->anuncioId;
				    		echo <<<html
							
							<tr class="info">
								<td>$ad->anuncioId</td>
								<td>$ad->titulo</td>
								<td>$ad->modelo</td>
								<td>$ad->marca</td>
								<td>
									<a href="$deleteLink" class="btn btn-danger">Eliminar</a>
									<a href="$editLink" class="btn btn-success">Editar</a>
								</td>
							</tr>
html;
				    	}
				    ?>
				    </tbody>
				</table>
				<?php endif; ?>
			</div>
			<div class="tab-pane fade" id="address">
				<br>
				<br>
				<form class="form-horizontal" method="post" action="profile.php">
					<div class="form-group ">
						<label for="iCalle" class="col-lg-2 control-label text-primary">Calle</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="iCalle" name="iCalle" value="<?php if ($hasAddress) { echo $address->calle;}?>">
						</div>
					</div>
					<div class="form-group ">
						<label for="iNumero" class="col-lg-2 control-label text-primary">Numero</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="iNumero" name="iNumero" value="<?php if ($hasAddress) { echo $address->numero;}?>">
						</div>
					</div>
					<div class="form-group ">
						<label for="iProvincia" class="col-lg-2 control-label text-primary">Provincia</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="iProvincia" name="iProvincia" value="<?php if ($hasAddress) { echo $address->provincia;}?>">
						</div>
					</div>
					<div class="form-group ">
						<label for="iSector" class="col-lg-2 control-label text-primary">Sector</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="iSector" name="iSector" value="<?php if ($hasAddress) { echo $address->sector;}?>">
						</div>
					</div>
					<div class="form-group ">
						<label for="iCiudad" class="col-lg-2 control-label text-primary">Ciudad</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="iCiudad" name="iCiudad" value="<?php if ($hasAddress) { echo $address->ciudad;}?>">
						</div>
					</div>
					<div class="form-group ">
						<label for="iPais" class="col-lg-2 control-label text-primary">Pais</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="iPais" name="iPais" value="<?php if ($hasAddress) { echo $address->pais;}?>">
						</div>
					</div>
					<div class="form-group">
						<input type="text" name="isAddress" value="1" hidden>
					</div>
					<button type="submit" class="btn btn-success col-md-offset-10">Guardar</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript"></script>

<!-- </div>
	<div class="col-md-4 col-md-offset-1">
		<img src="images/anuncio.jpg" class="img-responsive">
		<br>
		<img src="images/anuncio2.jpg" class="img-responsive">
	</div>
</div> -->