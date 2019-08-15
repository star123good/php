<?php

    if ( ! defined('ABS_PATH')) exit('ABS_PATH is not loaded. Direct access is not allowed.');


	// insert table
	function insert_row($pdo, $table, $keys, $values){
		// where
		//$where2 = "`" . (implode('`= ?, `', $keys)) . "`= ?";

		try{
			// insert
			$where2 = ""; $i=0;
			foreach ($values as $key=>$value) {
				if (isset($keys[$i]))
				{
					$where2 .= " `" . $keys[$i] . "`= '".$value."',";	
				}
				$i++;			
			}
			if ($where2!='') $where2 = substr($where2, 0, -1);

			$sql = "INSERT INTO `".$table."` SET ".$where2;
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			return $pdo->lastInsertId();
		}
		catch(PDOException $e){
			echo "error: insert row";
			var_dump($e);
			return false;
		}

		return true;
	}

	// select order by sentTime
	function select_rows($pdo, $table, $where="1"){
		try{
			// select
			$sql = "SELECT * FROM `".$table."` WHERE ".$where;
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(PDOException $e){
			echo "error: select row";
			var_dump($e);
			return false;
		}
		return true;
	}

	// update table - where key0 = value0
	function update_row($pdo, $table, $keys, $values, $where){
		// where
		// $where2 = "`" . (implode('`= ?, `', $keys)) . "`= ? WHERE `" . $keys[0] . "` = ?";
		
		try{
			// update
			$where2 = ""; $i=0;
			foreach ($values as $key=>$value) {
				if (isset($keys[$i]))
				{
					$where2 .= " `" . $keys[$i] . "`= '".$value."',";	
				}
				$i++;			
			}
			if ($where2!='') $where2 = substr($where2, 0, -1) . " WHERE ".$where;

			$sql = "UPDATE `".$table."` SET ".$where2;
			$stmt = $pdo->prepare($sql);
			// $stmt->execute(array_push($values, $values[0]));
			$stmt->execute();
		}
		catch(PDOException $e){
			echo "error: update row";
			return false;
		}

		return true;
	}

	// delete rows from table
	function delete_rows($pdo, $table, $where){
		try{
			// delete
			$sql = "DELETE FROM `".$table."` WHERE ".$where;
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
		}
		catch(PDOException $e){
			echo "error: delete rows";
			return false;
		}

		return true;
	}

	// redirect url
	function redirect($url){
		echo "<script>window.location='".$url."'</script>";
		exit();
    }
	
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

	// get array default|custom
	function get_customize($custom_array, $default_array=array()){
		$merged = $default_array;

		if(is_array($custom_array)){
			foreach($custom_array as $key => $value){
				if(is_array($value) && isset($merged[$key]) && is_array($merged[$key])){
					$merged[$key] = get_customize($value, $merged[$key]);
				}
				else if($value){
					$merged[$key] = $value;
				}
			}
		}

		return $merged;
	}

	// fetch with cookie array
	// return cookie & body
	function fetch($url, $cookies = null, $returnCookie = false, $postFields = array()) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$postinfo = "";
		foreach($postFields as $param_key => $param_value) 
		{
			$postinfo .= $param_key ."=". $param_value . "&";	
		}
		if(count($postFields) > 0){
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
		}
		if($cookies){
			curl_setopt($ch, CURLOPT_COOKIE, implode(';',$cookies));
		}
		curl_setopt($ch, CURLOPT_HEADER, 1);
		$result = curl_exec($ch);
		list($header, $body) = explode("\r\n\r\n", $result, 2);
		$end = strpos($header, 'Content-Type');
		$start = strpos($header, 'Set-Cookie');
		$parts = explode('Set-Cookie:', substr($header, $start, $end - $start));
		$cookies = array();
		foreach ($parts as $co) {
			$cd = explode(';', $co);
			if (!empty($cd[0]))
				$cookies[] = $cd[0];
		}
		curl_close($ch);
		if ($returnCookie){
			return $cookies;
		}
		return ($body);
	}

	/*
	**
	**		php-curl-bypass-csrf-validation
	**		A simple approach to login to sites that uses csrf token verfication.
	**
	*/
	function curl_bypass_login($url_login, $url_next, $default_params=array()){
		// start
		$params = $default_params;
		$token_cookie = realpath(COOKIE_PATH);

		$ch = curl_init();

		// if($t) {
			// $csrf_token = file_get_contents(realpath("another-cookie.txt"));
			$postinfo = "";
			foreach($params as $param_key => $param_value) 
			{
				$postinfo .= $param_key ."=". $param_value . "&";	
			}
			// $postinfo .= $csrf_token_field_name ."=". $t;
			// var_dump($postinfo);
			
			$headers = array();

			$url = $url_login;
			
			$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
			$header[] = "Cache-Control: max-age=0";
			$header[] = "Connection: keep-alive";
			$header[] = "Keep-Alive: 300";
			$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
			$header[] = "Accept-Language: en-us,en;q=0.5";
			$header[] = "Pragma: ";
			$header[] = "Access-Control-Allow-Origin: *";
			$header[] = "Access-Control-Allow-Credentials : true";
			$header[] = "Access-Control-Allow-Methods : GET, POST, OPTIONS";
			$header[] = "Access-Control-Allow-Headers : Origin, Content-Type, Accept";
			// $headers[] = "X-CSRF-Token: $t";
			$headers[] = "Cookie: $token_cookie";
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
			curl_setopt($ch, CURLOPT_COOKIEJAR, $token_cookie);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $token_cookie);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_REFERER, $url);
			curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 260);
			if(!$url_next) curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			else curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_VERBOSE, true);
			
			
			ob_start();
			$html = curl_exec($ch);
			$result = curl_getinfo($ch);
			ob_get_clean();
			
			// echo "<pre>";
			// print_r($result);
			// echo "</pre>";
			// print($html);

			// if((!$url_next || $url_next == "") && $result['http_code'] == 500) { $url_next = $url_first; }

			if($url_next && $url_next != ""){
				$url = $url_next;

				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_COOKIEJAR, $token_cookie);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $token_cookie);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	
				ob_start();
				$html = curl_exec($ch);
				$result = curl_getinfo($ch);
				ob_get_clean();

				// echo "<pre>";
				// print_r($result);
				// echo "</pre>";
				// print($html);
			} 
			
			
			if (curl_errno($ch)) print curl_error($ch);
			curl_close($ch); 
		// }

		// preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $html, $matches);
		// $cookies = array();
		// foreach($matches[1] as $item) {
		// 	parse_str($item, $cookie);
		// 	$cookies = array_merge($cookies, $cookie);
		// }
		// var_dump($cookies);
		libxml_use_internal_errors(true);
		$dom = new DomDocument();
		$dom->loadHTML($html);
		libxml_use_internal_errors(false);

		return $dom;
		// end 
	}

	// get selected tags contents from curl response
	function getTagsData($url){
		$response = url_get_contents($url);
		$datas = array();
		$special_class_name = "yazi";

		if(isset($response['info']['http_code']) && $response['info']['http_code'] == 200){
			// response status ok
			libxml_use_internal_errors(true);
			$dom = new DomDocument();
			$dom->loadHTML($response['contents']);
			libxml_use_internal_errors(false);

			$divs = $dom->getElementsByTagName("div");
			for($i = 0; $i < $divs->length; $i++){
				$div_tag = $divs->item($i);
				$div_class = $div_tag->getAttribute('class');
				if($div_class == $special_class_name){
					if($div_tag->getElementsByTagName("a")->length > 0){
						$a_tag = $div_tag->getElementsByTagName("a")->item(0);
						$title = $a_tag->textContent;
						$href = $a_tag->getAttribute('href');
					}
					else{
						$title = "";
						$href = "";
					}

					if($div_tag->getElementsByTagName("img")->length > 0){
						$img_tag = $div_tag->getElementsByTagName("img")->item(0);
						$image = $img_tag->getAttribute('src');
					}
					else{
						$image = "";
					}

					// download target url
					$target_dom = curl_bypass_login(SERVICE_URL_LOG_IN, $href, array('log' => LOG_IN_USERNAME, 'pwd' => LOG_IN_PASSWORD));
					$a_tags = $target_dom->getElementsByTagName("a");
					$download_url = '';
					if($a_tags->length > 0){
						foreach($target_dom->getElementsByTagName('a') as $temp_a_tag ){
							if(stripos($temp_a_tag->textContent, 'ftp:') !== false){
								$download_url = $temp_a_tag->textContent;
								break;
							}
						}
					}

					$datas[] = array(
						'title' => $title,
						'href' => $href,
						'download' => $download_url,
						'image' => $image
					);
				}
			}
		}
		else{
			// response status bad
		}

		return $datas;
	}
	
	// get selected tags contents from curl response
	// using cookie variable
	function getTagsDataWithCookie($url){
		$response = url_get_contents($url);
		$datas = array();
		$special_class_name = "yazi";

		if(isset($response['info']['http_code']) && $response['info']['http_code'] == 200){
			// get cookie variable
			$cookies = fetch(SERVICE_URL_LOG_IN, null, true, array('log' => LOG_IN_USERNAME, 'pwd' => LOG_IN_PASSWORD));
					
			// response status ok
			libxml_use_internal_errors(true);
			$dom = new DomDocument();
			$dom->loadHTML($response['contents']);
			libxml_use_internal_errors(false);

			$divs = $dom->getElementsByTagName("div");
			for($i = 0; $i < $divs->length; $i++){
				$div_tag = $divs->item($i);
				$div_class = $div_tag->getAttribute('class');
				if($div_class == $special_class_name){
					if($div_tag->getElementsByTagName("a")->length > 0){
						$a_tag = $div_tag->getElementsByTagName("a")->item(0);
						$title = $a_tag->textContent;
						$href = $a_tag->getAttribute('href');
					}
					else{
						$title = "";
						$href = "";
					}

					if($div_tag->getElementsByTagName("img")->length > 0){
						$img_tag = $div_tag->getElementsByTagName("img")->item(0);
						$image = $img_tag->getAttribute('src');
					}
					else{
						$image = "";
					}
					
					// download target url
					$contents = fetch($href, $cookies);
					libxml_use_internal_errors(true);
					$target_dom = new DomDocument();
					$target_dom->loadHTML($contents);
					libxml_use_internal_errors(false);
					$a_tags = $target_dom->getElementsByTagName("a");
					
					$download_url = '';
					$download_url_mkv = '';
					$download_url_avi = '';
					$download_url_mp4 = '';
					if($a_tags->length > 0){
						foreach($target_dom->getElementsByTagName('a') as $temp_a_tag ){
							if(stripos(strtolower($temp_a_tag->textContent), 'ftp:') !== false){
								$download_url = strtolower($temp_a_tag->textContent);
								if(substr($download_url, -4) == '.mkv' && $download_url_mkv == '') $download_url_mkv = $download_url;
								else if(substr($download_url, -4) == '.avi' && $download_url_avi == '') $download_url_avi = $download_url;
								else if(substr($download_url, -4) == '.mp4' && $download_url_mp4 == '') $download_url_mp4 = $download_url;
							}
						}
					}
					if($download_url_mkv != '') $download_url = $download_url_mkv;
					else if($download_url_avi != '') $download_url = $download_url_avi;
					else if($download_url_mp4 != '') $download_url = $download_url_mp4;

					$datas[] = array(
						'title' => $title,
						'href' => $href,
						'download' => $download_url,
						'image' => $image
					);
				}
			}
		}
		else{
			// response status bad
		}

		return $datas;
	}
	
	// insert streams and streams_options tables
	function insert_streams($pdo1, $table_stream, $table_stream_option, $values){
		$re = '/[^\/]+/m';
		preg_match_all($re, $values['url'], $matches, PREG_SET_ORDER, 0);
		if(count($matches) > 0){
			$filename = $matches[count($matches)-1][0];
			$stream_type = 2;
			$stream_category_id = 122;
			$stream_source = '["http:\\\/\\\/'.$filename.'"]';
			$stream_display_name = trim(str_replace("", "", $values['title']));
			$stream_notes = "";
			$stream_transcode_attributes = "[]";
			$stream_movie_properties = '{"":""}';
			$stream_movie_subtitles = "[]";
			$stream_read_native = 0;
			$stream_target_container = '[""]';
			$stream_custom_sid = "";
			$stream_added = strtotime(date("Y-m-d H:i:s"));
			$stream_direct_source = 1;
			$stream_redirect_stream = 1;
			
			$stream_id = insert_row($pdo1, $table_stream, 
				array(
					'type',
					'category_id',
					'stream_source',
					'stream_display_name',
					'notes',
					'transcode_attributes',
					'movie_propeties',
					'movie_subtitles',
					'read_native',
					'target_container',
					'custom_sid',
					'added',
					'direct_source',
					'redirect_stream'
				), 
				array(
					$stream_type,
					$stream_category_id,
					$stream_source,
					$stream_display_name,
					$stream_notes,
					$stream_transcode_attributes,
					$stream_movie_properties,
					$stream_movie_subtitles,
					$stream_read_native,
					$stream_target_container,
					$stream_custom_sid,
					$stream_added,
					$stream_direct_source,
					$stream_redirect_stream
				)
			);
			
			$argument_id = 1;
			$stream_options_value = "";
			
			insert_row($pdo1, $table_stream_option, 
				array('stream_id', 'argument_id', 'value'), 
				array($stream_id, $argument_id, $stream_options_value)
			);
		}
	}

	// database connect
	$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".CHARSET;
	$options = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];
	try{
		$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
	}
	catch(PDOException $e){
		die('database connect error.');
	}
	
	// set timezone AU
	date_default_timezone_set("");


?>