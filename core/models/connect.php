<?php
	/**
	 * Project  : Serrure AAC
	 * Date     : 11/12/2019
	 * Autor    : CARDINAL Florian
	 * Nom      : connect.php
	 * Location : /core/models/
	 */

	class bdd {
		/**
		 * dataBase
		 * Objet de connexion à la base de donnée
		 */

		public static function disconnect() {
			/**
			 * disconnect(void)
			 * Fonction: Efface la connexion à la database
			 */

			return self::$bdd['db'] = NULL;
		}

		public static function connect() {
			/**
			 * connect(void)
			 * Fonction: Connexion à la base de donnée
			 */

			session_start();

			try {
				self::$bdd['db'] = new PDO(
					'mysql:host='.self::$bdd['host'].'; dbname='.self::$bdd['name'].'; charset='.self::$bdd['char'],
					self::$bdd['user'],
					self::$bdd['pass'],
					array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
				);
			}
			catch(Exception $e) { die("[Err]:[{$e->getmessage()}]"); }

			return self::$bdd['db'];
		}

		private static $bdd = array(
			"db"   => NULL,
			"host" => "localhost",
			"name" => "...",
			"char" => "utf8",
			"user" => "...",
			"pass" => "..."
		);
	}

  /**
   * END
   */
