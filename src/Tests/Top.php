<?php
namespace Lisync\IsNsfw\Tests ;
use \Lisync\IsNsfw\Core\CoreTest ;

class Top extends CoreTest
{
	public function test($case)
	{
		$top = $this->loadData("top") ;
		
		return preg_match("/{$top}/" , $case->getUrl("host")) ? 1 : 0 ; 
	}
}