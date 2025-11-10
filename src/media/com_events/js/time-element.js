jQuery(document).ready(function($) {

	$('time').each(function(index, el) {
		el = $(el);
		var timezone = moment.tz.guess();
		var date = moment(el.attr('datetime'));

		el.html(date.tz(timezone).format(el.data('format')));
	});

});