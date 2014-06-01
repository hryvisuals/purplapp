<?php

class PostClubs {
	public $user_posts = null;

	public $clubs = array(
		array("name" => "#RollClub", "url" => "RollClub", "count" => "500")
		,array("name" => "#CrumpetClub", "url" => "CrumpetClub", "count" => "1 000")
		,array("name" => "#NoonClub", "url" => "NoonClub", "count" => "1 200")
		,array("name" => "#BitesizeCookieClub", "url" => "BitesizeCookieClub", "count" => "2 000")
		,array("name" => "#CrunchClub", "url" => "CrunchClub", "count" => "2 600")
		,array("name" => "#MysteryScienceClub", "url" => "MysteryScienceClub", "count" => "3 000")
		,array("name" => "#LDRClub", "url" => "LDRClub", "count" => "5 000")
		,array("name" => "#IBMPCClub", "url" => "IBMPCClub", "count" => "8 088")
		,array("name" => "#CookieClub", "url" => "CookieClub", "count" => "10 000")
		,array("name" => "#SpinalTapClub", "url" => "SpinalTapClub", "count" => "11 000")
		,array("name" => "#BreakfastClub", "url" => "BreakfastClub", "count" => "20 000")
		,array("name" => "#CaratClub", "url" => "CaratClub", "count" => "24 000")
		,array("name" => "#PeshawarClub", "url" => "PeshawarClub", "count" => "25 000")
		,array("name" => "#MileHighClub", "url" => "MileHighClub", "count" => "30 000")
		,array("name" => "#PiClub", "url" => "PiClub", "count" => "31 416")
		,array("name" => "#TowelClub", "url" => "TowelClub", "count" => "42 000")
		,array("name" => "#HitmanClub", "url" => "HitmanClub", "count" => "47 000")
		,array("name" => "#BaconClub", "url" => "BaconClub", "count" => "50 000")
		,array("name" => "#BrowncoatClubClub", "url" => "BrowncoatClubClub", "count" => "57 000")
		,array("name" => "#CommodoreClub", "url" => "CommodoreClub", "count" => "64 000")
		,array("name" => "#MotorolaClub", "url" => "MotorolaClub", "count" => "68 000")
		,array("name" => "#TromboneClub", "url" => "TromboneClub", "count" => "76 000")
		,array("name" => "#WiFiClub", "url" => "WiFiClub", "count" => "80 211")
		,array("name" => "#PajamaClub", "url" => "PajamaClub", "count" => "90 000")
		,array("name" => "#TowerOfBabbleClub", "url" => "TowerOfBabbleClub", "count" => "100 000")
		,array("name" => "#OrbitClub", "url" => "OrbitClub", "count" => "110 000")
		,array("name" => "#MacClub", "url" => "MacClub", "count" => "128 000")
		,array("name" => "#TwitterLeaverClub", "url" => "TwitterLeaverClub", "count" => "140 000")
		,array("name" => "#GetALifeNoSrslyClub", "url" => "GetALifeNoSrslyClub", "count" => "200 000")
		,array("name" => "#MeaninglessPostCountClub", "url" => "MeaninglessPostCountClub", "count" => "231 568")
		,array("name" => "#ADNClub", "url" => "ADNClub", "count" => "256 000")
		,array("name" => "#PensionersClub", "url" => "PensionersClub", "count" => "401 000")
		,array("name" => "#LaughterClub", "url" => "LaughterClub", "count" => "555 000")
		,array("name" => "#GatesClub", "url" => "GatesClub", "count" => "640 000")
		,array("name" => "#JoyLuckClub", "url" => "JoyLuckClub", "count" => "888 000")
		,array("name" => "#MillionairesClub", "url" => "MillionairesClub", "count" => "1 000 000")
	); 

	public $memberclubs = array();

	public function setUserPost($get) {
		$this->user_posts = $get;
	}
	
	public function setUserID($get) {
		$this->user_id = $get;
	}
	
	public function setAlpha($get) {
		$this->alpha = $get;
	}

	public function getClubs() {
		foreach($this->clubs as $club) {
			if($this->user_posts > preg_replace("/[^0-9,.]/", "", $club['count'])) {
				$this->memberclubs[] = "<a href='{$this->alpha}hashtags/{$club['url']}' target='_blank'>{$club['name']}</a> <i>({$club['count']} posts)</i>";
			}
		}
	}
	
	public function getOrphanBlackClub() {
		if($this->user_posts > $this->user_id) {
			$this->OrphanBlackClub = "Yes <i>(user has more than {$this->user_id} posts)</i>";
		} else {
			$untilOrphanBlackClub = $this->user_id - $this->user_posts;
			$this->OrphanBlackClub = "No <i>({$untilOrphanBlackClub} posts left)</i>";
		}
	}
}

class PostData {

	/** 
		* A sweet interval formatting, will use the two biggest interval parts. 
		* On small intervals, you get minutes and seconds. 
		* On big intervals, you get months and days. 
		* Only the two biggest parts are used. 
		* 
		* @param DateTime $start 
		* @param DateTime|null $end 
		* @return string 
	*/ 
	
	public function formatDateDiff($start, $end=null) { 
	    if(!($start instanceof DateTime)) { 
	        $start = new DateTime($start); 
	    } 
	    
	    if($end === null) { 
	        $end = new DateTime(); 
	    } 
	    
	    if(!($end instanceof DateTime)) { 
	        $end = new DateTime($start); 
	    } 
	    
	    $interval = $end->diff($start); 
	    $doPlural = function($nb,$str){return $nb>1?$str.'s':$str;}; // adds plurals 
	    
	    $format = array(); 
	    if($interval->y !== 0) { 
	        $format[] = "%y ".$doPlural($interval->y, "year"); 
	    } 
	    if($interval->m !== 0) { 
	        $format[] = "%m ".$doPlural($interval->m, "month"); 
	    } 
	    if($interval->d !== 0) { 
	        $format[] = "%d ".$doPlural($interval->d, "day"); 
	    } 
	    if($interval->h !== 0) { 
	        $format[] = "%h ".$doPlural($interval->h, "hour"); 
	    } 
	    if($interval->i !== 0) { 
	        $format[] = "%i ".$doPlural($interval->i, "minute"); 
	    } 
	    if($interval->s !== 0) { 
	        if(!count($format)) { 
	            return "less than a minute"; 
	        } else { 
	            $format[] = "%s ".$doPlural($interval->s, "second"); 
	        } 
	    } 
	    
	    // We use the two biggest parts 
	    if(count($format) > 1) { 
	        $format = array_shift($format)." and ".array_shift($format); 
	    } else { 
	        $format = array_pop($format); 
	    } 
	    
	    // Prepend 'since ' or whatever you like 
	    return $interval->format($format); 
	} 
}
?>