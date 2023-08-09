<?php
error_reporting(E_ERROR | E_PARSE);

if(isset($_GET['country'])){
    $country_name = $_GET['country'];
    $url = 'https://api.covid19api.com/dayone/country/'.$country_name;

	$response = file_get_contents($url);

	if($response){
		$response = json_decode($response, true);
        if(isset($_GET['chart_type'])){
			$chart_type = $_GET['chart_type'];
			foreach($response as $key=>$value){
				if($chart_type == 'confirmed'){
					echo $value['Confirmed'].'.';
				}elseif($chart_type == 'death'){
					echo $value['Deaths'].'.';
				}elseif($chart_type == 'recovered'){
					echo $value['Recovered'].'.';
				}
	
			}
		}elseif(isset($_GET['date'])){
			foreach($response as $key=>$value){
				$date = $value['Date'];
				$date = substr($date, 0, strpos($date, "T"));
				echo $date.'.';
			}
		}
        
	}else{
		echo 'We have troubles right now, try again later...';
	}
}else{
	echo 'Error';
}