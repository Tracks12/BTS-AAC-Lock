/**
 * Project  : Serrure AAC
 * Date     : 11/12/2019
 * Autor    : CARDINAL Florian
 * Nom      : request.js
 * Location : /script/
 */

class process {
	/**
	 * process
	 * Objet de contrôle de requête XHR
	 */

	static login(data) {
		/**
		 * login(data)
		 * Requête de connexion
		 */

		$.ajax({
			type: 'POST',
			url: './?target=login-process',
			data: data,
			dataType: 'json',
			success: result => {
				if(result.passed) {
					$('#login .info')
						.html('Connexion en cours...')
						.fadeIn();

					$('section').fadeOut(() => {
						$('nav ul[hidden]').fadeIn();
						$('section').load('./?target=story', function() {
							$(this).fadeIn();
							process.story();
						});
					});
				}
				else {
					$('#login .info')
						.html(result.error)
						.fadeIn();
				}
			}
		});
	}

	static isLogin() {
		/**
		 * isLogin(void)
		 * Requête de checking de connexion existante
		 */

		$.ajax({
			type: 'POST',
			url: './?target=isLogin',
			dataType: 'json',
			success: result => {
				if(result.passed) {
					$('nav ul[hidden]').fadeIn();
					$('section').load('./?target=story', function() {
						$(this).fadeIn();
						process.story();
					});
				}
				else
					views.login();
			}
		});
	}

	static story() {
		/**
		 * story(void)
		 * Requête de listing de l'historique
		 */

		$.ajax({
			type: 'POST',
			url: './?target=story-content',
			dataType: 'json',
			success: result => {
				let i = 0;
				let template = [
					'<tr>',
						`<th>id</th>`,
						`<th>date de passage</th>`,
						`<th>code</th>`,
						`<th>sens</th>`,
						`<th>accès</th>`,
					'</tr>'
				];

				$('section #story-content').append(template.join('\n'));

				result.forEach(element => {
					let template = [
						'<tr>',
							`<td>${element.idStory}</td>`,
							`<td>${element.time}</td>`,
							`<td>${element.value}</td>`,
							`<td>${element.dir}</td>`,
							`<td>${element.access}</td>`,
						'</tr>'
					];

					i++;
					if(i%2)
						template[0] = '<tr class="peer">';

					$('section #story-content').append(template.join('\n'));
				});
			}
		});
	}

	static listCard() {
		/**
		 * listCard(void)
		 * Requête de listing des cartes enregistrés
		 */

		$.ajax({
			type: 'POST',
			url: './?target=list-user-content',
			dataType: 'json',
			success: result => {
				let i = 0;
				let template = [
					'<tr>',
						'<th>id</th>',
						'<th>Ajouté le</th>',
						'<th>value</th>',
						'<th>name</th>',
						'<th>prénom</th>',
					'</tr>'
				];

				$('section #list-user-content').append(template.join('\n'));

				result.forEach(element => {
					let template = [
						'<tr>',
							`<td>${element.idCard}</td>`,
							`<td>${element.addedDate}</td>`,
							`<td>${element.value}</td>`,
							`<td class="nameArea">${element.name}</td>`,
							`<td class="fnameArea">${element.fname}</td>`,
						'</tr>'
					];

					i++;
					if(i%2)
						template[0] = '<tr class="peer">';

					$('section #list-user-content').append(template.join('\n'));
				});
			}
		});
	}

	static editCode(data) {
		/**
		 * editCode(data)
		 * Requête d'édition de carte RFID
		 */

		$.ajax({
			type: 'POST',
			url: './?target=edit-code-process',
			data: data,
			dataType: 'json',
			success: result => {
				if(result.passed) {
					$('#edit-code-form .info')
						.html('Modification réussi !')
						.fadeIn();
				}
				else {
					$('#edit-code-form .info')
						.html(result.error)
						.fadeIn();
				}
			}
		});
	}

	static addCode(data) {
		/**
		 * addCode(data)
		 * Requête d'ajout de carte RFID
		 */

		$.ajax({
			type: 'POST',
			url: './?target=add-user-process',
			data: data,
			dataType: 'json',
			success: result => {
				if(result.passed) {
					$('#add-user-form .info')
						.html('Ajout réussi !')
						.fadeIn();
				}
				else {
					$('#add-user-form .info')
						.html(result.error)
						.fadeIn();
				}
			}
		});
	}

	static unlock() {
		/**
		 * unlock(void)
		 * Requête d'ouverture de la gâche
		 */

		$.ajax({
			type: 'POST',
			url: './?target=unlock-process',
			dataType: 'json',
			success: result => {
				if(result.passed) {
					$('#unlock-form .info')
						.html('Gâche Déverrouillée !')
						.fadeIn();
				}
				else {
					$('#unlock-form .info')
						.html(result.error)
						.fadeIn();
				}
			}
		});
	}
}

/**
* END
*/
