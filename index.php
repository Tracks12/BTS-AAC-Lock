	<?php
	/**
	 * Project  : Serrure AAC
	 * Date     : 11/12/2019
	 * Autor    : CARDINAL Florian
	 * Nom      : index.php
	 * Location : /
	 */

	require_once('./core/models/connect.php');
	require_once('./core/models/userModel.php');
	require_once('./core/models/serrureModel.php');
	require_once('./core/models/service.php');

	$bdd = bdd::connect();

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		/**
		 * XHR Request Only
		 */

		require_once('./core/controlers/serrureControler.php');
		require_once('./core/controlers/controler.php');
	}

	else {
		/**
		 * HTTP Request & Other
		 */

		$response = http_response_code();

		switch($response) { // Affichage du contenu selon le code réponse http
			case 200: require_once('./core/views/index.html'); break;
			case 403: echo("T'as pas le droit, pas de chance :larry:"); break;
			case 404: echo("Y a rien là, qu'est-ce tu fous là khey ? :hap:"); break;
			default: die(); break;
		}
	}

	/**
	 * END
	 */
