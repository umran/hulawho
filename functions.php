<?php

function gameday($current){
	if ($current<(1402621200-18000)){
		$gameday = 1;
	}
	elseif ((1402621200-18000)<$current && $current<(1402714800-18000)){
		$gameday = 2;
	}
	elseif ((1402714800-18000)<$current && $current<(1402812000-18000)){
		$gameday = 3;
	}
	elseif ((1402812000-18000)<$current && $current<(1402887600-18000)){
		$gameday = 4;
	}
	elseif ((1402887600-18000)<$current && $current<(1402974000-18000)){
		$gameday = 5;
	}
	elseif ((1402974000-18000)<$current && $current<(1403060400-18000)){
		$gameday = 6;
	}
	elseif ((1403060400-18000)<$current && $current<(1403146800-18000)){
		$gameday = 7;
	}
	elseif ((1403146800-18000)<$current && $current<(1403233200-18000)){
		$gameday = 8;
	}
	elseif ((1403233200-18000)<$current && $current<(1403319600-18000)){
		$gameday = 9;
	}
	elseif ((1403319600-18000)<$current && $current<(1403406000-18000)){
		$gameday = 10;
	}
	elseif ((1403406000-18000)<$current && $current<(1403492400-18000)){
		$gameday = 11;
	}
	elseif ((1403492400-18000)<$current && $current<(1403571600-18000)){
		$gameday = 12;
	}
	elseif ((1403571600-18000)<$current && $current<(1403658000-18000)){
		$gameday = 13;
	}
	elseif ((1403658000-18000)<$current && $current<(1403744400-18000)){
		$gameday = 14;
	}
	elseif ((1403744400-18000)<$current && $current<(1403830800-18000)){
		$gameday = 15;
	}
	return $gameday;
}

function getcode($country){
	switch ($country) {
		case "Albania":
			$code = "alb";
			break;
		case "Austria":
			$code = "aut";
			break;
		case "Belgium":
			$code = "bel";
			break;
		case "Croatia":
			$code = "cro";
			break;
		case "Czech Republic":
			$code = "cze";
			break;
		case "England":
			$code = "eng";
			break;
		case "France":
			$code = "fra";
			break;
		case "Germany":
			$code = "ger";
			break;
		case "Hungary":
			$code = "hun";
			break;
		case "Iceland":
			$code = "isl";
			break;
		case "Ireland":
			$code = "irl";
			break;	
		case "Italy":
			$code = "ita";
			break;	
		case "N.Ireland":
			$code = "nir";
			break;	
		case "Poland":
			$code = "pol";
			break;	
		case "Portugal":
			$code = "por";
			break;	
		case "Romania":
			$code = "rou";
			break;	
		case "Russia":
			$code = "rus";
			break;	
		case "Slovakia":
			$code = "svk";
			break;	
		case "Spain":
			$code = "esp";
			break;	
		case "Sweden":
			$code = "swe";
			break;	
		case "Switzerland":
			$code = "sui";
			break;	
		case "Turkey":
			$code = "tur";
			break;	
		case "Ukraine":
			$code = "ukr";
			break;	
		case "Wales":
			$code = "wal";
			break;
			
			}
	return $code;
}

?>
