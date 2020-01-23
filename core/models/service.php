<?php
  /**
   * Project  : Serrure AAC
   * Date     : 11/12/2019
   * Autor    : CARDINAL Florian
   * Nom      : service.php
   * Location : /core/models/
   */

  class secure {
    /**
     * secure
     * Objet de vérification de données entrentes
     */

    public function isMail($data) {
      /**
       * isMail(data)
       * Fonction: vérification de l'adresse mail
       */

      $data = filter_var($data, FILTER_VALIDATE_EMAIL);

      return $data;
    }

    public function isPhone($data) {
      /**
       * isPhone(data)
       * Fonction: vérification du numéro de téléphone
       */

      $data = preg_match("/^[0-9 ]*$/", $data);

      return $data;
    }

    public function isInput($data) {
      /**
       * isInput(data)
       * Fonction: vérification des données d'insertions
       */

      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
  }
