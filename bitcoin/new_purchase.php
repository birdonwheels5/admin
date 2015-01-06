<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Add Bitcoin Purchase</title>
		<link rel="stylesheet" type="text/css" href="styles.css" bitcoin_purchased="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" bitcoin_purchased="Font Styles"/>
		<?php include "bitcoin_helper.php"; ?>
	</head>
	
	<body link="#E2E2E2" vlink="#ADABAB">
		<center><div class="container">
	
		
			<header>
		
				<div class="logoContainer">
					<!-- <img src="logo-bar.png"> -->
				</div>
				
				<div class="button">
					<p><a href ="http://birdonwheels5.no-ip.org/home/index.html">Website Home</a></p>
				</div>
				
				<div class="button">
					<p><a href ="http://birdonwheels5.no-ip.org/home/CryptoHub.html">Crypto Hub</a></p>
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
					<center><h1>Add Bitcoin Purchase</h1></center>
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
								This form allows you to record a purchase of Bitcoins with fiat dollars.
							</p>
						</div>
						
						<div class="box">
						
						
						
							<?php
								// define variables and set to empty values
								$bitcoin_purchased_err = $exchange_rate_err = $fiat_spent_err = $date_err = "";
								$bitcoin_purchased = $exchange_rate = $fiat_spent = "";
								$date = "";
								$username = "birdonwheels5";
								$WAITING = -1;
								$FAILURE = 1;
								$SUCCESS = 0;
								$CONFIRM = 100;
								$form_executed = $WAITING;
								$redirectURL = "index.php";
								$empty = "";
								if ($_SERVER["REQUEST_METHOD"] == "POST") 
								{
									//if($_POST["submit"] and $_POST["submit"] == "Continue")
									//{
										if (empty($_POST["bitcoin_purchased"])) 
										{
											$bitcoin_purchased_err = "An amount is required";
										}
										else
										{
											if(!is_numeric($_POST["bitcoin_purchased"]))
											{
												$bitcoin_purchased_err = "The amount must be numeric.";
											}
											else
											{
												$bitcoin_purchased = cleanInput($_POST["bitcoin_purchased"]);
											}
										}
										
										if (empty($_POST["exchange_rate"])) 
										{
											$exchange_rate_err = "An exchange rate is required.";
										} 
										else 
										{
											if(!is_numeric($_POST["exchange_rate"]))
											{
												$exchange_rate_err = "The amount must be numeric.";
											}
											else
											{
												$exchange_rate = cleanInput($_POST["exchange_rate"]);
											}
										}
										
										if (empty($_POST["fiat_spent"])) 
										{
											$fiat_spent_err = "An amount is required.";
										} 
										else 
										{
											if(!is_numeric($_POST["fiat_spent"]))
											{
												$fiat_spent_err = "The amount must be numeric.";
											}
											else
											{
												$fiat_spent = cleanInput($_POST["fiat_spent"]);
											}
										}
										
										if (empty($_POST["date"])) 
										{
											$date_err = "A date is required.";
										} 
										else 
										{
											if(is_numeric($_POST["date"]))
											{
												$date_err = "The date cannot be numeric.";
											}
											else
											{
												(string)$date = (string)cleanInput($_POST["date"]);
												//$form_executed = $CONFIRM;
											}
										}
										
										if(empty($bitcoin_purchased) or empty($exchange_rate) or empty($fiat_spent) or empty($date))
										{
											$form_executed = $FAILURE;
										}
										else
										{
											// Execute purchase
									
											$form_executed = $SUCCESS;
											add_purchase($username, $bitcoin_purchased, $date, $exchange_rate, $fiat_spent);
											
											$form_executed = $SUCCESS;
											
											//header("Refresh: 4, URL = " . $redirectURL);
											//exit;
										}
									//}
								}
								/* if ($_POST["submit"] == "Confirm")  
								{
									// Execute purchase
									
									$form_executed = $SUCCESS;
									add_purchase($username, $bitcoin_purchased, $date, $exchange_rate, $fiat_spent);
								} */
								function cleanInput($data) 
								{
 								   $data = trim($data);
 								   $data = htmlspecialchars($data);
 								   return $data;
								}
							?>

							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

							<center>
								<div class="inputBox">
								<hr/>
								<center><table class="mainTable">
									<tr>
										<td>
											Bitcoin Purchased: 
										<td/>
										<td>
											<input type="text" name="bitcoin_purchased" value="<?php echo $bitcoin_purchased;?>" size="8"> &#x0E3F <!-- BTC symbol -->
											<span class="error">* <?php echo $bitcoin_purchased_err;?></span>
										<td/>
									</tr>
									<tr>
										<td>
											Exchange Rate: 
										<td/>
										<td>
											<input type="text" name="exchange_rate" value="<?php echo $exchange_rate;?>" size="8"> $
											<span class="error">* <?php echo $exchange_rate_err;?></span>
										<td/>
									<tr/>
									<tr>
										<td>
											 Fiat Spent: 
										<td/>
										<td>
											<input type="text" name="fiat_spent" value="<?php echo $fiat_spent;?>" size="8"> $
											<span class="error">* <?php echo $fiat_spent_err;?></span>
										<td/>
									<tr/>
									<tr>
										<td>
											 Date of Purchase: 
										<td/>
										<td>
											<input type="text" name="date" value="<?php echo $date;?>" size="8"> DD/MM/YY
											<span class="error">* <?php echo $date_err;?></span>
										<td/>
									<tr/>
									
									
								</table>
								<p>
									<font color="yellow">WARNING: Please review the information you entered before submitting. Once you submit, there is no way to edit or delete it.</font>
								</p>
								
								<center><input type="submit" name="submit" value="Submit"></center>
							
							<?php
								/* if ($form_executed == $CONFIRM)
								{
									print "<hr/>";
									print "<h3>Status:</h3><br>";
									print "Please confirm that this is the bounty that you wish to delete!";
									//echo $_SERVER["PHP_SELF"];
									//print "\">";
									print "<input type=\"submit\" name=\"submit\" value=\"Confirm\">";
								}
								if ($form_executed == $FAILURE)
								{
									print "<br/>";
									print "<h3>Status:</h3>";
									print "<hr/>";
									print "Bounty deletion failed!";
								} */
								if ($form_executed == $SUCCESS)
								{
									print "<br/>";
									print "<hr/>";
									print "Bitcoin purchase recorded!";
									print "<br>";
									header("Refresh: 4, URL = " . $redirectURL);
									exit;
								}
								?>
								
								</form>
							
							
							
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
