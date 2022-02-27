$('#scroll-top').click(function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});

$(document).ready(function(){
	$('#openCatNav').click(function(){
		$('#catNav').animate({
		  left: "0px"
		}, 200);

		$('body').animate({
		  left: "250px"
		}, 200);
	});
	$('#closeCatNav').click(function(){
		$('#catNav').animate({
		  left: "-250px"
		}, 200);

		$('body').animate({
		  left: "0px"
		}, 200);
	});
});

$(document).ready(function(){
	$('#catNav .nav-link').on('click', function(e) {
	$('#catNav').animate({
		  left: "-250px"
	}, 200);

	$('body').animate({
		  left: "0px"
	}, 200);
	var el = $(e.target.getAttribute('href'));
	var elOffset = el.offset().top;
	var elHeight = el.height();
	var windowHeight = $(window).height();
	var offset;
	if (elHeight < windowHeight) {
	offset = elOffset - ((windowHeight / 2) - (elHeight / 2));
	}
	else {
	offset = elOffset;
	}
	var speed = 700;
	$("html, body").animate({scrollTop:offset}, speed);
	});
});

$(document).ready(function() {
	$('a[data-toggle="modal"]').on('click', function(e) {
		e.preventDefault();
		var target_modal = $(e.currentTarget).data('target');
		var remote_content = e.currentTarget.href;
		var modal = $(target_modal);
		var modalBody = $(target_modal + ' .modal-body');
        modalBody.load(remote_content,function(){
			$(modal).modal('show');
		});
		return false;
	});
});