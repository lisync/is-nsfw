<?php
namespace Lisync\IsNsfw\Tests ;
use  \Lisync\IsNsfw\Core\CoreTest ;

class Youtube extends CoreTest 
{

	public function test($case)
	{
		return preg_match("/\"text\":\"Age-restricted video(.*[^\"])\"/" , $case->getBody()) ? 1 : 0;
	}

}


