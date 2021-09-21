$(function() {
	$('.collapse').collapse({toggle: false});
	$('.modal').modal({show: false});

	$('#top-home,#top-menu a,#item-menu a').on('click', function(e) {
		e.preventDefault();
		if ($(window).width() < 768) {
			$('.navbar-top').collapse('hide');
			$('.navbar-item').collapse('hide');
		} else {
			$('#loading').css('visibility', 'visible');
		}

		var loadurl = $(this).attr('href');
		var targ = $(this).attr('data-target');

		$('#top-menu li').removeClass('active');
		$('#item-menu li').removeClass('active');
		$(this).parent().addClass('active');

		$('html, body').animate({scrollTop: 0}, 200);

		$('#'+targ).fadeOut(200, function() {
			$('#'+targ).load(loadurl, {ajax: 'ajax', changeContent: true}, function() {
				history.replaceState({changeContent: true}, null);
				history.pushState({changeContent: true}, null, loadurl);

				$('#'+targ).fadeIn(300, function() {
					$('#loading').css('visibility', 'hidden');
				});
			});
		});

	});

	$(document).on('click', 'a[data-toggle="tab"]', function(e) {
		e.preventDefault();
		$('#loading').css('visibility', 'visible');

		var loadurl = $(this).attr('href');
		var targ = $(this).attr('data-target');

		$('#'+targ).fadeOut(200, function() {
			$('#'+targ).load(loadurl, {ajax: 'ajax', changeType: true}, function() {
				updateSemesterDropMenu(loadurl);
				history.pushState({changeType: true}, null, loadurl);

				$('#'+targ).fadeIn(300, function() {
					$('#loading').css('visibility', 'hidden');
				});
			});
		});
	});

	$(document).on('click', '#sem-menu a', function(e) {
		e.preventDefault();
		$('#loading').css('visibility', 'visible');

		var loadurl = $(this).attr('href');
		var targ = $(this).attr('data-target');

		$('#sem-menu li').removeClass('active');
		$(this).parent().addClass('active');
		$('#dropdown_active_sem').html( $(this).html() );

		$('#'+targ).fadeOut(200, function() {
			$('#'+targ).load(loadurl, {ajax: 'ajax', changeLayout: true}, function() {
				updateSemesterDropMenu(loadurl);
				history.replaceState({changeLayout: true}, null);
				history.pushState({changeLayout: true}, null, loadurl);

				$('#'+targ).fadeIn(300, function() {
					$('#loading').css('visibility', 'hidden');
				});
			});
		});
	});

	window.addEventListener("popstate", function(e) {
		var targ = null;
		var params = '';

		if (e.state == null) {
			return;
		}

		$('#loading').css('visibility', 'visible');

		$.map(e.state, function(k, v) {
			params += '&' + v + '=' + k;
			if (k == true) {
				if (v == 'changeType') {
					targ = 'sem-content';
					var link = $('a[href$="'+window.location.href+'"][data-target='+targ+']');

					$(link).tab('show');
				} else if (v == 'changeContent') {
					targ = 'content';
					var link = $('a[href$="'+window.location.href+'"][data-target='+targ+']');

					$('#top-menu li').removeClass('active');
					$('#item-menu li').removeClass('active');
					$(link).parent().addClass('active');
				} else if (v == 'changeLayout') {
					targ = 'tab-content';
					var link = $('a[href$="'+window.location.href+'"][data-target='+targ+']');

					$('#sem-menu li').removeClass('active');
					$(link).parent().addClass('active');
					$('#dropdown_active_sem').html( $(link).html() );
				}
			}
		});

		$('html, body').animate({scrollTop: 0}, 200);

		$('#'+targ).fadeOut(200, function() {
			$.post(window.location.href, 'ajax=true' + params, function(data) {
				$('#'+targ).html(data);
				updateSemesterDropMenu(window.location.href);

				$('#'+targ).fadeIn(300, function() {
					$('#loading').css('visibility', 'hidden');
				});
			});
		});
	}, false);

	function updateSemesterDropMenu(url) {
		var array = url.split('/');
		var length = array.length;
		var sem = array[length - 1];

		if ($.isNumeric(sem)) {
			var new_url = url.substr(0, url.length - sem.length);
			$('.change_sem').each(function() {
				$(this).attr('href', new_url + $(this).attr('id').substr(6));
			});
		}
	}
});
