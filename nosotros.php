<?php
include("template.php");
require_once('app/init.php');

plantilla::iniciar();

$publicidad = UserDB::getPublicidad();
arsort($publicidad);

?>

<div class="container">
	<div class="col-md-7">
		<h2>Nosotros</h2>
		<p>
			Somos una página web que ofrece la publicación gratuita de ofertas sobre bicicletas o servicios para bicicletas. Una página que busca ser de ayuda para los ciclistas de Republica Dominicana y el mundo. Somos una plataforma donde usted tendrá la oportunidad de vender y comprar bicicletas de cualquier tipo.
		</p>
		<h2>Misión</h2>
		<p>
			Promover servicios e iniciativas innovadores y de calidad que busquen fomentar y apoyar el ciclismo tanto aficionado como profesional de la República Dominicana. Proporcionar un servicio eficiente y de calidad a todos nuestros clientes, con el fin de satisfacer totalmente las necesidades de compra y venta de productos relacionados al ciclismo. A través de la excelencia en el servicio y el sentido de compromiso con nuestra familia y nuestro País.  
		</p>
		<h2>Visión</h2>
		<p>
			Ser reconocidos como una de las páginas número 1 de ventas de productos relacionados al ciclismo del país.
		</p>
		<h2>Valores</h2>
		<p>
			<!---->
		</p>
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