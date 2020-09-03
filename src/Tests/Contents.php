<?php

namespace Lisync\IsNsfw\Tests;

use \Lisync\IsNsfw\Core\CoreTest;

class Contents extends CoreTest
{
    public function test($case)
    {

        $score = 0 ;

        $power = 1 ;
        
        $scores = $this->loadData("scores.json" , true ) ;

        $regex = [] ;
        $regex []= "/\b". $this->loadData("porn_regex")."\b/i";
        $regex []= "/".$this->loadData("glyph_regex")."/i";
        $regex [] = "/(?<assurance>site\srip[s]?|siterip[s]?|megapack[s]?|watch|vid[eo][sz]?|movi[e]?[sz]?|imag[e]?[sz]?|gallery|online|free|webcam|cam|tube|download)?/i" ;


        
     
        $output = [] ;

       
        foreach($regex as $regexp) {
            if(preg_match_all($regexp , $case->getBody() , $out)) {
                if(isset($out["assurance"])) {
                    $power = 2 ;
                } else {
                    $output = array_merge($output , $out[0] );
                }
            }
        }

        $output = array_unique($output) ;

        foreach($output as $keyword) {
            $score += $scores[strtolower($keyword)]["weight"] ;
        }

        if(count($output)) {
            return($score / count($output));
        }

        


        return 0;

       
    }
}
