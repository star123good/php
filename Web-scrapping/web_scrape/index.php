<?php


	// function getting url contents using curl
	function url_get_contents($url, $useragent='cURL', $headers=false, $follow_redirects=true, $debug=true) {

		// initialise the CURL library
		$ch = curl_init();

		// specify the URL to be retrieved
		curl_setopt($ch, CURLOPT_URL,$url);

		// we want to get the contents of the URL and store it in a variable
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

		// specify the useragent: this is a required courtesy to site owners
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent);

		// ignore SSL errors
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// return headers as requested
		if ($headers==true){
			curl_setopt($ch, CURLOPT_HEADER,1);
		}

		// only return headers
		if ($headers=='headers only') {
			curl_setopt($ch, CURLOPT_NOBODY ,1);
		}

		// follow redirects - note this is disabled by default in most PHP installs from 4.4.4 up
		if ($follow_redirects==true) {
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		}

		// if debugging, return an array with CURL's debug info and the URL contents
		if ($debug==true) {
			$result['contents']=curl_exec($ch);
			$result['info']=curl_getinfo($ch);
		}

		// otherwise just return the contents as a variable
		else $result=curl_exec($ch);

		// free resources
		curl_close($ch);

		// send back the data
		return $result;
	}

	
	// write the file
	function write_csv_file($filename, $data, $type='wb',  $delimiter = ',', $enclosure = '"'){
		try{
			$fp = fopen($filename, $type);
			foreach ($data as $fields) {
				fputcsv($fp, $fields,  $delimiter, $enclosure);
			}
			fclose($fp);
		}
		catch(Exception $e){
			return false;
		}
		return true;
	}
	
	
	if(isset($_GET['type']) && $_GET['type'] = "getData"){
		$filename = "result.csv";

		$start = 0;
		$size = 5178;
		$url = "https://www.edgeprop.my/jwdsonic/api/v1/agent/search?&start=".$start."&size=".$size;
		$contents = url_get_contents($url);
	
		$result = array();

		if(isset($contents['contents'])){
			$data = (array)json_decode($contents['contents']);
			if(isset($data['agents'])){
				$result[] = array("agent name", "agency name", "ren number", "phone number", "is pro?", "profile", "joined info", "total listing");
				foreach($data['agents'] as $row){
					$agent = (array)$row;
					$agent_names = (isset($agent['bizname_t']))?$agent['bizname_t']:'';
					$agency_names = $agent['agency_t'];
					$ren_numbers = $agent['agent_id_s'];
					$phone_numbers = $agent['contact_s'];
					$pros = ($agent['score'] >= 1000000);
					$profiles = (isset($agent['agent_desc_t']))?$agent['agent_desc_t']:'';
					echo $joined_infos = (isset($agent['created_i']))?date('Y-m-d', $agent['created_i']):'';
					$total_listings = $agent['activelistings_i'];
					$result[] = array($agent_names, $agency_names, $ren_numbers, $phone_numbers, $pros, $profiles, $joined_infos, $total_listings);
				}
			}
		}
	
		if(write_csv_file($filename, $result)) echo json_encode(array('status' => 'OK'));
		else echo json_encode(array('status' => 'fail'));
		die();
	}
?>

<html>
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Scrape using Ajax</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="container">
			<div class="row mt-5">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h3 class="mt-3 mb-4 header-title text-info">
								Scrapping...
								<div class="btn-group ml-auto float-right" role="group">
									<button type="button" class="btn btn-primary btn-round mr-2" id="btn-start"><i class=""></i> Start</button>
									<button type="button" class="btn btn-info btn-round mr-5" id="btn-reset"><i class=""></i> Reset</button>
								</div>
							</h3>
							<div class="progress">
								<div class="progress-bar" id="progress-bar-show" role="progressbar" style="" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="js/jquery-3.4.1.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<script>
			function ajaxSend(url, callback){
				$.ajax({
					url: url,
					type: 'GET',
					async: true,
					success: function(result){
						// console.log("ajax result:", result);
						if(callback) callback(result);
					}
				});
			}

			function setProgressBar($progressBar, value){
				$progressBar.attr("style", "width: "+value+"%;");
				$progressBar.attr("aria-valuenow", value);
				$progressBar.html(value+"%");
			}

			function getAllDataFromAPI(){
				ajaxSend(defaultUrl, function(result){
					console.log(result);
				});
			}

			
			var maxTime = 150;
			var progressValue;
			var defaultUrl = '?type=getData';

			$(document).ready(function(){

				$(document).on('click', "#btn-start", function(){
					var t = maxTime;
					setProgressBar($("#progress-bar-show"), 0);
					$("#btn-start").attr("disabled", "disabled");
					var x = setInterval(function() { 
						var p = Math.floor((maxTime - t) / maxTime * 100);
						setProgressBar($("#progress-bar-show"), p);
						if (t < 0) { 
							clearInterval(x); 
						} 
						t--;
					}, 100);

					getAllDataFromAPI();
				});
				
				$(document).on('click', "#btn-reset", function(){
					setProgressBar($("#progress-bar-show"), 0);
					$("#btn-start").removeAttr("disabled");
				});
			});
		</script>
	</body>
</html>