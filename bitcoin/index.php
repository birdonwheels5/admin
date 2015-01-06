<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Bitcoin Tracker</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "bitcoin_helper.php"; ?>
	</head>
	
	<body link="#E2E2E2" vlink="#ADABAB">
		<center><div class="container">
	
		
			<header>
		
				<div class="logoContainer">
					<!-- <img src="logo-bar.png"> -->
				</div>
				
				<div class="button">
					<p><a href ="index.html">Home</a></p>
				</div>
				
				<div class="button">
					<p><a href ="CryptoHub.html">Crypto Hub</a></p>
				</div>
				
				<div class="button">
					<p><a href ="http://birdstekkit.enjin.com" target="_blank">Minecraft Servers</a></p>
				</div>
				
				<div class="button">
					<p><a href ="https://birdonwheels5.no-ip.org/index.php">Cloud Server</a></p>
				</div>
				
			</header>
			
			<article style="color:#FFFFFF;">
				<p>
					<!-- <center><img src="logo_big.png"></center> Insert Main Logo here -->
					
					<hr/>
					<center><h1>Bitcoin Tracker</h1></center>
					<hr/>
					<p>
						
						<?php
						
						// Get current information
						$values = array();
						$result = array();
						
						$values = get_bitcoin_data("birdonwheels5");
						$result = calculate($values);
						
						?>
						
						<div class="box">
							<p>
								Welcome! This tool lets you track bitcoin purchases and spends.
							</p>
						</div>
						
						<div class="box">
							<p>
								<center><h3>Bitcoin Summary Statistics</h3>
								
								<table>
								<tr>
									<td>
										Total bitcoins ever purchased: 
									</td>
									<td>
										<?php echo $result[0]; ?>
									</td>
								</tr>
								<tr>
									<td>
										Bitcoins left in wallet: 
									</td>
									<td>
										<?php echo $result[4]; ?>
									</td>
								</tr>
								<tr>
									<td>
										Total fiat paid: 
									</td>
									<td>
										<?php echo $result[2]; ?>
									</td>
								</tr>
								<tr>
									<td>
										Price per bitcoin (cost average): 
									</td>
									<td>
										<?php echo $result[7]; ?>
									</td>
								</tr>
								<tr>
									<td>
										Total profit: 
									</td>
									<td>
										<?php echo $result[8]; ?>
									</td>
								</tr>
								
								</table></center>
								
								
							</p>
						</div>
						
						<div class="box">
							<center><form method="link" action="new_purchase.php">
								<input type="submit" value="Add Bitcoin Purchase">
							</form>
							&nbsp; &nbsp;
							<form method="link" action="new_spend.php">
							<input type="submit" value="Add Bitcoin Spend">
							</form></center>
						</div>
						
						<div class="box">
							<p>
								<center><h3>Full Transaction History</h3></center>
								<table style="width:100%;height:80%">
									<tr>
										<td>
											Transaction #
										</td>
										<td>
											Bitcoins Purchased
										</td>
										<td>
											Fiat Paid
										</td>
										<td>
											Exchange Rate
										</td>
										<td>
											Bitcoins Spent
										</td>
										<td>
											Fiat Spent
										</td>
										<td>
											Date
										</td>
									</tr>
									<?php
										for( $i = 0; $i < count($values[0]); $i++)
										{
											print "
											<tr>
												<td>" .
													($i + 1) .
												"</td>
												<td>" .
													$values[0][$i] .
												"</td>
												<td>" .
													$values[3][$i] .
												"</td>
												<td>" .
													$values[2][$i] .
												"</td>
												<td>" .
													$values[4][$i] .
												"</td>
												<td>" .
													$values[5][$i] .
												"</td>
												<td>" .
													$values[1][$i] .
												"</td>
											</tr>";
										}
									?>
								</table>
							</p>
						</div>

					</p>

				</p>
			
			
			</article>
			
			<div class="paddingBottom">
			</div>
			
			<footer>
				2015 birdonwheels5.
			</footer>
		</div>
	</body>
	
</html>
