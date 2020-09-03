<?php

namespace Lisync\IsNsfw\Tests;

use \Lisync\IsNsfw\Core\CoreTest;

class Clean extends CoreTest
{
	public function test($case)
	{
		$clean = $this->loadData("clean_regex");
		
		return preg_match("/(\.(gov|edu)|{$clean})/i", $case->getUrl("host")) ? -1 : 0;
	}
}


