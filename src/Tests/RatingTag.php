<?php

namespace Lisync\IsNsfw\Tests;

use \Lisync\IsNsfw\Core\CoreTest;

class RatingTag extends CoreTest
{
	// https://www.metatags.org/all-meta-tags-overview/meta-name-rating/ 
	
	public function test($case)
	{
		$adult = [
			"RTA-5042-1996-1400-1577-RTA" ,
			"adult" ,
			"restricted" ,
			"18|2[0-1]{1,}\syears" ,
			"mature"
		] ;
		
		return preg_match( "/".implode("|" , $adult)."/i" , $case->getMeta("rating") ?: "" ) ? 1 : 0 ;
	}
}
