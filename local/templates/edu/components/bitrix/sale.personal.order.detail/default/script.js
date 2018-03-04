$(function() {
	$.fn.footable && $('.footable').footable({
		breakpoints: {
			phone: 0,
			tablet: 0,
			hidediscount: 810,
			hidepicture: 620,
			hideprice: 520
		}
	});
});