var resizeQuery = (function () {
	
		/* Version 2
			
			USAGE:
				
			var events = {
				'(max-width: 500px)' : function(){
					//do stuff when screen is first resized to a size smaller than 500px;
				},
				'(min-width: 800px)' : {}, // register the query only for comparison; may be needed for intended 'any' change usage
				'(min-width: 500px)' : function(){
					//do stuff when screen is first resized to a size larger than 500px;
				},
				'(any)' : function(){
					// Optional: do stuff when screen is first resized to a size different than the current media query bounds; 
					NOTE: Will only fire for changes between media queries described in the events object;
				}
			};
			
			var rq = resizeQuery(events);
			
			(object) events : contains objects keyed on a media query with a callback as value to invoke when a screen has been resized to match
			NOTE REGARDING MULTIPLE MATCHING QUERIES:
			The first matching query will be triggered; so order the queries appropriately when multiple queries can match i.e. 
			• min-width: 800px; min-width: 500px; NOT min-width: 500px; min-width: 800px;
			• max-width: 600px; max-width: 700px; NOT max-width: 700px; max-width: 600px; 
			
			var rq = resizeQuery(events, true);
			(boolean) init : check for a matching query on initialization of the script(true) or wait for resize to occur (falsey) 
				
		*/
		
		var mQueries,
			currentMQ;
		
		var monitorMQ = function (eventsobj, init) {
			
			mQueries = _defineQueries(eventsobj);
			currentMQ = _idQuery();
			
			//stores active media query to compare against when resizing
			var tmpMQ = currentMQ;
			//for initial size flag
			if(init === true){
				_fireCallback(eventsobj,currentMQ);
			}
			
			window.onresize = function() {
				var newMQ = _idQuery();
			
				if(newMQ != tmpMQ){
					_fireCallback(eventsobj,newMQ);
					
					if(eventsobj['(any)']){
						_fireCallback(eventsobj,'(any)');
					}
					
					tmpMQ = newMQ;
				};
			};

		} //monitorMQ;
		
		function _defineQueries(events) {
			// create an array containing queries present in the events object; remove 'any' key if present
			function removeAny(str) {
				return str != '(any)';
			}
			
			var queries = Object.keys(events).filter(removeAny) || [];
			
			return queries;
		}

		function _idQuery() {
			// return active media query; if found
			
			var active = currentMQ || '';
			
			for (var i=0 ;i < mQueries.length; i++) {
				
				if(Modernizr.mq(mQueries[i]) === true){
					active = mQueries[i];
					break;
				}
				
			}
			
			return active;
		}
		
		function _fireCallback(events,index) {

			return typeof(events[index]) === 'function' && events[index]();
				
		}
		
		return monitorMQ; 
	
})();