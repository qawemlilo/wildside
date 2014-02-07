$(document).ready(function() {

	// Adds title attributes and classnames to list items
	 
	$("ul li a:contains('Dashboard')").addClass("dashboard").attr('title', 'Dashboard');
	$("ul li a:contains('Pages')").addClass("pages").attr('title', 'Pages');
	$("ul li a:contains('Media')").addClass("media").attr('title', 'Media');
	$("ul li a:contains('History')").addClass("history").attr('title', 'History');
	$("ul li a:contains('Messages')").addClass("messages").attr('title', 'Messages');
	$("ul li a:contains('Settings')").addClass("settings").attr('title', 'Settings');
	
	// Add class to last list item of submenu
	
	$("ul.submenu li:last-child").addClass("last");
	
	$("ul li:has(ul)").hover(function(){
		$(this).find("ul.submenu").stop("true", "true").slideDown(500);
		}, function(){
		$(this).find("ul.submenu").stop("true", "true").slideUp(500);
	});
	
});