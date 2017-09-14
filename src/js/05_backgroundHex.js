//background
	
window.onload = function() {
	
	var obj = document.getElementById('svgBg');
	var svgDoc = obj.contentDocument;
	
	var hexPath = [],
		maxrows = 7,
		maxcols = 36,
		maxlegs = 5;
		startPoints = [
			['5-2',6],
			['16-0',3],
			['15-0',4],
			['23-1',5],
			['35-0',4],
			['4-3',6],
			['3-0',3],
			['30-0',5],
			['31-2',1],
			['5-3',4]
		];
		
		
	function HexPoint(name, direction) {
		this.coordinates = getCoordinates(name);
		this.name = name;
		this.direction = direction;
	};
	
	HexPoint.prototype.getClassName = function() {
		return '.hex-' + this.name;
	}
	
	mapPath();
	
	function activateHexPath() {
		var n = 0;
		
		var backgroundTime = setInterval( function() {
			
			var currentSelector = hexPath[n].getClassName();
			
			var selectHex = svgDoc.querySelector( currentSelector );
			
			if(selectHex) {
				moveBodyBg(selectHex, n);
				selectHex.classList.add('select');
			}
			 
			n++;
			if (n === hexPath.length ) clearInterval(backgroundTime);
			
		}, 1250);
		
	}
	
	function moveBodyBg(hex, index){
		
		var bgRadius = 187;
		var hexRadius = 64;
		var offsetBg = bgRadius - hexRadius; 
		
		var hexPos = offset(hex);
		var bodyPosX = Math.floor(hexPos.left) - offsetBg + 'px';
		var bodyPosY = Math.floor(hexPos.top) - offsetBg + 'px';
		
		if(index === 1)
			document.body.style.transitionDuration = '300ms';
		
		document.body.style.backgroundPosition = bodyPosX + ' ' + bodyPosY;
		
	}
	
	
	function offset(el) {
   	 	var rect = el.getBoundingClientRect(),
   	 	scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
   	 	scrollTop = window.pageYOffset || document.documentElement.scrollTop;
   	 	return { top: rect.top + scrollTop, left: rect.left + scrollLeft }
	}

		
	function randHex() {
		
		var row = Math.floor( Math.random() * maxrows ) + 1;
		var col = Math.floor( Math.random() * maxcols ) + 1;
	
		return col + '-' + row;
	}
	
	function mapPath() {
	
		for(var i=0; i < maxlegs; i++ ){
			
			var hex;
			
			if( i > 0 ) {
				var prevHex = hexPath[i-1];
				hex = new HexPoint( nextHex( prevHex ), varyDirection( prevHex.direction ) );
			} else {
				
				var startPt = startPoints[ Math.floor(Math.random() * startPoints.length) ];
				//console.log(startPt);
				hex = new HexPoint( startPt[0], startPt[1]) ;
			}
			
			
			if( isUnique(hex) && inBounds(hex) ) {
				hexPath.push(hex);
			} else {
				break;
			}
			
		}
		
		if(hexPath.length == maxlegs){
			activateHexPath();
		} else {
			hexPath = [];
			mapPath();
		}
			
	}
	
	function isUnique(hexObj) {
		
			var latch = true;
			for (var i=0; i < hexPath.length; i++ ) {
				if(hexObj.name === hexPath[i].name) {
					latch = false;
					break;
				}
			}
		
			return latch;
		
		}
		
	function inBounds(hexObj) {
		return hexObj.coordinates.col <= maxcols && hexObj.coordinates.col > 0 && hexObj.coordinates.row <= maxrows && hexObj.coordinates.row >= 0;
	}


	
	
	function getCoordinates(hex){
			
			var delimeterPos = hex.indexOf('-');
			
			return {
				col : Number( hex.substr(0, delimeterPos) ),
				row : Number( hex.substr(delimeterPos + 1) )
			}
	}
	
	function varyDirection(dirIndex) {
		
		var dirs = [
		(dirIndex === 1) ? 6 : dirIndex - 1, 
		dirIndex, 
		(dirIndex === 6) ? 1 : dirIndex + 1
		];
		
		return dirs[ Math.floor(Math.random() * 3) ];
		
	}
	
	function nextHex(hexObj) {
			
			var odd = hexObj.coordinates.col % 2 ? true : false;
			var newcol, newrow;
			
			switch (hexObj.direction) {
				 case 1: 
				 //odd mode upper right: col + 1, row -1					 
				 //even mode upper right: col + 1, row =
				 newcol = hexObj.coordinates.col + 1;
				 newrow = odd ? hexObj.coordinates.row - 1 : hexObj.coordinates.row;
				 break;
				 case 2: 
				 //odd mode right: col + 2, row =
				 //even mode right: col + 2, row =
				 newcol = hexObj.coordinates.col + 2;
				 newrow = hexObj.coordinates.row;
				 break;
				 case 3:
				 //odd mode lower right: col + 1, row =
				 //even mode lower right: col + 1, row +1
				 newcol = hexObj.coordinates.col + 1;
				 newrow = odd ? hexObj.coordinates.row : hexObj.coordinates.row + 1;
				 break;
				 case 4:
				 //odd mode lower left right: col - 1, row =
				 //even mode lower left right: col - 1, row +1
				 newcol = hexObj.coordinates.col - 1;
				 newrow = odd ? hexObj.coordinates.row : hexObj.coordinates.row + 1;
				 break;
				 case 5:
				 //odd mode left : col - 2, row =
				 //even mode left : col - 2, row =
				 newcol = hexObj.coordinates.col - 2;
				 newrow = hexObj.coordinates.row;
				 break;
				 case 6:
				 //odd mode upper left : col - 1, row -1
				 //even mode upper left : col - 1, row =
				 newcol = hexObj.coordinates.col - 1;
				 newrow = odd ? hexObj.coordinates.row - 1 : hexObj.coordinates.row;
				 break;
				 default:
				 newcol = hexObj.coordinates.col;
				 newrow = hexObj.coordinates.row;
			}//switch
				
				return newcol + '-' + newrow;
			
		}
};