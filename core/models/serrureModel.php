<?php
  /**
   * Project  : Serrure AAC
   * Date     : 11/12/2019
   * Autor    : CARDINAL Florian
   * Nom      : serrureModel.php
   * Location : /core/models/
   */

  class serrure {
    /**
     * serrure
     * Objet de contrôle des requêtes
     */

    public function getStory($bdd) {
      /**
      * getStory()
      * Fonction: Récupération des données de la table "story"
      */

      $req = $bdd->query('SELECT * FROM story');
      $data = [];

      while($output = $req->fetch(PDO::FETCH_ASSOC))
        array_push($data, $output);

      return $data;
    }

    public function getCard($bdd) {
      /**
       * getCard()
       * Fonction: Récupération des données de la table "card"
       */

      $req = $bdd->query('SELECT * FROM card');
      $data = [];

      while($output = $req->fetch(PDO::FETCH_ASSOC))
        array_push($data, $output);

      return $data;
    }

		public function editCard($bdd, $post) {
			/**
       * editCard()
       * Fonction: Modification d'une carte RFID
       */

			 $req = $bdd->prepare("UPDATE card SET value = ? WHERE idCard = ?");
			 return $req->execute([$post['code'], $post['id']]);
		}

    public function addCard($bdd, $post) {
      /**
       * newCard()
       * Fonction: Insertion d'une nouvelle carte RFID
       */

      $req = $bdd->prepare("INSERT INTO card(value, name, fname) VALUES (?, ?, ?)");
			return $req->execute([$post['code'], $post['name'], $post['fname']]);
    }

		public function unlock($bdd) {
			/**
       * unlock()
       * Fonction: Met à jour la valeur de déverrouillage de la gâche
       */

			return $bdd->query('UPDATE `unlock` SET value = 1 WHERE 1');
		}
  }

/**
 * END
 */
