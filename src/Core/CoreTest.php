<?php

namespace Lisync\IsNsfw\Core;

use  \Lisync\IsNsfw\Core\GetContents;

abstract class CoreTest
{
    public function __construct($case)
    {
        $this->case = $case;
    }

    abstract function test($case);

    public function loadData($data , $decode = false )
    {
        if (is_file($data)) {
            $data = file_get_Contents( $data );
        }

        if (is_file(__DIR__."/../data/{$data}")) {
            $data = file_get_contents(  __DIR__."/../data/{$data}" );
        }

        return $decode ? json_decode($data , true ) : $data ;
    }


    public function getResults()
    {
        return $this->test($this->case);
    }
}
