<?php

namespace Lisync\IsNsfw\Tests;

use \Lisync\IsNsfw\Core\CoreTest;

class RecordKeepingStatement extends CoreTest
{
	public function test($case)
	{
		// check for Record Keeping Requirements Compliance Statement 

		return preg_match( "/2257\s+.*\s+(record|exemption|statement|notice)/i" , $case->getBody() ) ? 0.4 : 0 ;
    }

}
