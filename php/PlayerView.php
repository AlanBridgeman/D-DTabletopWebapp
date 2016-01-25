<?php
	require_once ('/php/API/MysqliDb.php');
	$db = new MysqliDb ('localhost', 'root', '', 'dnd');
?>
<div id="playView">
				<div id="msgPanel" class="ui-widget-content">
					<h3 class="ui-widget-header">Communicator</h3>
					<div id="msgTabs">
						<ul>
							<li>
								<a href="#chatPane">Chat</a>
							</li>
							<li>
								<a href="#pmPane">Private Message</a>
							</li>
						</ul>
						<div id="chatPane">
							<?php
								$posts = $db->get('Posts');
								foreach($posts as $x) {
									echo '<label><font color="blue">' . $db->where('id', $x['uId'])->getOne('Users')['fName'] . '</font></label>:<span> ' . $x['message'] . '</span><br />' . "\n";
								}
							?>
						</div>
						<div id="pmPane">
							<div id="pmAccordion">
								<?php
									$members = $db->where('pId', /*$_SESSION['pId']*/'0')->get('Parties');
									foreach($members as $member) {
										echo '<h4>' . $db->where('id', $member['uId'])->getOne('Users')['fName'] . "</h4>\n<div></div>\n";
									}
								?>
								<h4>Eric Collett</h4>
								<div></div>
								<h4>Ryan King</h4>
								<div></div>
							</div>
						</div>
					</div>
					<div id="msgform">
						<form action="php/post.php" method="post">
							<textarea id="message" name="message" placeHolder="Enter Text Here."></textarea>
							<button>Send</button>
						</form>
					</div>
				</div>
				<div id="mapPanel" class="ui-widget-content">
					<h3 class="ui-widget-header">Maps</h3>
					<div id="mapAccordion">
						<h4>World Map</h4>
						<div class="zoomViewport">
							<div class="zoomContainer">
								<div id="gridbox">
									<style>
										#gridbox {
											background-color:#0000EE;
										}
										.grid {
											margin:1em auto;
											border-collapse:collapse
										}
										.grid td {
											cursor:pointer;
											width:30px;
											height:30px;
											border:1px solid #ccc;
											text-align:center;
											font-family:sans-serif; font-size:13px
										}
										.grid td.clicked {
											background-color:yellow;
											font-weight:bold; color:red;
										}
									</style>
									<script type="application/javascript">
										var lastClicked;
										var grid = clickableGrid (
											10,
											10,
											function(el,row,col,i) {
												//console.log("You clicked on element:",el);
												//console.log("You clicked on row:",row);
												//console.log("You clicked on col:",col);
												//console.log("You clicked on item #:",i);
												el.style.backgroundColor = 'yellow';
												e1.style.fontWeight = 'bold';
												e1.style.color = 'red';
												//if (lastClicked) lastClicked.className='';
												//lastClicked = el;
											}
										);
										
										document.getElementById("gridbox").appendChild(grid);
										
										function clickableGrid(rows, cols, callback) {
											var i = 0;
											var grid = document.createElement('table');
											grid.className = 'grid';
											for (var r = 0;r < rows;++r) {
												var tr = grid.appendChild(document.createElement('tr'));
												for (var c = 0;c < cols;++c) {
													var cell = tr.appendChild(document.createElement('td'));
													cell.className = 'zoomTarget';
													cell.setAttribute("data-closeClick", "true");
													//cell.innerHTML = ++i;
													cell.addEventListener (
														'click',
														(
															function(el,r,c,i){
																return function() {
																	callback(el,r,c,i);
																}
															}
														)
														(cell,r,c,i),
														false
													);
												}
											}
											return grid;
										}
									</script>
								</div>
								<!-- <div class="zoomTarget" data-targetsize="1.25" data-duration="600">
								<svg width="100%" height="100%">
									<ellipse cx="50%" cy="50%" rx="50%" ry="50%" style="fill:purple" />
									<defs>
										<pattern id="smallGrid" width="8" height="8" patternUnits="userSpaceOnUse">										
											<path d="M 8 0 L 0 0 0 8" fill="none" stroke="gray" stroke-width="0.5"/>
										</pattern>
										<pattern id="grid" width="80" height="80" patternUnits="userSpaceOnUse">
											<rect width="80" height="80" fill="url(#smallGrid)"/>
											<path d="M 80 0 L 0 0 0 80" fill="none" stroke="gray" stroke-width="1"/>
										</pattern>
									</defs>
									<rect width="100%" height="100%" fill="url(#grid)" />
								</svg>
								<!-- </div> -->
							</div>
						</div>
						<h4>Local Map</h4>
						<div></div>
					</div>
				</div>
				<div id="charPanel" class="ui-widget-content">
					<h3 class="ui-widget-header">Characters</h3>
					<div id="charTabs">
						<ul>
							<li>
								<a href="#sheetPane">Character Sheet</a>
							</li>
							<li>
								<a href="#invPane">Inventory</a>
							</li>
						</ul>
						<div id="sheetPane">
							<button id="newButton" title="Create New" onClick="addNewCharTab()"></button>
							<table>
								<tr>
									<th>#</th>
									<th>Name</th>
								</tr>
								<tr>
									<td>12</td>
									<td>Str</td>
								</tr>
								<tr>
									<td>12</td>
									<td>Con</td>
								</tr>
								<tr>
									<td>12</td>
									<td>Dex</td>
								</tr>
								<tr>
									<td>12</td>
									<td>Int</td>
								</tr>
								<tr>
									<td>12</td>
									<td>Wis</td>
								</tr>
								<tr>
									<td>12</td>
									<td>Chr</td>
								</tr>
							</table>
						</div>
						<div id="invPane">
							<div id="invAccordion">
								<h4>Player Inventory</h4>
								<div></div>
								<h4>Party Inventory</h4>
								<div></div>
							</div>
						</div>
					</div>
				</div>
			</div>