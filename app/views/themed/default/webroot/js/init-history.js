(function(window,undefined){
	// Check Location
	if( document.location.protocol === 'file:' ) {
		alert('The HTML5 History API (and thus History.js) do not work on files, please upload it to a server.');
	}

	// Establish Variables
	var History = window.History, // Note: We are using a capital H instead of a lower h
		State = History.getState(),
		$log = $('#log');

	// Log Initial State
	History.log('initial:', State.data, State.title, State.url);

	// Bind to State Change
	History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
		// Log the State
		var State = History.getState(); // Note: We are using History.getState() instead of event.state
		History.log('statechange:', State.data, State.title, State.url);
	});

})(window);