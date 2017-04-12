<?php
class plantilla{

	static $instancia = null;
	
	static function iniciarWithFBURL($fburl){
		self::$instancia = new plantilla($fburl);
	}

	static function iniciar() {
		self::$instancia = new plantilla();
	}

	function __construct($fburl = ""){
		?>
		<head>
			<title></title>
			<link href="css/css/bootstrap.min.css" rel="stylesheet">
			<link href="css/css/navbar.css" rel="stylesheet">

			<link rel="stylesheet" type="text/css" href="css/styles.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		</head>
		<body id="body">

			<div class="row">
				<img src="images/ItlaBike.jpg" class="img-responsive col-md-12">
			</div>

			<div id="custom-bootstrap-menu" class="navbar navbar-default container" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header"><a class="navbar-brand" href="index.php">ITLA BIKE</a>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse navbar-menubuilder">
						<ul class="nav navbar-nav navbar-left">
							<li><a href="index.php">Inicio</a>
							</li>
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categorias <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="categoria.php?c=chopper">Chopper</a></li>
									<li><a href="categoria.php?c=tandem">Tandem</a></li>
									<li><a href="categoria.php?c=triathlon">Triathlon</a></li>
									<li><a href="categoria.php?c=downhill">Down Hill</a></li>
									<li><a href="categoria.php?c=crosscountry">Cross Country</a></li>
								</ul>
							</li>
							<li><a href="nosotros.php">Nosotros</a>
							</li>
						</ul>
						<?php if (isset($_SESSION['usuarioId']) || isset($_SESSION['user_id'])): ?>
							<ul class="nav navbar-nav navbar-right">
								<li><a href="anuncio.php">Publica Anuncio</a></li>
								<?php if (isset($_SESSION['user_image']) && $_SESSION['user_image'] != ""): ?>
									<li>
										<img src="<?php echo $_SESSION['user_image'];?>" class="img-circle" width="50px" height="50px">
									</li>
								<?php else: ?>
									<li>
										<img src="images/profile.png" class="img-circle" width="50px" height="50px">
									</li>
								<?php endif; ?>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['user_name'];?> <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
										<li><a href="profile.php?id=<?php echo $_SESSION['user_id'];?>">Mi cuenta</a></li>
										<li class="divider"></li>
										<li><a href="logout.php">Cerrar Sesion</a></li>
									</ul>
								</li>
							</ul>
						<?php else: ?>
							<?php if (isset($_SESSION['is_admin'])): ?>
								<ul class="nav navbar-nav navbar-right">
									<li><a href="anuncioPublicidad.php">Publicar publicidad</a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['admin_name'];?> <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<li class="divider"></li>
											<li><a href="logout.php">Cerrar Sesion</a></li>
										</ul>
									</li>
								</ul>
							<?php else: ?>

								<ul class="nav navbar-nav navbar-right">
									<li>
										<a href="#IniciarSesion" data-toggle="modal" data-target="#iniciarsesion">Iniciar Sesión</a>
									</li>
									<li>
										<a href="#NuevoUsuario" data-toggle="modal" data-target="#registro">Registrarme</a>
									</li>
								</ul>

							<?php endif; ?>
					
						<?php endif; ?>
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
						<form method="post" action="index.php" class="text-primary">
							<div class="modal-body">
								<div>
									<div class="form-group">
										<label for="iNombre">Nombre</label>
										<input type="text" class="form-control" id="iNombre" name="iNombre" required>
									</div>
									<div class="form-group">
										<label for="iApellido">Apellido</label>
										<input type="text" class="form-control" id="iApellido" name="iApellido" required>
									</div>
									<div class="form-group">
										<label for="iEmail">Correo Electronico</label>
										<input type="email" class="form-control" id="iEmail" name="iEmail" required>
									</div>
									<div class="form-group">
										<label for="iPassword">Contraseña</label>
										<input type="password" class="form-control" id="iPassword" name="iPassword" required>
									</div>
									<div class="form-group">
										<label for="iTelefono">Teléfono</label>
										<input type="number" class="form-control" id="iTelefono" name="iTelefono" required>
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
						<form method="post" action="index.php">
							<div class="modal-body">
								<div>
									<div class="input-group">
										<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
										<input type="text" id="iEmailIniciar" name="iEmailIniciar" class="form-control" placeholder="Email" required>
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-addon"><span class="glyphicon glyphicon-cog"></span></span>
										<input type="password" id="iPasswordIniciar" name="iPasswordIniciar" class="form-control" placeholder="Contraseña" required>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="reset" class="btn btn-default btn-block" data-dismiss="modal"><span class="text-primary">Cancelar</span></button>
								<button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
								<a href="<?php echo $fburl?>"><img src="images/fblogin.png" class="img-responsive col-md-12 col-xs-6"></a>
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