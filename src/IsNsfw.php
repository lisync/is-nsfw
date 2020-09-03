<?php
namespace Lisync\IsNsfw ;
use \Lisync\IsNsfw\Core\{AbstractCase, CreateCase , CaseInterface} ;

use \Lisync\IsNsfw\Tests\ {
    Tld,Dirty,Url,Contents,Alert,Clean , Nsfw,
    RatingTag,
    RecordKeepingStatement , Youtube , MetaTags 
} ;
use \Lisync\IsNsfw\Exceptions ;



class IsNsfw
{
    public function __construct($case)
    {

		$sum = 0;

		if($case instanceof AbstractCase)  {} else {
			$case = new CreateCase( $case ) ;
		}



        $default = [
			"youtube"	=> [ Youtube::class ] ,
			"social" 	=> [ Alert::class , Contents::class ] ,
			"blog" 		=> [ Nsfw::class , Alert::class , Contents::class ],
			"reddit"	=> [ Nsfw::class , Alert::class ] ,
			"ftp"		=> [ Url::class , Contents::class ] ,
			"website" 	=> [
				Tld::class  , Clean::class , Url::class , RatingTag::class ,
				RecordKeepingStatement::class , Dirty::class , Alert::class , 
				MetaTags::class , Contents::class 
			] 
		];



		if($case->isValid()) {
			$tests = $case->getTests() ;
			if(!$tests) {
				if(!isset($default[$case->getType()])) {
					throw new Exceptions\InvalidCaseTestException( $case->getName() ) ;
				} 

				$tests = $default[$case->getType()];
			}

			foreach($tests as $test) {
				$case->addSum( (new $test($case))->getResults() );
				$case->setLatestTest($test);
				if( $case->getSum() < 0 ) {
					break ;
				}
			}

			
			$this->results = [
				"isValid" => true ,
				"isNsfw"  => $case->getSum() > 0.6 ,
				"type"	  => $case->getType() ,
				"score" => $case->getSum() > 1 ? 1 : $case->getSum() ,
				"title"		=> $case->getMeta("title") ?? "N/A" ,
			];
		} else {
			throw new Exceptions\InvalidCaseTestException( $case->getName() ) ;
		}

	}
	public function getResults()
	{
		return $this->results ;
	}

	public function why()
	{
		return $this->results ;
	}
}