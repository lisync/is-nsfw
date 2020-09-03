<?php
namespace Lisync\IsNsfw\Tests ;
use \Lisync\IsNsfw\Core\CoreTest ;

class Dirty extends CoreTest
{
	public function test($case)
	{
		$top = $this->loadData("dirty_regex") ;

		return preg_match("/{$top}/i" , $case->getUrl("host")) ? 1 : 0;
	}
}