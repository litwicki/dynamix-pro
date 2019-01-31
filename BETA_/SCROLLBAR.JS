// variables
var mouseover = false;
var scrolldirection;
var scrollratio;
var theheartbeat, scrolling;
var menuOffsetTop = menuOffsetLeft = menuMaxHeight = 0;
var currentX = currentY = 0;
var whichIt = null;

// events
document.onmousedown = grabIt;
document.onmousemove = moveIt;
document.onmouseup = dropIt;

// switch direction scroller will move while pressing a button
function switchit(obj, cmd)
{
	if (cmd == 'in')
	{
		mouseover = true;
		if (obj.getAttribute('id') == "scrollup")
		{
			scrolldirection = -1;
		}
		else
		{
			scrolldirection = 1;
		}
	}
	else
	{
		mouseover = false;
	}
}

function scroll()
{
	if (((scrollbox.style.pixelTop + menuOffsetTop + scrolldirection) >= menuOffsetTop) && ((scrollbox.style.pixelTop + menuOffsetTop + scrolldirection) <= (menuOffsetTop + menuMaxHeight - scrollbox.style.pixelHeight)))
	{
		scrollbox.style.pixelTop += scrolldirection;
	}
}

function heartBeat()
{
	data.style.pixelTop = -1 * scrollratio * (scrollbox.style.pixelTop + menuOffsetTop - menuOffsetTop);
}

function grabIt(e) {
	if (event.button == 1)
	{
		if (mouseover)
			scrolling = window.setInterval("scroll();",1);
		else
		{
			whichIt = event.srcElement;
			while (whichIt.id.indexOf("scrollbox") == -1) {
				whichIt = whichIt.parentElement;
				if (whichIt == null) { return true; }
		    }
//			whichIt.style.pixelLeft = whichIt.offsetLeft;
		    whichIt.style.pixelTop = whichIt.offsetTop;
			currentX = (event.clientX + document.body.scrollLeft);
			currentY = (event.clientY + document.body.scrollTop);
		}
	
		theheartbeat = window.setInterval("heartBeat()",1);
	}
}

function moveIt(e) {
	if (whichIt == null) { return false; }
	newX = (event.clientX + document.body.scrollLeft);
    newY = (event.clientY + document.body.scrollTop);
    distanceX = (newX - currentX);
	distanceY = (newY - currentY);
    currentX = newX;
	currentY = newY;
	if (((scrollbox.style.pixelTop + menuOffsetTop + distanceY) >= menuOffsetTop) && ((scrollbox.style.pixelTop + menuOffsetTop + distanceY) <= (menuOffsetTop + menuMaxHeight - scrollbox.style.pixelHeight)))
	{
    	scrollbox.style.pixelTop += distanceY;
	}
	event.returnValue = false;
	return false;
}

function dropIt() {
	clearInterval(scrolling);
	clearInterval(theheartbeat);
	whichIt = null;
}

function init()
{
	menuOffsetTop = floater.style.pixelTop;
	menuMaxHeight = floater.style.pixelHeight;
	
	getscrollinc();
}

function getscrollinc()
{
	var contentinc;
	var scrollerinc;
	var contentHeight = data.offsetHeight;
	var scrollerHeight = content.style.pixelHeight;

	if (scrollerHeight < contentHeight)
	{
		contentinc = content.style.pixelHeight / contentHeight;
		scrollerinc = floater.style.pixelHeight*contentinc;
		scrollratio = contentHeight / floater.style.pixelHeight;
	}
	else
	{
		scrollerinc = floater.style.pixelHeight;
		contentinc = 1;
	}
	
	scrollbox.style.height = scrollerinc;
}