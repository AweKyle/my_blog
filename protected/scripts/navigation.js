$(document).ready(function() {
	var hash = window.location.hash.substr(1);
	var href = $('navig li a').each(function() {
		var href = $(this).attr('href');
		if (hash == href.substr(0, href.length-5)) {
			var toLoad = hash+' .html #content';
			$('#content').load(toLoad)
		}
	});

	$('#navig li a').click(function() {
		
		var toLoad = $(this).attr('href')+' #content';
		$('#content').hide('fast', loadContent);
		window.location.hash = $(this).attr('href').substr(0,$(this).attr('href').length-4);
		function loadContent() {
			$('#content').load(toLoad, ' ', showNewContent())
		}

		function showNewContent() {
			$('#content').show('normal');
		}

		return false;
	});
});