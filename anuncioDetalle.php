<?php
include("template.php");
require_once('app/init.php');

plantilla::iniciar();

$hasAddress = false;
$addressArray = UserDB::getAddress($_SESSION['user_id']);
$address = new stdClass();
if ($addressArray != false){
	$address = $addressArray[0];
	$hasAddress = true;
}

if (isset($_GET)) {
	$id = $_GET['id'] + 0;

	$anuncio = UserDB::getAd($id);
	$images = UserDB::getAdImages($id);
	$usuario = UserDB::getUserData($_SESSION['user_id']);
}

$publicidad = UserDB::getPublicidad();
arsort($publicidad);

?>

<div class="container">
	<div class="col-md-7 col-xs-7">
	<h1 class="text-primary"><?php echo $anuncio->titulo ?></h1>
			<br>

		<div id="slider" class="carousel slide" data-ride="carousel">

		<!--Indicators-->
		<ol class="carousel-indicators">
			<?php
				$c = 0;
				while ($c < count($images)) {
					if ($c == 0) {
						echo <<<html
						<li data-target="slider" data-slide-to="0" class="active"></li>
html;
					} else {
						echo "<li data-target=\"slider\" data-slide-to=\"$c\"></li>";
					}

					$c = $c + 1;
				}
			?>
		</ol>
			<div class="carousel-inner">
				<?php
					$count = 0;
					foreach ($images as $image) {
						if ($count == 0) {
							echo <<<html
							
							<div class="item active">
								<img src="$image->image" class="img-responsive" alt="">
							</div>
html;
						$count = 1;
						} else {
							echo <<<html
							<div class="item">
								<img src="$image->image" class="img-responsive" alt="">
							</div>
html;
						}
					}
					$count = 0;
				?>
			</div>

			<!--Controls-->
			<a href="#slider" class="left carousel-control" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>

			<a href="#slider" class="right carousel-control" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>

		<br>
		<br>

		<div class="col-md-12 col-xs-12 row">
			<div class="col-md-3 col-xs-3">
				<h4 class="text-primary">Descripción: </h4>
			</div>
			<div class="col-md-9 col-xs-9">
				<p class="description">
					<?php echo $anuncio->descripcion;?>
				</p>
			</div>
		</div>
		<div class="col-md-12 col-xs-12 row">
			<div class="col-md-3 col-xs-3">
				<h4 class="text-primary">Categoria: </h4>
			</div>
			<div class="col-md-9 col-xs-9">
				<p class="description">
					<?php echo $anuncio->categoria;?>
				</p>
			</div>
		</div>
		<div class="col-md-12 col-xs-12 row">
			<div class="col-md-3 col-xs-3">
				<h4 class="text-primary">Marca: </h4>
			</div>
			<div class="col-md-9 col-xs-9">
				<p class="description">
					<?php echo $anuncio->marca;?>
				</p>
			</div>
		</div>
		<div class="col-md-12 col-xs-12 row">
			<div class="col-md-3 col-xs-3">
				<h4 class="text-primary">Modelo: </h4>
			</div>
			<div class="col-md-9 col-xs-9">
				<p class="description">
					<?php echo $anuncio->modelo;?>
				</p>
			</div>
		</div>
		<div class="col-md-12 col-xs-12 row">
			<div class="col-md-3 col-xs-3">
				<h4 class="text-primary">Precio: </h4>
			</div>
			<div class="col-md-9 col-xs-9">
				<p class="description">
					<?php echo "\$RD " . $anuncio->precio;?>
				</p>
			</div>
		</div>

		<div class="col-md-12 col-xs-12 ad">
			<h3 class="text-info">Contacto</h3>
			<br>
			<div class="col-md-3 col-xs-3">
				<img src="<?php echo $usuario->foto;?>" class="img-circle img-responsive">
			</div>
			<div class="col-md-9 col-xs-9">
				<h3 class="text-primary"><?php echo $usuario->nombre . " " . $usuario->apellido?></h3>
				<h5>Teléfono: <?php echo $usuario->telefono?></h5>
				<h5><?php echo $usuario->email?></h5>
				<?php if($hasAddress): ?>
					<h4><?php echo $address->calle . " #" . $address->numero . " " . $address->sector . " " . $address->ciudad;?></h4>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-md-offset-1">
	<?php
		foreach ($publicidad as $p) {
			echo "
				<a href=\"$p->link\"><img src=\"$p->foto\" class=\"img-responsive\"></a>
			<br>
			"; 
		}
	?>
</div>
</div>