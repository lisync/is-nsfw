<?php
namespace Lisync\IsNsfw\Tests ;
use \Lisync\IsNsfw\Core\CoreTest ;

class Nsfw extends CoreTest
{
	public function test($case)
	{
		return preg_match("/blog_is_nsfw\s+=\s+\'Yes\'|\'adultContent\':\s+true|\"nsfw\":\s+true|\"isNSFW\":\s+true/" , $case->getBody()) ? 0.5 : 0 ;
	}
}