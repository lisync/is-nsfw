<?php
namespace Lisync\IsNsfw\Tests ;
use  \Lisync\IsNsfw\Core\CoreTest ;

class Alert extends CoreTest 
{

	public function test($case)
	{
		/**
			ie. You must be at least 21 years old .. 
			ie. for adults only ..
			
		*/

		return preg_match("/(you)?(?:must|should|have|for).{0,25}\+?(1[8-9]|2[0-9]|adults?|eighteen)(only)?\+?/i" , $case->getBody() , $out) ? 0.5 : 0;
	}

}


