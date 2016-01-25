/*-------------------------------------------------------
DESCRIPTION: The initial JQuery UI Component Setup.

AUTHOR(S): Alan Bridgeman
VERSION: 1.0 (2015-02-02)
-------------------------------------------------------*/
$
(
	function()
	{	
		$(document).tooltip();
		
		$("#container, #msgTabs, #charTabs").tabs();
		$("#msgPanel, #mapPanel, #charPanel")
		.resizable()
		.draggable
		(
			{
				containment: "#playView",
				handle: "h3",
				opacity: 0.35
			}
		);
		$("#pmAccordion, #mapAccordion, #invAccordion").accordion
		(
			{
				collapsible: true
			}
		);
		$("#newButton").button
		(
			{
				icons:
				{
					primary: "ui-icon-plus"
				},
				text: false
			}
		);
    }
);