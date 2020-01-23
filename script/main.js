/**
 * Project  : Serrure AAC
 * Date     : 11/12/2019
 * Autor    : CARDINAL Florian
 * Nom      : main.js
 * Location : /script/
 */

$(document).ready(() => {
	setTimeout(() => $('#splash').fadeOut(), 5500);

	$('nav ul ul').css({ display: 'none' });

	$('nav ul .item .btn').click(function() {
		$('nav ul ul').slideUp();
		$(this)
			.parent('li')
			.find('ul')
			.slideToggle();
	});

	$('nav ul a').click(function() {
		let id = $(this).prop('id');
		$('section').fadeOut(() => {
			$('section').load(`./?target=${id}`, function() {
				switch(id) {
					case 'story': process.story(); break;
					case 'list-user': process.listCard(); break;
					case 'edit-code': views.editCode(); break;
					case 'add-user': views.addCode(); break;
					case 'unlock': views.unlock(); break;
					case 'logout': $('nav ul').fadeOut(); break;
				}

				$(this).fadeIn();
			});
		});
	});

	process.isLogin();

	// Suppresseur d'Ads
	$('div')[$('div').length-1].innerHTML = '';
});

/**
 * END
 */
