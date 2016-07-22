s function cleans Strings.
	By default, returns the string trimmed with htmlspecialchars.
	*/


	define("STR_ALPHA",				1); 	//Only a-zA-Z not even spaces
	define("STR_NUM",				2); 	//Only 0-9 not even spaces
	define("STR_REM_COMMON",		4); 	//Remove common ponctuation   ? ! + - _ = . , : ; @ /
	define("STR_REM_QUOTE",			8);		//Remove quotes ' " ` 
	define("STR_REM_PROG",			16);	//Remove # $ * < > () [] {} % & ^
	define("STR_REM_ALL",			32);	//Remove all , EVEN é à ù..
	define("STR_ENCODE_UTF",		64);	//Be sure that all is utf8-encoded
	define("STR_KEEP_SPACE", 		128);	//Keeps spaces

	function str_clean ($var, $param=0){

		//Let's create the arrays with every ascii code for non alphanumeric chars.
			$reg="";
				$na_common =  array(33, 43, 45, 95, 58, 59, 61, 64, 63, 47, 46);
					$na_quote  =  array(34, 44, 96);
						$na_prog   =  array(35, 36, 37, 38, 40, 41, 42, 60, 62, 91, 92, 93, 94, 123, 124, 125, 126);

							if (!$var){
									echo "Minimum 1 parameter." ;
											exit;
												}
													if (gettype($var) != gettype("a")){
															echo "You must give a String as parameter.";
																	exit;
																		}

																			if ($param==0){
																					return htmlspecialchars(trim($var));
																						}


																							if ($param & STR_ALPHA){
																									$reg .= 'a-zA-Z';
																										}

																											if ($param & STR_NUM){
																													$reg .= '0-9';
																														}

																															if ($param & STR_KEEP_SPACE){
																																	$reg .= '\040';
																																		}

																																			if (strlen($reg)>1){
																																					for ($i=0; $i<strlen($var); $i++){
																																								if (preg_match('#^[' .$reg. ']+$#', $var[$i])==0){
																																												$var[$i] = "";
																																															}
																																																	}
																																																		}

																																																			if ($param & STR_REM_COMMON){
																																																					for ($i=0; $i<count($na_common); $i++){
																																																								str_replace(chr($na_common[$i]), "", $var);
																																																										}
																																																											}


																																																												if ($param & STR_REM_QUOTE){
																																																														for ($i=0; $i<count($na_quote); $i++){
																																																																	str_replace(chr($na_quote[$i]), "", $var);
																																																																			}
																																																																				}


																																																																					if ($param & STR_REM_PROG){
																																																																							for ($i=0; $i<count($na_prog); $i++){
																																																																										str_replace(chr($na_prog[$i]), "", $var);
																																																																												}
																																																																													}


																																																																														if ($param & STR_REM_ALL){
																																																																																for ($i=0; $i<strlen($var); $i++){
																																																																																			if (preg_match('#^[a-zA-Z0-9]+$#', $var[$i])==0){
																																																																																							$var[$i] = "";
																																																																																										}
																																																																																												}
																																																																																													}


																																																																																														if ($param & STR_ENCODE_UTF){
																																																																																																$var = utf8_encode($var);
																																																																																																	}

																																																																																																		return $var;

																																																																																																		}


																																																																																																		$test = "        Hello World      245     ";

																																																																																																		echo str_clean($test);


																																																																																																		?>
