<?php
  /**
   * Project  : Serrure AAC
   * Date     : 11/12/2019
   * Autor    : CARDINAL Florian
   * Nom      : serrureModel.php
   * Location : /core/models/
   */

  class user {
    public function getUsers($bdd) {
      /**
       * getUser()
       * Fonction: Récupération des données de la table "users"
       */

      $req = $bdd->query('SELECT * FROM users');
      $data = [];

      while($output = $req->fetch(PDO::FETCH_ASSOC))
        array_push($data, $output);

      return $data;
    }
  }

  /**
   * END
   */
