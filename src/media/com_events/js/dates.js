jQuery(document).ready(function($) {

	var now = new Date();
	var startDate = $("input[name=startDate]");
	var endDate = $('input[name=endDate]');

	var startDatePickr = $("#startDate").flatpickr({
		altInput: true,
		enableTime: true,
		minDate: 'today',
		onChange: function(selectedDates) {
			var date = selectedDates[0];
			startDate.val(date.toISOString());
			
			endDatePickr.set('minDate', date);
			endDatePickr.clear();
		},
		onReady: function(selectedDates, dateStr, instance) {
			var utc = startDate.val();

			if(utc) {
				var date = new Date(utc);
				console.log(date);
				instance.setDate(date, false);
			}
		}
	});

	var endDatePickr = $("#endDate").flatpickr({
		altInput: true,
		enableTime: true,
		minDate: 'today',
		onChange: function(selectedDates) {
			if(selectedDates.length) {
				var date = selectedDates[0];
				endDate.val(date.toISOString());
			} else {
				endDate.val(null);
			}
		},
		onReady: function(selectedDates, dateStr, instance) {
			var utc = endDate.val();
			if(utc) {
				var date = new Date(utc);
				instance.setDate(date, false);
			}
		}
	});

	$('time').each(function(index, el) {
		el = $(el);
		var timezone = moment.tz.guess();
		var date = moment(el.attr('datetime'));

		el.html(date.tz(timezone).format(el.data('format')));
	});

});