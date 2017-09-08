//background
	
var backgroundImage = function() {
	
	var obj = document.getElementById('svgBg');
	
	var hexPath = [];
	var hexPos;
	var rows = 7;
	var cols = 36;
	var i = 0;
	var maxlegs = 8;
	
	mapPath();
	
	function activateHex() {
		var n = 0;
		
		var backgroundTime = setInterval( function() {
			
			var currentSelector = '.hex-' + hexPath[n];
			
			var svgDoc = obj.contentDocument;
			var select = svgDoc.querySelector( currentSelector );
			select.classList.add('select');
			
			n++;
			if (n === hexPath.length ) clearInterval(backgroundTime);
		
		}, 500);
		
	}
	
	
	function randHex() {
		var row = Math.floor( Math.random() * rows ) + 1;
		var col = Math.floor( Math.random() * cols ) + 1;
	
		return col + '-' + row;
	}
	
	function mapPath() {
		
		var hexCoordinate;
		
		while ( i < maxlegs ) {	
			
			if( i > 0 ) {
				hexCoordinate = directHex(hexPath[i-1]);
			} else {
				hexCoordinate = randHex();
			}
		
			validateCoordinate(hexCoordinate);
		}
		
		activateHex()
		
	}
	
	function validateCoordinate(coordinate) {
		
/*
		tests:
		1) Does not exist in path
		2) Does not run off board
*/
		
		if( isUnique() && inBounds() ) {
			hexPath.push(coordinate);
			return i++;
		};
		
		function isUnique() {
			return hexPath.indexOf( coordinate ) === -1 ? true : false;
		}
		
		function inBounds() {
			var position = getCoordinates(coordinate);
			return position.col <= cols && position.col > 0 && position.row <= rows && position.row > 0;
		}
		
	}
	
	function getCoordinates(hex){
			
			var delimeterPos = hex.indexOf('-');
			
			return {
				col : Number( hex.substr(0, delimeterPos) ),
				row : Number( hex.substr(delimeterPos + 1) )
			}
	}
	
	
	function directHex(hex) {
			
			var position = getCoordinates(hex);
			var odd = position.col % 2 > 0 ? true : false;
			var newcol, newrow;
			var direction = Math.floor(Math.random() * 6) + 1;
			
			switch (direction) {
				 case 1: 
				 //odd mode upper right: col + 1, row -1					 
				 //even mode upper right: col + 1, row =
				 newcol = position.col + 1;
				 newrow = odd ? position.row - 1 : position.row;
				 break;
				 case 2: 
				 //odd mode right: col + 2, row =
				 //even mode right: col + 2, row =
				 newcol = position.col + 2;
				 newrow = position.row;
				 break;
				 case 3:
				 //odd mode lower right: col + 1, row =
				 //even mode lower right: col + 1, row +1
				 newcol = position.col + 1;
				 newrow = odd ? position.row : position.row + 1;
				 break;
				 case 4:
				 //odd mode lower left right: col - 1, row =
				 //even mode lower left right: col - 1, row +1
				 newcol = position.col - 1;
				 newrow = odd ? position.row : position.row + 1;
				 break;
				 case 5:
				 //odd mode left : col - 2, row =
				 //even mode left : col - 2, row =
				 newcol = position.col - 2;
				 newrow = position.row;
				 break;
				 case 6:
				 //odd mode upper left : col - 1, row -1
				 //even mode upper left : col - 1, row =
				 newcol = position.col - 1;
				 newrow = odd ? position.row - 1 : position.row;
				 break;
				 default:
				 newcol = position.col;
				 newrow = position.row;
			}//switch
				
			return newcol + '-' + newrow;
			
		}
}();