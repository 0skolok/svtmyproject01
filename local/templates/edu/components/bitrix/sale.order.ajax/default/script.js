function onAfterOrderAjaxLoad() {
	$.fn.footable && $('.footable').footable({
		breakpoints: {
			phone: 0,
			tablet: 0,
			hidediscount: 810,
			hidepicture: 620,
			hideprice: 520
		}
	});
}

$(function() {
	"use strict";

	onAfterOrderAjaxLoad();
	BX.addCustomEvent('onAjaxSuccess', onAfterOrderAjaxLoad);

	$('.sale-order-ajax').on('change', '.choose-file', function() {
		var $this = $(this),
			$title = $this.prev('span'),
			val = $this.val();

		val = val.replace(/\\/g, '/').split('/');
		val = val[val.length-1];

		if (val.length===0) {val=$title.data('default');}

		$title.html(val);
	});

	$('.sale-order-ajax').on('change', 'input[name="PAY_CURRENT_ACCOUNT"],input[name="PAY_SYSTEM_ID"]', function() {
		var $this = $(this);

		if ($('#account_only').val() === 'Y') {
			if ($this.attr('name') === 'PAY_CURRENT_ACCOUNT') {
				$('input[name="PAY_SYSTEM_ID"]').prop('checked',false);
			} else {
				$('input[name="PAY_CURRENT_ACCOUNT"]').prop('checked',false);
			}
		}
	});

});


