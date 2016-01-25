/*-------------------------------------------------------
DESCRIPTION:

AUTHOR(S): Alan Bridgeman
VERSION: 1.0 (2015-02-02)
-------------------------------------------------------*/

/*-------------------------------------------------------
DESCRIPTION: Creates the new character tab and sets it to 
the active tab. Then disables all other tabs.

PARAMS: N/A
RETURNS: None
-------------------------------------------------------*/
function addNewCharTab()
{
	addTab
	(
		$("#charTabs").tabs(),
		"New Tab",
		"																					" +
		"	<button id='backButton' title='Go Back' onClick='removeNewCharTab()'></button>	" +
		"	<br />																			" +
		"	<br />																			" +
		"	<form>																			" +
		"	<center>																		" +
		"		<input type='text' placeHolder='Character Name' />							" +
		"		<br />																		" +
		"		<br />																		" +
		"		<br />																		" +
		"		<div id='charSex'>															" +
		"			<input type='radio' id='sex1' name='sex' value='male' checked />		" +
		"			<label for='sex1'>Male</label>											" +
		"			<input type='radio' id='sex2' name='sex' value='female' />				" +
		"			<label for='sex2'>Female</label>										" +
		"		</div>																		" +
		"		<br />																		" +
		"		<br />																		" +
		"		<h4>Character Base Class</h4>												" +
		"		<ol id='selectable'>														" +
		"			<li class='ui-widget-content'>Fighter</li>								" +
		"			<li class='ui-widget-content'>Mage</li>									" +
		"			<li class='ui-widget-content'>Claric</li>								" +
		"			<li class='ui-widget-content'>Ranger</li>								" +	
		"			<li class='ui-widget-content'>Rouge/Assasin</li>						" +
		"			<li class='ui-widget-content'>Bard</li>									" +
		"			<li class='ui-widget-content'>Item 7</li>								" +
		"		</ol>																		" +
		"	<!-- -->																		" +
		"	<br />																			" +
		"	<br />																			" +
		"	<h4>Organize Character Stats</h4>												" +
		"	<div id='stats' style='height:200px;'>														" +
		"	<ul id='sortable1' c;8lass=''>													" +
		"		<li class='ui-state-default'>Strength</li>									" +
		"		<li class='ui-state-default'>Constitution</li>								" +
		"		<li class='ui-state-default'>Dexterity</li>									" +
		"		<li class='ui-state-default'>Intelegence</li>								" +
		"		<li class='ui-state-default'>Charisma</li>									" +
		"		<li class='ui-state-default'>Wisdom</li>									" +
		"	</ul>																			" +
		"																					" +
		"	<ul id='sortable2' class='connectedSortable'>									" +
		"	</ul>																			" +
		"	</div>																			" +
		"	<br />																			" +
		"	<br />																			" +
		"		<fieldset>																	" +
		"			<label for='speed'>Select a speed</label>								" +
		"			<select name='speed' id='speed'>										" +
		"				<option>Slower</option>												" +
		"				<option>Slow</option>												" +
		"				<option selected='selected'>Medium</option>							" +
		"				<option>Fast</option>												" +
		"				<option>Faster</optio;n>											" +
		"			</select>																" +
		"		</fieldset>																	" +
		"		<br />																		" +
		"		<br />																		" +
		"		<button id='resetButton' type='reset'>Reset</button>						" +
		"		<button id='createButton' type='submit'>Create</button>						" +
		"		</center>" +
		"	</form>																			"
	);
	$("#backButton").button
	(
		{
			icons:
			{
				primary: "ui-icon-carat-1-w"
			},
			text: false
		}
	);
	$( "#charSex" ).buttonset();
	$( "#sortable1, #sortable2" ).sortable
	(
		{
			connectWith: ".connectedSortable",
			containment: "#newPane",
			cursor: "move",
			placeholder: "sortable-placeholder",
			start: function(event, ui) {
            var start_pos = ui.item.index();
            ui.item.data('start_pos', start_pos);
        },
        update: function(event, ui) {
            var start_pos = ui.item.data('start_pos');
            var end_pos = ui.item.index();
            //alert(start_pos + ' - ' + end_pos);
        },
			receive:
				function(event, ui)
				{
					//alert(ui.item.html());
					var n = $("#stats").noty({layout:'top', text: ui.item.html()});
				}
		}
	).disableSelection();
	$("#speed").selectmenu();
	$("#resetButton").button
	(
		{
			icons:
				{
					primary: "ui-icon-arrowreturnthick-1-w"
				},
				text: true
		}
	);
	$("#createButton").button
	(
		{
			icons:
			{
				primary: "ui-icon-plus"
			},
			text: true
		}
	);					
	$("#selectable").selectable();
	$("#charTabs").tabs( "option", "active", 2 );
	$("#charTabs").tabs( "option", "disabled", [ 0, 1 ] );
}

/*-------------------------------------------------------
DESCRIPTION: Removes the new character tab, enables all 
the other tabs again and sets the first tab as active.

PARAMS: N/A
RETURNS: None
-------------------------------------------------------*/
function removeNewCharTab()
{
	removeTab($("#charTabs").tabs(), "newPane");
	$("#charTabs").tabs("enable");
	$("#charTabs").tabs("option", "active", 0);
}