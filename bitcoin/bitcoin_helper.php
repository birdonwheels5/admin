<?php

function add_purchase($username, $bitcoin_amount, $date, $exchange_rate, $fiat_amount)
{
	$bitcoins_spent = 0;
		
	// Establish connection to the database
	$con=mysqli_connect("127.0.0.1", "root", "", "bitcoin_tracker");
	
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$insert = "INSERT INTO `bitcoin_tracker`.`" . $username . "` (`amount_purchased`, `date`, `exchange_rate`, `fiat_paid`, `bitcoins_spent`) VALUES (" . $bitcoin_amount . ", \"" . $date . "\", " . $exchange_rate . ", " . $fiat_amount . ", " . $bitcoins_spent . ")";
	
	// Execute insertion
	if (mysqli_query($con, $insert)) 
	{
		// echo "Bitcoin purchase added successfully";
	} 
	else 
	{
		echo "Error inserting bitcoin purchase: " . mysqli_error($con);
	}
}

function add_spend($username, $bitcoins_spent, $date, $exchange_rate)
{
	
	$bitcoin_amount = 0;
	$fiat_amount = 0;
	
	// Establish connection to the database
	$con=mysqli_connect("127.0.0.1", "root", "", "bitcoin_tracker");
	
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$insert = "INSERT INTO `bitcoin_tracker`.`" . $username . "` (`amount_purchased`, `date`, `exchange_rate`, `fiat_paid`, `bitcoins_spent`) VALUES (" . $bitcoin_amount . ", \"" . $date . "\", " . $exchange_rate . ", " . $fiat_amount . ", " . $bitcoins_spent . ")";
	
	// Execute insertion
	if (mysqli_query($con, $insert)) 
	{
		echo "Bitcoin sell added successfully";
	} 
	else 
	{
		echo "Error inserting bitcoin sell: " . mysqli_error($con);
	}
}

function get_bitcoin_data($username)
{
	// Establish connection to the database
	$con=mysqli_connect("127.0.0.1", "root", "", "bitcoin_tracker");
	
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$result = mysqli_query($con, "SELECT * FROM `" . $username . "`");
	
	// Obtain the number of rows from the result of the query
	$num_rows = mysqli_num_rows($result);
			
	// Will be storing all the rows in here
	$array_of_rows = array();
							
	// Get all the rows
	for($i = 0; $i < $num_rows; $i++)
	{
		$array_of_rows[$i] = mysqli_fetch_array($result);
	}
	$size_of_array_of_rows = $num_rows;
							
	$bitcoins_bought = array();
	$date_values = array();
	$exchange_values = array();
	$fiat_values = array();
	$bitcoins_spent = array();
	$fiat_spent = array();
	
	// Get an array of the past N values for each field
	for($i = 0; $i < $size_of_array_of_rows; $i++)
	{
		$bitcoins_bought[$i] = $array_of_rows[$i]["amount_purchased"];
		$date_values[$i] = $array_of_rows[$i]["date"];
		$exchange_values[$i] = $array_of_rows[$i]["exchange_rate"];
		$fiat_values[$i] = $array_of_rows[$i]["fiat_paid"];
		$bitcoins_spent[$i] = $array_of_rows[$i]["bitcoins_spent"];
	}
	
	// Calculate how much fiat was spent from bitcoin spent
	for($i = 0; $i < $size_of_array_of_rows; $i++)
	{
		$fiat_spent[$i] = $bitcoins_spent[$i] * $exchange_values[$i];
	}
	
	$data = array();
	
	$data[0] = $bitcoins_bought;
	$data[1] = $date_values;
	$data[2] = $exchange_values;
	$data[3] = $fiat_values;
	$data[4] = $bitcoins_spent;
	$data[5] = $fiat_spent;
	
	return $data;
}

function calculate($data)
{
	if(is_array($data))
	{
		$bitcoins_bought = $data[0];
		$date_values = $data[1];
		$exchange_values = $data[2];
		$fiat_values = $data[3];
		$bitcoins_spent = $data[4];
		$fiat_spent = $data[5];
		
		// Perform operations on all the arrays, and pack them into a new array
		$avg = count($bitcoins_bought);
		
		$values = array();
		
		// Total amount of bitcoins ever purchased
		$values[0] = array_sum($bitcoins_bought);
		
		// Average of exchange rates (probably will not be using this)
		$values[1] = array_sum($exchange_values)/$avg;
		
		// Total fiat paid for bitcoin
		$values[2] = array_sum($fiat_values);
		
		// Total bitcoins spent
		$values[3] = array_sum($bitcoins_spent);
		
		// Net bitcoin total
		$values[4] = $values[0] - $values[3];
		
		// Total fiat spent
		$values[5] = array_sum($fiat_spent);
		
		// Net fiat total
		$values[6] = $values[2] - $values[5];
		
		// Cost per bitcoin
		if($values[6] > 0)
		{
			$values[7] = $values[6] / $values[4]; 
			$values[8] = 0; // profit does not exist
		}
		else
		{
			$values[8] = -1 * $values[6]; // Keep track of total profit
			$values[7] = 0; // indicates you made a profit; 0 cost per bitcoin
		}
		
		return $values;
	}
	else
	{
		return -1;
	}
}

function get_btc_price()
{
	$btc_price = 0;
	
	$url = fopen("https://www.bitstamp.net/api/ticker/", "r");
	
	$json = json_decode(stream_get_contents($url));
	
	$btc_price = $json->{"ask"};
	
	return $btc_price;
}

?>
