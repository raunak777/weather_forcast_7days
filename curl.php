<?php
if (isset($_POST)) {
	$city = $_POST['city'];
	$apikey = '3eab486f7cfe47329c52dc4970242d86';
	$wheatherApi = "https://api.weatherbit.io/v2.0/forecast/daily?city_id=".$city."&days=7&key=".$apikey;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $wheatherApi);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	print_r($data);
}

?>