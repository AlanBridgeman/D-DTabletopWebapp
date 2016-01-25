/*-------------------------------------------------------
DESCRIPTION:

AUTHOR(S): Alan Bridgeman
VERSION: 1.0 (2015-02-02)
-------------------------------------------------------*/

/*-------------------------------------------------------
DESCRIPTION: Adds a new tab with the specified title and 
content to the specified tabs container.

PARAMS:
	tabs - The tabs container to add the tab to.
	tabTitle - The new tabs title.
	tabContent - The new tabs content.
RETURNS: None
-------------------------------------------------------*/
function addTab(tabs, tabTitle, tabContent)
{
	var label = tabTitle;
	var id = "newPane";
	var li = $("<li><a href='#{href}'>#{label}</a></li>".replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) );
	var tabContentHtml = tabContent;
	
	tabs.find( ".ui-tabs-nav" ).append( li );
	tabs.append( "<div id='" + id + "'>" + tabContentHtml + "</div>" );
	tabs.tabs( "refresh" );
}

/*-------------------------------------------------------
DESCRIPTION: Removes the tab with the given id from the 
tabs container specified.

PARAMS:
	tabs - The tabs container to remove that tab from.
	id - The id of the tab to be removed (NO #)
RETURNS: None
-------------------------------------------------------*/
function removeTab(tabs, id)
{
	var panelId = $("a[href='#" + id + "']").closest( "li" ).remove().attr( "aria-controls" );
	$("#"+ id).remove();
	tabs.tabs("refresh");
}