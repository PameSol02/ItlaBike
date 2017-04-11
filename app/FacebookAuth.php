<?php
require_once("database/userDB.php");

	class FacebookAuth {
		protected $facebook;
		protected $facebookUrl = "http://localhost:9090/itlabike/callback.php";

		public function __construct(Facebook\Facebook $facebook) {
			$this->facebook = $facebook;
		}

		public function getHelper() {
			return $this->facebook->getRedirectLoginHelper();
		}

		public function getAuthUrl() {
			return $this->getHelper()->getLoginUrl($this->facebookUrl, array('email'));
		}

		public function isLogin() {
			return isset($_SESSION['user_id']);
		}

		public function login() {
			try {
				$response = $this->facebook->get('/me?fields=id,name,picture,email', $this->getHelper()->getAccessToken());

				//captura del usuario
				$usuario = $response->getGraphUser();

				$isEmailExits = UserDB::validateIfEmailExists($usuario['email']);

				if ($isEmailExits == false) {
					$result = UserDB::insertFacebookData($usuario['email'], $usuario['picture']['url'], $usuario['name']);
					$_SESSION['user_id'] = $result;
					$_SESSION['user_name'] = $usuario['name'];
					$_SESSION['user_image'] = $usuario['picture']['url'];
				} else {
					$_SESSION['user_id'] = $isEmailExits->usuarioId;
					$_SESSION['user_name'] = $isEmailExits->nombre;
					$_SESSION['user_image'] = $isEmailExits->foto;
				}

				return true;

			} catch (Exception $e) {

			}

			return false;
		}

		public function signOut() {
			unset($_SESSION['user_id']);
			unset($_SESSION['user_name']);
			unset($_SESSION['user_image']);
		}
	}
?>