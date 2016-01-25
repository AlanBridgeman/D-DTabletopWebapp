<?php
    session_start();
	
	require_once ('/php/API/MysqliDb.php');
	$_SESSION['db'] = new MysqliDb ('localhost', 'root', '', 'dnd');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, width=device-width, height=device-height, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title>Home</title>
<?php
		//if(isset($_SESSION['uID'])) {
?>
		<link rel="stylesheet" type="text/css" href="css/API/JQueryUI.css">
		
		<script src="jcubic-jquery.terminal-0.8.8-1-g18f9ae9/js/jquery.mousewheel-min.js"></script>
		<script src="jcubic-jquery.terminal-0.8.8-1-g18f9ae9/js/jquery.terminal-min.js"></script>
		<link href="jcubic-jquery.terminal-0.8.8-1-g18f9ae9/css/jquery.terminal.css" rel="stylesheet"/>
		<!--[if IE]>
			<style>
				body
				{
					margin: 0;
					padding: 0;
				}
				.tilda
				{
					position: absolute;
				}
			</style>
			<script>
				jQuery(document).ready
				(
					function($)
					{
						$(window).scroll
						(
							function()
							{
								$('.tilda').each
								(
									function()
									{
										$(this).css
										(
											{
												top:
													$('body').prop('scrollTop')
											}
										);
									}
								);
							}
						);
					}
				);
		</script>
		<![endif]-->
		<script>
			String.prototype.strip = 
				function(char)
				{
					return
						this.replace
						(
							new RegExp
							(
								"^" + char + "*"
							),
							''
						)
						.replace
						(
							new RegExp
							(
								char + "*$"
							),
							''
						);
				};
			
			$.extend_if_has =
				function(desc, source, array)
				{
					for (var i=array.length;i--;)
					{
						if (typeof source[array[i]] != 'undefined')
						{
							desc[array[i]] = source[array[i]];
						}
					}
					return desc;
				};
			(
				function($)
				{
					$.fn.tilda =
						function(eval, options)
						{
							if ($('body').data('tilda'))
							{
								return $('body').data('tilda').terminal;
							}
							this.addClass('tilda');
							options =
								options
								||
								{};
							eval =
								eval 
								|| 
								function(command, term) 
								{
									term.echo("you don't set eval for tilda");
								};
							
							var settings =
								{
									prompt: 'tilda> ',
									name: 'tilda',
									height: 100,
									enabled: false,
									greetings: 'Quake like console',
									keypress:
										function(e)
										{
											if (e.which == 96)
											{
												return false;
											}
										}
								};
								
								if (options)
								{
									$.extend(settings, options);
								}
								
								this.append('<div class="td"></div>');
								var self = this;
								self.terminal = this.find('.td').terminal(eval, settings);
								var focus = false;
								$(document.documentElement).keypress
								(
									function(e)
									{
										if (e.which == 96)
										{
											self.slideToggle('fast');
											self.terminal.focus(focus = !focus);
											self.terminal.attr
											(
												{
													scrollTop:
														self.terminal.attr("scrollHeight")
												}
											);
										}
									}
								);
								$('body').data('tilda', this);
								this.hide();
								return self;
						};
				}
			)(jQuery);
			//--------------------------------------------------------------------------
			jQuery(document).ready
			(
				function($)
				{
					$('#tilda').tilda
					(
						function(command, terminal)
						{
							if(command.toUpperCase() == "help".toUpperCase())
							{
								terminal.echo('You need help?');
							}
							terminal.echo('you type command "' + command + '"');
						}
					);
				}
			);
		</script>
		
		<link rel="stylesheet" type="text/css" href="css/Main.css">
		<link rel="stylesheet" type="text/css" href="css/PlayerView.css">
	</head>
	<body>
		<div id="container">
			<ul>
				<li>
					<a href="#playView" title="Players View">Player View</a>
				</li>
				<li>
					<a href="#dmView">DM View</a>
				</li>
				<li>
					<a href="#adminView">Admin View</a>
				</li>
			</ul>
			
			<?php include_once('php/PlayerView.php');echo "\n"; ?>
			<?php include_once('DMView.html');echo "\n"; ?>
			<?php include_once('AdminView.html');echo"\n"; ?>
		</div>
		<script type="application/javascript" src="js/API/JQuery.js"></script>
		<script type="application/javascript" src="js/API/JQueryUI.js"></script>
		<script type="application/javascript" src="js/API/Noty.js"></script>
		<script type="application/javascript" src="js/API/Zoomooz.js"></script>
		<script type="application/javascript" src="js/JQueryUI_init.js"></script>
		<script type="application/javascript" src="js/Tabs.js"></script>
		<script type="application/javascript" src="js/NewChar.js"></script>
<?php
//}
//else {
//	echo "\t" . '</head>' . "\n";
//	echo "\t" . '<body>' . "\n";
//	header("Location: login.php");
//}
?>
	</body>
</html>