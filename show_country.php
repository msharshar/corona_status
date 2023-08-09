<!DOCTYPE html>
<html>
	<head>
		<title>Coronavirus Meter</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/show_country.css">
	</head>
	<body>
		<?php
		error_reporting(E_ERROR | E_PARSE);
		$url = 'https://api.covid19api.com/summary';

		if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['country'])){
			$country_name = $_GET['country'];

			$response = file_get_contents($url);

			if($response){
				$response = json_decode($response, true);
				foreach($response as $first){
					foreach($first as $last){
						if($last['Country'] == $country_name){
							if($_GET['type'] == 'stat'){
								?>
								<div class="stats">
									<h1><?php echo $last['Country'] ?></h1>
									<hr>
									<div class="right">
										<p>New Confirmed: <?php echo $last['NewConfirmed'] ?></p>
										<p>New Deaths: <?php echo $last['NewDeaths'] ?></p>
										<p>New Recovered: <?php echo $last['NewRecovered'] ?></p>
									</div>
									<div class="left">
										<p>Total Confirmed: <?php echo $last['TotalConfirmed'] ?></p>
										<p>Total Deaths: <?php echo $last['TotalDeaths'] ?></p>
										<p>Total Recovered: <?php echo $last['TotalRecovered'] ?></p>
									</div>
								</div>
								<?php	
							}elseif($_GET['type']){
								$chart_type = $_GET['type'];
								?>
								<input id="country_name" type="hidden" name="country_name" value="<?php echo $country_name ?>">
								<input id="chart_type" type="hidden" name="chart_type" value="<?php echo $chart_type ?>">
								<canvas id="myChart"></canvas>
								<?php
							}
							
						}
					}
				}
			}else{
				echo 'We have troubles right now, try again later...';
			}
		}else{
			echo 'Error';
		}

		?>
		<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
        <script src="js/script.js"></script>
	</body>
</html>