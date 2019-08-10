<?php

/*
**		Campaign Profile
**		
**		Ad Submission Software PHP Mysql
**		Submits Ads to Bestplumberfortlauderdale.com
*/
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
					$where2 .= " `" . $keys[$i] . "`= '".addslashes($value)."',";	
				}
				$i++;			
			}
			if ($where2!='') $where2 = substr($where2, 0, -1);

			$sql = "INSERT INTO ".$table." SET ".$where2;
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
			$sql = "SELECT * FROM ".$table." WHERE ".$where;
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
					$where2 .= " `" . $keys[$i] . "`= '".addslashes($value)."',";	
				}
				$i++;			
			}
			if ($where2!='') $where2 = substr($where2, 0, -1) . " WHERE ".$where;

			$sql = "UPDATE ".$table." SET ".$where2;
			$stmt = $pdo->prepare($sql);
			// $stmt->execute(array_push($values, $values[0]));
			$stmt->execute();
		}
		catch(PDOException $e){
			echo "error: update row";
			// var_dump($e);
			return false;
		}

		return true;
	}

	// delete rows from table
	function delete_rows($pdo, $table, $where){
		try{
			// delete
			$sql = "DELETE FROM ".$table." WHERE ".$where;
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
		}
		catch(PDOException $e){
			echo "error: delete rows";
			return false;
		}

		return true;
	}

	// get pagination from table
	function get_pagination($pdo, $table, $current_page, $url, $where="1"){
		$rows = select_rows($pdo, $table, $where);
		$total_pages = (int)((count($rows) - 1) / PAGE_NUMBER) + 1;
		if($current_page < 1) $current_page = 1;
		else if($current_page > $total_pages) $current_page = $total_pages;
		$paginations = "<ul>";
		for($i = 1; $i <= $total_pages; $i++){
			$paginations .= "<li><a class='" . (($i == $current_page) ? "searchPaginationSelected" : "" ) . "' href='" . $url . "&page=" . $i . "'>".$i."</a></li>";
		}
		$paginations .= "</ul>";
		return $paginations;
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

	// multidimensional array to one dimensional array
	function array_flatten($array, $preffix_key="") { 
		if (!is_array($array)) { 
		  return FALSE; 
		} 
		$result = array(); 
		foreach ($array as $key => $value) { 
		  if (is_array($value)) { 
			$result = array_merge($result, array_flatten($value, $key)); 
		  } 
		  else { 
			if($preffix_key == "") $result[$key] = $value; 
			else  $result[$preffix_key."[".$key."]"] = $value; 
		  } 
		} 
		return $result; 
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
	

	/*
	##############################################################################################
	############### useful PHP cURL function for your library (TT's version) #####################
	##############################################################################################
	### echo get_remote_data("http://example.com/");                                   //GET request
	### echo get_remote_data("http://example.com/", "var2=something&var3=blabla" );    //POST request 	
	### 
	###    * Automatically handles FOLLOWLOCATION problem;
	###    * Using 'replace_src'=>true, it fixes domain-relative urls  (i.e.:   src="./file.jpg"  ----->  src="http://example.com/file.jpg" )
	###    * Using 'schemeless'=>true, it converts urls in schemeless  (i.e.:   src="http://exampl..  ----->  src="//exampl... )\
	###### // source: https://github.com/tazotodua/useful-php-scripts                ##########
	###### // Get minified code from: http://protectpages.com/tools/php-minify.php   ##########
	###########################################################################################
	*/ 

	function get_remote_data($url, $post_paramtrs=false, $extra=array('schemeless'=>true, 'replace_src'=>true, 'return_array'=>false, "curl_opts"=>[]))	
	{ 
		$c = curl_init(); 
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		//if parameters were passed to this function, then transform into POST method.. (if you need GET request, then simply change the passed URL)
		if($post_paramtrs){ curl_setopt($c, CURLOPT_POST,TRUE);  curl_setopt($c, CURLOPT_POSTFIELDS, (is_array($post_paramtrs)? http_build_query($post_paramtrs) : $post_paramtrs) ); }
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false); 
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;'); 
			$headers[]= "User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:76.0) Gecko/20100101 Firefox/76.0";	 $headers[]= "Pragma: ";  $headers[]= "Cache-Control: max-age=0";
			if (!empty($post_paramtrs) && !is_array($post_paramtrs) && is_object(json_decode($post_paramtrs))){ $headers[]= 'Content-Type: application/json'; $headers[]= 'Content-Length: '.strlen($post_paramtrs); }
		curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($c, CURLOPT_MAXREDIRS, 10); 
		//if SAFE_MODE or OPEN_BASEDIR is set,then FollowLocation cant be used.. so...
		$follow_allowed= ( ini_get('open_basedir') || ini_get('safe_mode')) ? false:true;  if ($follow_allowed){curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);}
		curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
		curl_setopt($c, CURLOPT_REFERER, $url);    
		curl_setopt($c, CURLOPT_TIMEOUT, 60);
		curl_setopt($c, CURLOPT_AUTOREFERER, true);
		curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($c, CURLOPT_HEADER, !empty($extra['return_array']));
		//set extra options if passed
		if(!empty($extra['curl_opts'])) foreach($extra['curl_opts'] as $key=>$value) curl_setopt($c, constant($key), $value);
		$data = curl_exec($c);
		if(!empty($extra['return_array'])) { 
			 preg_match("/(.*?)\r\n\r\n((?!HTTP\/\d\.\d).*)/si",$data, $x); preg_match_all('/(.*?): (.*?)\r\n/i', trim('head_line: '.$x[1]), $headers_, PREG_SET_ORDER); foreach($headers_ as $each){ $header[$each[1]] = $each[2]; }   $data=trim($x[2]); 
		}
		$status=curl_getinfo($c); curl_close($c);
		// if redirected, then get that redirected page
		if($status['http_code']==301 || $status['http_code']==302) { 
			//if we FOLLOWLOCATION was not allowed, then re-get REDIRECTED URL
			//p.s. WE dont need "else", because if FOLLOWLOCATION was allowed, then we wouldnt have come to this place, because 301 could already auto-followed by curl  :)
			if (!$follow_allowed){
				//if REDIRECT URL is found in HEADER
				if(empty($redirURL)){if(!empty($status['redirect_url'])){$redirURL=$status['redirect_url'];}}
				//if REDIRECT URL is found in RESPONSE
				if(empty($redirURL)){preg_match('/(Location:|URI:)(.*?)(\r|\n)/si', $data, $m);	                if (!empty($m[2])){ $redirURL=$m[2]; } }
				//if REDIRECT URL is found in OUTPUT
				if(empty($redirURL)){preg_match('/moved\s\<a(.*?)href\=\"(.*?)\"(.*?)here\<\/a\>/si',$data,$m); if (!empty($m[1])){ $redirURL=$m[1]; } }
				//if URL found, then re-use this function again, for the found url
				if(!empty($redirURL)){$t=debug_backtrace(); return call_user_func( $t[0]["function"], trim($redirURL), $post_paramtrs);}
			}
		}
		// if not redirected,and nor "status 200" page, then error..
		elseif ( $status['http_code'] != 200 ) { $data =  "ERRORCODE22 with $url<br/><br/>Last status codes:".json_encode($status)."<br/><br/>Last data got:$data";}
		//URLS correction
		if(function_exists('url_corrections_for_content_HELPER')){	    $data= url_corrections_for_content_HELPER($data, $status['url'],   array('schemeless'=>!empty($extra['schemeless']), 'replace_src'=>!empty($extra['replace_src']), 'rawgit_replace'=>!empty($extra['rawgit_replace']) )  );    	}
		$answer = ( !empty($extra['return_array']) ? array('data'=>$data, 'header'=>$header, 'info'=>$status) : $data);
		return $answer;      }     function url_corrections_for_content_HELPER( $content=false, $url=false, 	$extra_opts=array('schemeless'=>false, 'replace_src'=>false, 'rawgit_replace'=>false) ) { 
		$GLOBALS['rdgr']['schemeless'] =$extra_opts['schemeless'];
		$GLOBALS['rdgr']['replace_src']=$extra_opts['replace_src'];
		$GLOBALS['rdgr']['rawgit_replace']=$extra_opts['rawgit_replace'];
		if($GLOBALS['rdgr']['schemeless'] || $GLOBALS['rdgr']['replace_src'] ) {
			if($url) {
				$GLOBALS['rdgr']['parsed_url']			= parse_url($url);
				$GLOBALS['rdgr']['urlparts']['domain_X']= $GLOBALS['rdgr']['parsed_url']['scheme'].'://'.$GLOBALS['rdgr']['parsed_url']['host'];
				$GLOBALS['rdgr']['urlparts']['path_X']	= stripslashes(dirname($GLOBALS['rdgr']['parsed_url']['path']).'/'); 
				$GLOBALS['rdgr']['all_protocols']= array('adc','afp','amqp','bacnet','bittorrent','bootp','camel','dict','dns','dsnp','dhcp','ed2k','empp','finger','ftp','gnutella','gopher','http','https','imap','irc','isup','javascript','ldap','mime','msnp','map','modbus','mosh','mqtt','nntp','ntp','ntcip','openadr','pop3','radius','rdp','rlogin','rsync','rtp','rtsp','ssh','sisnapi','sip','smtp','snmp','soap','smb','ssdp','stun','tup','telnet','tcap','tftp','upnp','webdav','xmpp');
			}
			$GLOBALS['rdgr']['ext_array'] 	= array(
				'src'	=> array('audio','embed','iframe','img','input','script','source','track','video'),
				'srcset'=> array('source'),
				'data'	=> array('object'),
				'href'	=> array('link','area','a'), 
				'action'=> array('form')
				//'param', 'applet' and 'base' tags are exclusion, because of a bit complex structure 
			);
			$content= preg_replace_callback( 
				'/<(((?!<).)*?)>/si', 	//avoids unclosed & closing tags
				function($matches_A){
					$content_A = $matches_A[0];
					$tagname = preg_match('/((.*?)(\s|$))/si', $matches_A[1], $n) ? $n[2] : "";
					foreach($GLOBALS['rdgr']['ext_array'] as $key=>$value){
						if(in_array($tagname,$value)){
							preg_match('/ '.$key.'=(\'|\")/i', $content_A, $n);
							if(!empty($n[1])){
								$GLOBALS['rdgr']['aphostrope_type']= $n[1];
								$content_A = preg_replace_callback( 
									'/( '.$key.'='.$GLOBALS['rdgr']['aphostrope_type'].')(.*?)('.$GLOBALS['rdgr']['aphostrope_type'].')/i',
									function($matches_B){
										$full_link = $matches_B[2];
										//correction to files/urls
										if(!empty($GLOBALS['rdgr']['replace_src'])	){
											//if not schemeless url
											if(substr($full_link, 0,2) != '//'){
												$replace_src_allow=true;
												//check if the link is a type of any special protocol
												foreach($GLOBALS['rdgr']['all_protocols'] as $each_protocol){
													//if protocol found - dont continue
													if(substr($full_link, 0, strlen($each_protocol)+1) == $each_protocol.':'){
														$replace_src_allow=false; break;
													}
												}
												if($replace_src_allow){
													$full_link = $GLOBALS['rdgr']['urlparts']['domain_X']. (str_replace('//','/',  $GLOBALS['rdgr']['urlparts']['path_X'].$full_link) );
												}
											}
										}
										//replace http(s) with sheme-less urls
										if(!empty($GLOBALS['rdgr']['schemeless'])){
											$full_link=str_replace(  array('https://','http://'), '//', $full_link);
										}
										//replace github mime
										if(!empty($GLOBALS['rdgr']['rawgit_replace'])){
											$full_link= str_replace('//raw.github'.'usercontent.com/','//rawgit.com/', $full_link);
										}
										$matches_B[2]=$full_link;
										unset($matches_B[0]);
										$content_B=''; foreach ($matches_B as $each){$content_B .= $each; }
										return $content_B;
									},
									$content_A
								);
							}
						}
					}
					return $content_A;
				},
				$content
			); 
			$content= preg_replace_callback( 
				'/style="(.*?)background(\-image|)(.*?|)\:(.*?|)url\((\'|\"|)(.*?)(\'|\"|)\)/i',
				function($matches_A){
					$url = $matches_A[7];
					$url = (substr($url,0,2)=='//' || substr($url,0,7)=='http://' || substr($url,0,8)=='https://' ? $url : '#');
					return 'style="'.$matches_A[1].'background'.$matches_A[2].$matches_A[3].':'.$matches_A[4].'url('.$url.')'; //$matches_A[5] is url taged ,7 is url
				},
				$content
			);
		}
		return $content;
	}

	/*
	**
	**		php-curl-bypass-csrf-validation
	**		A simple approach to login to sites that uses csrf token verfication.
	**
	*/
	function curl_bypass_csrf_validation($url_first, $url_login, $url_next, $token_field_name, $default_params=array()){
		// start
		$url = $url_first;
            
		$csrf_token_field_name = $token_field_name;
		$params = array();
						
		$token_cookie = realpath(COOKIE_PATH);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $token_cookie);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $token_cookie);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);

		/* print_r($response); */
		
		// if (curl_errno($ch)) die(curl_error($ch));
		if (curl_errno($ch)) return "";
		libxml_use_internal_errors(true);
		$dom = new DomDocument();
		$dom->loadHTML($response);
		libxml_use_internal_errors(false);
		$tokens = $dom->getElementsByTagName("input");
		for ($i = 0; $i < $tokens->length; $i++) 
		{
			$meta = $tokens->item($i);
			$key = $meta->getAttribute('name');
			$val = $meta->getAttribute('value');
			if($key == $csrf_token_field_name)
				$t = $val;
			else 
				$params[$key] = $val;
		}
		$params = get_customize($default_params, $params);

		if($t) {
			// $csrf_token = file_get_contents(realpath("another-cookie.txt"));
			$postinfo = "";
			foreach($params as $param_key => $param_value) 
			{
				$postinfo .= $param_key ."=". $param_value . "&";	
			}
			$postinfo .= $csrf_token_field_name ."=". $t;
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
			$headers[] = "X-CSRF-Token: $t";
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
			
			
			// if (curl_errno($ch)) print curl_error($ch);
			if (curl_errno($ch)) return "";
			curl_close($ch); 
		}

		// preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $html, $matches);
		// $cookies = array();
		// foreach($matches[1] as $item) {
		// 	parse_str($item, $cookie);
		// 	$cookies = array_merge($cookies, $cookie);
		// }
		// var_dump($cookies);

		return $html;
		// end 
	}

	/*
	**
	**		php-curl-bypass-csrf-validation
	**		A simple approach to login to sites that uses csrf token verfication.
	**
	*/
	function curl_bypass_csrf_validation_submit($url_first, $url_login, $url_next, $url_submit, $token_field_name, $default_params=array(), $default_submit=array()){
		// start
		$url = $url_first;
            
		$csrf_token_field_name = $token_field_name;
		$params = array();
						
		$token_cookie = realpath(COOKIE_PATH);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $token_cookie);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $token_cookie);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);

		// print_r($response);
		
		// if (curl_errno($ch)) die(curl_error($ch));
		if (curl_errno($ch)) return "";
		libxml_use_internal_errors(true);
		$dom = new DomDocument();
		$dom->loadHTML($response);
		libxml_use_internal_errors(false);
		$tokens = $dom->getElementsByTagName("input");
		for ($i = 0; $i < $tokens->length; $i++) 
		{
			$meta = $tokens->item($i);
			$key = $meta->getAttribute('name');
			$val = $meta->getAttribute('value');
			if($key == $csrf_token_field_name)
				$t = $val;
			else 
				$params[$key] = $val;
		}
		$params = get_customize($default_params, $params);

		if($t) {
			// $csrf_token = file_get_contents(realpath("another-cookie.txt"));
			$postinfo = "";
			foreach($params as $param_key => $param_value) 
			{
				$postinfo .= $param_key ."=". $param_value . "&";	
			}
			$postinfo .= $csrf_token_field_name ."=". $t;
			
			$headers = array();

			$url = $url_login;
			
			$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
			$header[] = "Cache-Control: max-age=0";
			$header[] = "Connection: keep-alive";
			$header[] = "Keep-Alive: 300";
			$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
			$header[] = "Accept-Language: en-us,en;q=0.5";
			$header[] = "Pragma: ";
			$headers[] = "X-CSRF-Token: $t";
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
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
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

			$url = $url_next;

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $token_cookie);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $token_cookie);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			ob_start();
			$response = curl_exec($ch);
			ob_get_clean();
			
			// if (curl_errno($ch)) die(curl_error($ch));
			if (curl_errno($ch)) return "";
			libxml_use_internal_errors(true);
			$dom = new DomDocument();
			$dom->loadHTML($response);
			libxml_use_internal_errors(false);
			$tokens = $dom->getElementsByTagName("input");
			for ($i = 0; $i < $tokens->length; $i++) 
			{
				$meta = $tokens->item($i);
				$key = $meta->getAttribute('name');
				$val = $meta->getAttribute('value');
				if($key == $csrf_token_field_name)
					$t = $val;
				else 
					$params[$key] = $val;
			}
			// $params = get_customize($default_submit, $params);
			
			if($t) {
				// $csrf_token = file_get_contents(realpath("another-cookie.txt"));
				$postinfo = "";
				foreach($params as $param_key => $param_value) 
				{
					$postinfo .= $param_key ."=". $param_value . "&";	
				}
				foreach($default_submit as $param_key => $param_value) 
				{
					if($param_key == $csrf_token_field_name || $param_key == "CSRFName" || $param_key == "url_link") continue;
					$postinfo .= $param_key ."=". $param_value . "&";	
				}
				$postinfo .= $csrf_token_field_name ."=". $t;
				
				$headers = array();
	
				$url = $url_submit;
				
				$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
				$header[] = "Cache-Control: max-age=0";
				$header[] = "Connection: keep-alive";
				$header[] = "Keep-Alive: 300";
				$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
				$header[] = "Accept-Language: en-us,en;q=0.5";
				$header[] = "Pragma: ";
				$headers[] = "X-CSRF-Token: $t";
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
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_VERBOSE, true);
				
				ob_start();
				$html = curl_exec($ch);
				$result = curl_getinfo($ch);
				// var_dump($result);
				ob_get_clean();

				// echo "<pre>";
				// print_r($result);
				// echo "</pre>";
				// print($html);

				// if (curl_errno($ch)) print curl_error($ch);
				if (curl_errno($ch)) return "";
				curl_close($ch); 
			}

			
		}


		return $html;
		// end 
	}

	// curl get array
	function get_url($url,$post,$refer) {
		$ssl = substr(strtolower($url),0,8)=='https://' ? true : false;
		$cookie = realpath(COOKIE_PATH);
		$header[0] = "text/xml,application/xml,application/xhtml+xml,";
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Keep-Alive: 300";
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$header[] = "Accept-Language: en-us,en;q=0.5";
		$header[] = "Pragma: ";
		$agent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36";
		$refer = !empty($refer) ? $refer : "http://www.google.com/";

		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_USERAGENT, $agent);
		if( !empty($post) ) {
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
		}
		if( $ssl ) {
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		}
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_REFERER, $refer);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT,60);
	
		$html = curl_exec($curl);
		$info = curl_getinfo($curl);
		$error = '';
		if( $html === false ) {
			$error = 'Curl error: ' . curl_error($curl);
		}               
		curl_close($curl);
		$arr = array();
		$arr['html'] = $html;
		$arr['info'] = $info;
		$arr['error'] = $error;
		return $arr;    
	
	}   

	// file open and read and print
	function get_file_contents($file_name){
		if(file_exists($file_name)){
			$file_handle = fopen($file_name, "r");
			return fread($file_handle, sizeof($file_name));
		}
		return "There is no file" . $file_name;
	}

	// redirect url
	function redirect($url){
		echo "<script>window.location='".$url."'</script>";
		exit();
	}

	// get random value from array
	function get_random_value($data_array, $select_key, $avoid_array=array()){
		$temp_array = array();
		$count = 0;
		foreach($data_array as $key => $val){
			if(!in_array($val[$select_key], $avoid_array)){
				$temp_array[] = $val;
				$count ++;
			}
		}
		if($count > 0) return $temp_array[mt_rand(0, $count-1)];
		else return null;
	}

	// get verify code
	// make a random value by several methods.
	function get_verify_code($type="", $length=32){
		if($length > 32) $length = 32;
		switch($type){
			case "pseudo":
				return substr(bin2hex(openssl_random_pseudo_bytes($length/2+1)), 0, $length);
			case "rand":
			default:
				return substr(md5(mt_rand()), 0, $length);
		}
	}

	// {||} pattern string
	// get random pattern
	function get_pattern_strings($str){
		$search = array();
		$replace = array();
		$total_pattern = '/{[^}]+}/m';
		preg_match_all($total_pattern, $str, $matches, PREG_SET_ORDER, 0);
		if(count($matches) > 0){
			foreach($matches as $match){
				$search[] = $match[0];
				$sub_str = substr($match[0], 1, strlen($match[0])-2);
				$sub_pattern = '/[^|]+/m';
				preg_match_all($sub_pattern, $sub_str, $datas, PREG_SET_ORDER, 0);
				if(count($datas) > 0){
					$random_index = rand(0, count($datas) - 1);
					$replace[] = $datas[$random_index][0];
				}
				else{
					$replace[] = $sub_str;
				}
			}
		}
		return str_replace($search, $replace, $str);
	}


	// database connect
	$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".CHARSET;
	$dsn1 = "mysql:host=".DB_HOST.";dbname=".DB_NAME1.";charset=".CHARSET;
	$options = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];
	try{
		$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
		$pdo1 = new PDO($dsn1, DB_USER, DB_PASSWORD, $options);
	}
	catch(PDOException $e){
		die('database connect error.');
	}


	// mail server setting
	// ini_set("SMTP", "localhost");
	// ini_set("smtp_port", 25);
	// ini_set("sendmail_from", WEB_HOST);

?>