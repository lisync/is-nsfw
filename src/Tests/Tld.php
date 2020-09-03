<?php
namespace Lisync\IsNsfw\Tests ;
use \Lisync\IsNsfw\Core\CoreTest ;

class Tld extends CoreTest
{
	public function test($case)
	{
		$tld = "xxx|erotic|sex|sexy|porn" ;
		
		return preg_match("/\.(?:{$tld})$/" , $case->getUrl("host")) ? 0.6 : 0 ; 
	}
}