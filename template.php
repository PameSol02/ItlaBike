<?php
class plantilla{

	static $instancia = null;

	static function iniciar(){
		self::$instancia = new plantilla();
	}

	function __construct(){
		?>
		<head>
			<title></title>
			<link href="css/css/bootstrap.min.css" rel="stylesheet">
			<link href="css/css/navbar.css" rel="stylesheet">

			<link rel="stylesheet" type="text/css" href="css/styles.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		</head>
		<body>

			<div class="row">
				<img src="images/ItlaBike.jpg" class="img-responsive col-md-12" width="1000" height="200">
			</div>

			<div id="custom-bootstrap-menu" class="navbar navbar-default container" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header"><a class="navbar-brand" href="#">ITLA BIKE</a>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse navbar-menubuilder">
						<ul class="nav navbar-nav navbar-left">
							<li><a href="">Inicio</a>
							</li>
							<li><a href="">Categorias</a>
							</li>
							<li><a href="">Mi cuenta</a>
							</li>
							<li><a href="">Nosotros</a>
							</li>
						</ul>

						<?php
						if (array_key_exists('usuarioId', $_SESSION)) {
								echo "

								<ul class=\"nav navbar-nav navbar-right\">
									<li>
										<a href=\"#IniciarSesion\" data-toggle=\"modal\" data-target=\"#iniciarsesio\">
										{$_SESSION[nombre]}
										</a>
									</li>
								</ul>";
							
						} else {
							echo <<<HTML

								<ul class="nav navbar-nav navbar-right">
									<li>
										<a href="#IniciarSesion" data-toggle="modal" data-target="#iniciarsesion">Iniciar Sesión</a>
									</li>
									<li>
										<a href="#NuevoUsuario" data-toggle="modal" data-target="#registro">Registrarme</a>
									</li>
								</ul>

HTML;
						}
						?>
					</div>
				</div>
			</div>

			<!-- Modal para registro-->
			<div id="registro" class="modal fade" role="dialog">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-primary">Registrarme</h4>
						</div>
						<form method="post" action="index.php">
							<div class="modal-body">
								<div>
									<div class="form-group">
										<label for="iNombre">Nombre</label>
										<input type="text" class="form-control" id="iNombre" name="iNombre">
									</div>
									<div class="form-group">
										<label for="iApellido">Apellido</label>
										<input type="text" class="form-control" id="iApellido" name="iApellido">
									</div>
									<div class="form-group">
										<label for="iEmail">Correo Electronico</label>
										<input type="email" class="form-control" id="iEmail" name="iEmail">
									</div>
									<div class="form-group">
										<label for="iPassword">Contraseña</label>
										<input type="password" class="form-control" id="iPassword" name="iPassword">
									</div>
									<div class="form-group">
										<label for="iConfirmPassword">Confirmar Contraseña</label>
										<input type="password" class="form-control" id="iConfirmPassword" name="iConfirmPassword">
									</div>
									<div class="form-group ">
										<label for="iCalle">Calle</label>
										<input type="text" class="form-control" id="iCalle" name="iCalle">
									</div>
									<div class="form-group ">
										<label for="iNumero">Numero</label>
										<input type="number" class="form-control" id="iNumero" name="iNumero">
									</div>
									<div class="form-group ">
										<label for="iProvincia">Provincia</label>
										<input type="text" class="form-control" id="iProvincia" name="iProvincia">
									</div>
									<div class="form-group ">
										<label for="iSector">Sector</label>
										<input type="text" class="form-control" id="iSector" name="iSector">
									</div>
									<div class="form-group ">
										<label for="iCiudad">Ciudad</label>
										<input type="text" class="form-control" id="iCiudad" name="iCiudad">
									</div>
									<div class="form-group ">
										<label for="iPais">Pais</label>
										<input type="text" class="form-control" id="iPais" name="iPais">
									</div>
									<div class="form-group">
										<label for="iTelefono">Teléfono</label>
										<input type="number" class="form-control" id="iTelefono" name="iTelefono">
									</div>
									<div class="form-group">
										<label for="iTelefonoAdicional">Teléfono Adicional</label>
										<input type="number" class="form-control" id="iTelefonoAdicional" name="iTelefonoAdicional">
									</div>
									<div class="form-group">
										<label for="iFoto">Foto de Perfil</label>
										<input type="file" id="iFoto">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="reset" class="btn btn-default btn-block" data-dismiss="modal"><span class="text-primary">Cancelar</span></button>
								<button type="submit" class="btn btn-primary btn-block">Registrarme</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal para iniciar sesion-->
			<div id="iniciarsesion" class="modal fade" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title text-primary">Iniciar Sesión</h4>
						</div>
						<form method="post">
							<div class="modal-body">
								<div>
									<div class="input-group">
										<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
										<input type="text" id="iEmailIniciar" class="form-control" placeholder="Email">
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-addon"><span class="glyphicon glyphicon-cog"></span></span>
										<input type="password" id="iPasswordIniciar" class="form-control" placeholder="Contraseña">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="reset" class="btn btn-default btn-block" data-dismiss="modal"><span class="text-primary">Cancelar</span></button>
								<input type="button" class="btn btn-primary btn-block" onclick="login();" value="Iniciar Sesión">
							</div>
						</form>
					</div>
				</div>
			</div>

			<?php
		}

		function __destruct(){
			?>

			<script src="css/js/bootstrap.min.js"></script>
			<script src="css/js/jquery.js"></script>
		</body>
		</html>

		<?php
	}
}
?>