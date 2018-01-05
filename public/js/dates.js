$('input[type="text"].date-picker').keypress(function (evt) {
  var theEvent = evt || window.event;
  var keyCode = theEvent.keyCode || theEvent.which;
  if (keyCode == 9) {
    return;
  }
  evt.preventDefault();
});

$('.date-picker.date-picker-now').each(function() {
	$(this).datepicker({
		todayHighlight: true,
		format: 'yyyy-mm-dd',
		startDate: '+0d',
		templates: {
			leftArrow: '<i class="now-ui-icons arrows-1_minimal-left"></i>',
			rightArrow: '<i class="now-ui-icons arrows-1_minimal-right"></i>'
		}
	}).on('show', function() {
		$('.datepicker').addClass('open');

		var datepicker_color = $(this).data('datepicker-color');
		if (datepicker_color && datepicker_color.length != 0) {
			$('.datepicker').addClass('datepicker-' + datepicker_color + '');
		}
	}).on('hide', function() {
		$('.datepicker').removeClass('open');
	});
});

$('.date-picker.date-picker-after3').each(function() {
	$(this).datepicker({
		todayHighlight: true,
		format: 'yyyy-mm-dd',
		startDate: '+3d',
		templates: {
			leftArrow: '<i class="now-ui-icons arrows-1_minimal-left"></i>',
			rightArrow: '<i class="now-ui-icons arrows-1_minimal-right"></i>'
		}
	}).on('show', function() {
		$('.datepicker').addClass('open');

		var datepicker_color = $(this).data('datepicker-color');
		if (datepicker_color && datepicker_color.length != 0) {
			$('.datepicker').addClass('datepicker-' + datepicker_color + '');
		}
	}).on('hide', function() {
		$('.datepicker').removeClass('open');
	});
});
