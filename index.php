<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Portal Home</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "service_checker.php"; ?>
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
			
			<article> <!-- style="color:#FFFFFF;"> -->
				<p>
					<!-- <center><img src="logo_big.png"></center> Insert Main Logo here -->
					
					<hr/>
					<center><h1>Admin Panel</h1></center>
					<hr/>
					<p>
						...
						
						<form action="upload.php" method="post" enctype="multipart/form-data">
							Select file to upload:
							<input type="file" name="fileToUpload" id="fileToUpload">
							<input type="submit" value="Upload File" name="submit">
						</form>
						
						<br/>
						
						<table>
						<tr>
							<td>Service</td>
							<td>Online Status</td>
							<td>Something</td>
						</tr>
							<tr>
								<td>Insight</td>
								<td><?php is_service_up("http://192.168.1.120:3000"); ?></td>
							</tr>
							
							<tr>
								<td>MYR Sha256</td>
								<td><?php is_service_up("http://192.168.1.120:5578"); ?></td>
							</tr>
							
							<tr>
								<td>MYR Skein</td>
								<td><?php is_service_up("http://192.168.1.120:5589"); ?></td>
							</tr>
							
							<tr>
								<td>MYR Groestl</td>
								<td><?php is_service_up("http://192.168.1.120:3333"); ?></td>
							</tr>
							
							<tr>
								<td>MYR Qubit</td>
								<td><?php is_service_up("http://192.168.1.120:5567"); ?></td>
							</tr>
							
							<!-- <tr>
								<td>DGB Sha256</td>
								<td><?php //is_service_up("http://192.168.1.120:5011"); ?></td>
							</tr>
							
							<tr>
								<td>DGB Skein</td>
								<td><?php //is_service_up("http://192.168.1.120:5031"); ?></td>
							</tr>
							
							<tr>
								<td>DGB Groestl</td>
								<td><?php //is_service_up("http://192.168.1.120:5021"); ?></td>
							</tr> 
							
							<tr>
								<td>DGB Qubit</td>
								<td><?php //is_service_up("http://192.168.1.120:5041"); ?></td>
							</tr> -->
							
							<tr>
								<td>Private Website</td>
								<td><?php is_service_up("https://192.168.1.120"); ?></td>
							</tr>
							
							<tr>
								<td>Varnish</td>
								<td><?php is_service_up("http://birdonwheels5.no-ip.org"); ?></td>
							</tr>
							
						</table>
						
						<p>
							Links for pool hubs:<br/>
							<a href ="http://birdonwheels5.no-ip.org/myr-hub">MYR Hub</a><br/>
							<a href ="http://birdonwheels5.no-ip.org/dgb-hub">DGB Hub</a><br/>
							
							<br/>
							<iframe src="//birdonwheels5.no-ip.org/myr-hub" style="width:100%;height:1500px;"></iframe>
							<br/>
							<hr/>
							<br/>
							<iframe src="//birdonwheels5.no-ip.org/dgb-hub" style="width:100%;height:1500px;"></iframe>

						</p>

					</p>

				</p>
			
			
			</article>
			
			<div class="paddingBottom">
			</div>
			
			<footer>
				2014 birdonwheels5.
			</footer>
		</div>
	</body>
	
</html>
