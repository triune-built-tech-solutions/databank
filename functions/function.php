<?php
error_reporting(1);
require_once("../includes/connections.php");

	function mysql_prep($value) {
		$magic_quote_active = get_magic_quotes_gpc();
		$new_enough_version = function_exists("mysqli_real_escape_string");
		
		if($new_enough_version) {
			if ($magic_quote_active) { $value = stripslashes($value); }
			$value = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $value);
		} else {
			if (!$magic_quote_active) { $value = addslashes($value); }
		}
			return $value;
	}
	
	function encrypt_url($string) {
	  $key = "PSI_979762"; //key to encrypt and decrypts.
	  $result = '';
	  $test = "";
	   for($i=0; $i<strlen($string); $i++) {
		 $char = substr($string, $i, 1);
		 $keychar = substr($key, ($i % strlen($key))-1, 1);
		 $char = chr(ord($char)+ord($keychar));
	
		 $test[$char]= ord($char)+ord($keychar);
		 $result.=$char;
	   }
	
	   return urlencode(base64_encode($result));
	}
	
	function decrypt_url($string) {
		$key = "PSI_979762"; //key to encrypt and decrypts.
		$result = '';
		$string = base64_decode(urldecode($string));
	   for($i=0; $i<strlen($string); $i++) {
		 $char = substr($string, $i, 1);
		 $keychar = substr($key, ($i % strlen($key))-1, 1);
		 $char = chr(ord($char)-ord($keychar));
		 $result.=$char;
	   }
	   return $result;
	}

	// remove all single line comments
	function singleline($minjs, $level = 5, $current = 1, $from = null)
	{
		preg_match_all('/(^((?![a-zA-Z|\\\\|\"|\'|\s])|([\s|\t|\n|\r]))|([\s|;]))+(\/\/)([\s\S]*?\n)/', $minjs, $matches);
		if (count($matches) > 0 && count($matches[0]) > 0)
		{
			$continue = true;
			foreach($matches[0] as $i => $match)
			{
				$begin = $match[0];
				$trim = trim($match);
				$end = substr($trim, -2);
				if ($end != "';")
				{
					$new = preg_replace('/(\/\/)([\s\S]*?\n)/','',$match);
					$new = preg_replace('/(\/\/){1,}/','',$new);
					if (trim($new) == "")
					{
						$minjs = str_replace($match, $new, $minjs);
					}
					
					if (preg_match('/([^;])/', trim($new)))
					{
						if (preg_match('/(\|\|)/', $new) && substr(ltrim($new),0,2) == '||')
						{
							$new = preg_replace('/\s{1,}/'," ",$new);
							$minjs = str_replace($match, $new, $minjs);
						}
					}
					else
					{
						$minjs = str_replace($match, $new, $minjs);
					}
					$continue = true;
				}
				else
				{
					if (preg_match('/(\s{2,}|\n{1,})(\/\/)/',$match))
					{
						$new = preg_replace('/(\/\/)([\s\S]*?\n)/','',$match);
						$new = preg_replace('/(\/\/){1,}/','',$new);

						$minjs = str_replace($match, $new, $minjs);
					}	
				}
			}
			preg_match_all('/(^((?![a-zA-Z|\\\\|\"|\'|\s])|([\s|\t|\n|\r]))|([\s|;]))+(\/\/)([\s\S]*?\n)/', $minjs, $matches);
			
			if (count($matches) > 0 && count($matches[0]) > 0)
			{
				$bf = $minjs;
				if ($current < $level)
				{
					$minjs = singleline($minjs, $level, ($current+1), $from);
					$minjs = is_null($minjs) ? $bf : $minjs;
				}
			}
		}
		return $minjs;
	}
	// remove new line single comment
	function removeNewlineComment($minjs)
	{
		preg_match_all('/([\n|\s|}|{|;|\t|)|,])(\/\/)([^\n]*?)[\\\\][n]/', $minjs, $match);
		if (count($match) > 0 && count($match[0]) > 0)
		{
			foreach($match[0] as $i => $ma)
			{
				$with = $match[1][$i];
				$minjs = str_replace($ma, $with, $minjs);
			}
			$minjs = removeNewlineComment($minjs);
		}
		return $minjs;
	}

?>