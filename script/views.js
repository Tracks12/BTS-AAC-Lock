/**
 * Project  : Serrure AAC
 * Date     : 11/12/2019
 * Autor    : CARDINAL Florian
 * Nom      : views.js
 * Location : /script/
 */

class views {
	/**
	 * views
	 * Objet de contrôle de requête des vues
	 */

  static login() {
		/**
		 * login()
		 * login template control
		 */

		$('section').load('./?target=login', result => {
			$('#login input[name=user]').focus();
			$('#login').submit(function(e) {
				e.preventDefault();
				let post = $(this).serialize();

				$(this)
					.find('.info')
					.empty()
					.css({display: 'none'});

				process.login(post);
			});
		});
	}

	static editCode() {
		/**
		 * editCode()
		 * editCode template control
		 */

		$('#edit-code-form input[name=id]').focus();
		$('#edit-code-form').submit(function(e) {
			e.preventDefault();
			let post = $(this).serialize();

			$(this)
				.find('.info')
				.empty()
				.css({display: 'none'});

			process.editCode(post);
		});
	}

	static addCode() {
		/**
		 * addCode()
		 * addCode template control
		 */

		$('#add-user-form input[name=name]').focus();
		$('#add-user-form').submit(function(e) {
			e.preventDefault();
			let post = $(this).serialize();

			$(this)
				.find('.info')
				.empty()
				.css({display: 'none'});

			process.addCode(post);
		});
	}

	static unlock() {
		/**
		 * addCode()
		 * addCode template control
		 */

		$('#unlock-form').submit(function(e) {
			e.preventDefault();

			$(this)
				.find('.info')
				.empty()
				.css({display: 'none'});

			process.unlock();
		});
	}
}

/**
 * END
 */
