<div class="onionskin"></div>
<form action="/item/bug_submit" method="post" id="bug_form" class="dialogue">
	<h2 style="margin-bottom:0; font-size:1.1em; font-weight:bold; ">Report a bug</h2>
	
	<p style="color:#999999; padding-bottom:1em !important; font-size:.9em;">(If you'd like to send a file or screenshot, email <a href="mailto:bugs@svpply.com">robksawyer@gmail.com</a>.)</p>
	<div style="margin-bottom:15px;">&mdash;</div>
	<textarea name="note" placeholder="What's the problem?"></textarea>
	<br>
	<input type="text" disabled="" value="user: <?php echo $authUser['User']['username']; ?>">
	<br>
	<input type="text" disabled="" value="url: ">
	<br>
	
	<?php $browser = get_browser(null, true); ?>
	<input type="text" disabled="" value="browser: <?php echo $browser['browser_name_pattern']; ?>">
	
	<div class="dialogue_buttons">
		<input type="button" value="Cancel" class="btn_cancel btn_link">
		<input type="submit" value="Send" class="btn_send btn">
		<input type="hidden" name="token" id="bug_form_token" value="plough">
		<div class="activity">
			<span> sending message... </span>
			<img src="/assets/image/spinner_black_on_white.gif" width="16" height="16" alt="...">
		</div>
	</div>
	
	<div class="form_response"></div>
	
</form>
<script type="text/javascript">
	$(document).ready( function() {
		$('#bug_form_token').val( 'xyzzy' );
	} );
	
	$('#bug_form .btn_cancel, .onionskin').bind( 'click', function() {
		$('#bug_form').fadeOut( 150, function() {
			$('.onionskin, #bug_form').remove();
		} );
	} );

	$('#bug_form').fadeIn( 150 );
	$('#bug_form').bind( 'submit', function() {
		$('.dialogue_buttons').addClass( 'processing' );
		$.ajax( {
			url: '/item/bug_submit',
			type: 'POST',
			dataType: 'text',
			data: $(this).serialize(),
			success: function(r) {
				if( r == 'Error: no content.' ) {
					$('.dialogue_buttons').removeClass( 'processing' );
					$('#bug_form .form_response').html(r);
					return;
				}
				$('.dialogue textarea').attr('disabled', true );
				$('#bug_form .form_response').html(r);
				$('.dialogue_buttons').remove();
				$('#bug_form').oneTime( 1000, 'bug_form_close', function() {
					$('#bug_form').fadeOut( function() {
						$('#bug_form, .onionskin').remove();
					} );
				} );
			},
			error: function() {
				$('#bug_form .form_response').html( 'Error sending message.' );
				$('.dialogue_buttons').removeClass( 'processing' );
				$('.dialogue textarea').attr('disabled', false );
			}
		} );
		return false;
	} );
</script>