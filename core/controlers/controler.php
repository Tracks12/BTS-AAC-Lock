<?php
	/**
	 * Project  : Serrure AAC
	 * Date     : 11/12/2019
	 * Autor    : CARDINAL Florian
	 * Nom      : controler.php
	 * Location : /core/controlers/
	 */

	$target = secure::isInput($_GET['target']);

	switch($target) {
		case 'login': require_once('./core/views/login.html'); break;
		case 'isLogin':
			if(isset($_SESSION)) echo(json_encode($_SESSION));
			else echo(json_encode(['passed' => false]));
			break;
		case 'login-process': $post = [
				'user' => secure::isInput($_POST['user']),
				'pass' => secure::isInput($_POST['pass'])
			];

			$return = controler::login($bdd, $post);
			echo(json_encode($return)); break;

		case 'story':
			if(isset($_SESSION)) require_once('./core/views/story.html');
			break;
		case 'story-content':
			if(isset($_SESSION)) {
				$return = controler::getStory($bdd);
				echo(json_encode($return));
			} break;

		case 'list-user':
			if(isset($_SESSION)) require_once('./core/views/listUser.html');
			break;
		case 'list-user-content':
			if(isset($_SESSION)) {
				$return = controler::getCard($bdd);
				echo(json_encode($return));
			} break;

		case 'edit-code':
			if(isset($_SESSION)) require_once('./core/views/editCode.html');
			break;
		case 'edit-code-process':
			if(isset($_SESSION)) {
				$post = [
					'id' => secure::isInput($_POST['id']),
					'code' => secure::isInput($_POST['code'])
				];

				$return = controler::editCard($bdd, $post);
				echo(json_encode($return));
			} break;

		case 'add-user':
			if(isset($_SESSION)) require_once('./core/views/addUser.html');
			break;
		case 'add-user-process':
			if(isset($_SESSION)) {
				$post = [
					'name' => secure::isInput($_POST['name']),
					'fname' => secure::isInput($_POST['fname']),
					'code' => secure::isInput($_POST['code'])
				];

				$return = controler::addCard($bdd, $post);
				echo(json_encode($return));
			} break;

		case 'unlock':
			if(isset($_SESSION)) require_once('./core/views/unlock.html');
			break;
		case 'unlock-process':
			if(isset($_SESSION)) {
				$return = controler::unlock($bdd);
				echo(json_encode($return));
			} break;

		case 'logout':
			if(isset($_SESSION)) {
				session_destroy();
				echo('<script>setTimeout(() => document.location = "./", 500);</script>');
			} break;

	  default: // Génération d'une erreur 404
			http_response_code(404);
			die(); break;
	}

/**
 * END
 */
