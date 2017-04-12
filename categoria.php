<?php
include("template.php");
include("database/userDB.php");
require_once('app/init.php');

plantilla::iniciar();

	$categoria = "";

	if (isset($_GET['c'])) {
		$categoria = $_GET['c'];
	}

	$ads = UserDB::getAdCategory($categoria);
	arsort($ads);

	$publicidad = UserDB::getPublicidad();
	arsort($publicidad);
?>

<div class="container">
	<?php

	if (count($ads) == 0) {
		echo <<<html
		<div class="col-md-7 col-xs-7">
			
		</div>
html;
	} else {

		foreach ($ads as $ad) {
			echo <<<html
			<div class="col-md-7 col-xs-7 well ad">
				<div class="col-md-3 col-xs-3">
					<img src="$ad->foto" class="img-responsive" width="100" height="100">
				</div>
				<div class="col-md-6 col-xs-6">
					<a href="anuncioDetalle.php?id=$ad->anuncioId"><span class="link">$ad->titulo</span></a>
					<p class="description">
						$ad->descripcion
					</p>
				</div>
				<div class="col-md-3">
					<label><span class="glyphicon glyphicon-asterisk"></span>\$RD $ad->precio</label>
					<br>
					<br>
					<br>
					<h5>$ad->fecha</h5>
				</div>
			</div>
html;
	}
}
?>
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