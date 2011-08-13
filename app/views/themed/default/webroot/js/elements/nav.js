$(document).ready(function(){
	
	$(".nav-browsedrop-link-1").mouseover(function () {
			
			$('#nav-browsedrop-1').show();
			$("#nav-browsedrop-1-link").addClass('topnavActive');
		    });
		
	$(".nav-browsedrop-link-1").mouseout(function () {
		//alert('drop off');
				$('#nav-browsedrop-1').hide();
				$("#nav-browsedrop-1").removeClass('topnavActive');
			});
	$(".nav-browsedrop-link-2").mouseover(function () {

			$('#nav-browsedrop-2').show();
			$("#nav-browsedrop-2-link").addClass('topnavActive');
		    });

	$(".nav-browsedrop-link-2").mouseout(function () {
		//alert('drop off');
				$('#nav-browsedrop-2').hide();
				$("#nav-browsedrop-2").removeClass('topnavActive');
			});

	$(".nav-browsedrop-link-3").mouseover(function () {

			$('#nav-browsedrop-3').show();
			$("#nav-browsedrop-3-link").addClass('topnavActive');
		    });

	$(".nav-browsedrop-link-3").mouseout(function () {
		//alert('drop off');
				$('#nav-browsedrop-3').hide();
				$("#nav-browsedrop-3").removeClass('topnavActive');
			});
	
	$(".nav-browsedrop-link-4").mouseover(function () {

			$('#nav-browsedrop-4').show();
			$("#nav-browsedrop-4-link").addClass('topnavActive');
		    });

	$(".nav-browsedrop-link-4").mouseout(function () {
		//alert('drop off');
				$('#nav-browsedrop-4').hide();
				$("#nav-browsedrop-4").removeClass('topnavActive');
			});
	
	$(".nav-browsedrop-link-5").mouseover(function () {

			$('#nav-browsedrop-5').show();
			$("#nav-browsedrop-5-link").addClass('topnavActive');
		    });

	$(".nav-browsedrop-link-5").mouseout(function () {
		//alert('drop off');
				$('#nav-browsedrop-5').hide();
				$("#nav-browsedrop-5").removeClass('topnavActive');
			});
			
	$(".nav-browsedrop-link-6").mouseover(function () {

			$('#nav-browsedrop-6').show();
			$("#nav-browsedrop-6-link").addClass('topnavActive');
		    });

	$(".nav-browsedrop-link-6").mouseout(function () {
		//alert('drop off');
				$('#nav-browsedrop-6').hide();
				$("#nav-browsedrop-6").removeClass('topnavActive');
			});
			
	$(".closer").mouseover(function () {
			//alert('drop off');
				$('#nav-browsedrop').hide();
				$("#nav-browsedrop-link").removeClass('topnavActive');
			});
	
	$(".nav-browsedrop-indy22").mouseout(function () {
		//		alert('link out');
				$('#nav-browsedrop').show();
				$("#nav-browsedrop-link").addClass('topnavActive');
			});
			
});