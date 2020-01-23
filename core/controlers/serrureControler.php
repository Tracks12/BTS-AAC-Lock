<?php
	/**
	 * Project  : Serrure AAC
	 * Date     : 11/12/2019
	 * Autor    : CARDINAL Florian
	 * Nom      : serrureControler.php
	 * Location : /core/controlers/
	 */

	class controler {
		/**
		 * serrure
		 * Objet de contrôle des traitements
		 */

		public function login($bdd, $data) {
			/**
			 * login(bdd, data)
			 * Function: Traitement de la procédure de connexion
			 */

			$data = [
				'user'		=> $data['user'],
				'pass'		=> base64_encode(md5($data['pass'])),
				'error'		=> 'Information incorrect',
				'passed'	=> false
			];

			$listUser = user::getUsers($bdd);

			foreach($listUser as $out) {
				if(
					($data['user'] === $out['nichandle'])
					&& ($data['pass'] === $out['password'])
				) {
					return $_SESSION = [
						'user'		=> $out['nichandle'],
						'isAdmin'	=> $out['isAdmin'],
						'passed'	=> true
					];
				}
			}

			$data['pass'] = NULL;
			return $data;
		}

		public function getStory($bdd) {
			/**
			 * getStory(bdd)
			 * Function: Listing des passage avec association de valeurs num
			 */

			$story = serrure::getStory($bdd);
			$data = [];

			foreach ($story as $out) {
				$out['time'] = date('d/m/Y H:i:s', strtotime($out['time']));

				switch($out['dir']) {
					case 0: $out['dir'] = 'Intérieur'; break;
					case 1: $out['dir'] = 'Extérieur'; break;
				}

				switch($out['access']) {
					case 0: $out['access'] = 'Autorisé'; break;
					case 1: $out['access'] = 'Refusé'; break;
				}

				array_push($data, $out);
			}

			return $data;
		}

		public function getCard($bdd) {
			/**
			 * getCard(bdd)
			 * Function: Listing des cartes enregistrés sur la base de données
			 */

			$listCard = serrure::getCard($bdd);
			$data = [];

			foreach($listCard as $out) {
				$out['addedDate'] = date('d/m/Y H:i:s', strtotime($out['addedDate']));

				array_push($data, $out);
			}

			return $data;
		}

		public function editCard($bdd, $data) {
			/**
			 * editCard(bdd, data)
			 * Function: Traitement de la procédure d'édition de carte RFID
			 */

			$listCard = serrure::getCard($bdd);

			foreach($listCard as $out) {
				if($out['idCard'] === $data['id'])
					return ['passed' => serrure::editCard($bdd, $data)];
			}

			return [
				'passed' => false,
				'error' => 'Carte introuvable !'
			];
		}

		public function addCard($bdd, $data) {
			/**
			 * addCard(bdd, data)
			 * Function: Traitement de la procédure d'ajout de carte RFID
			 */

			$listCard = serrure::getCard($bdd);

			foreach($listCard as $out) {
				if(($out['name'] === $data['name']) || ($out['fname'] === $data['fname']))
					return [
						'passed' => false,
						'error' => 'Utilisateur déjà existant !'
					];

				if($out['value'] === $data['code'])
					return [
						'passed' => false,
						'error' => 'Carte déjà existante !'
					];
			}

			return ['passed' => serrure::addCard($bdd, $data)];
		}

		public function unlock($bdd) {
			/**
			 * unlock(bdd)
			 * Function: Traitement de la procédure d'ouverture de la gâche
			 */

			return ['passed' => serrure::unlock($bdd)];
		}
	}

/**
 * END
 */
