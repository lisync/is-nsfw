<?php
namespace Lisync\IsNsfw\Core ; 
use  \Lisync\IsNsfw\Core\GetContents ;
abstract class AbstractCase 
{

    private $sum = 0 ;
    private $latestTest = "" ;
    private $latestSum = 0 ;

    abstract public function isValid() ;
    abstract public function type() ;
    abstract public function tests() ;
    abstract public function meta() ;
    abstract public function url() ;
    abstract public function body() ;
    abstract public function name();


    public function getName() 
    {
        return $this->name() ;
    }


    public function getType()
    {
        return $this->type() ;
    }

    public function getTests()
    {
        return $this->tests() ;
    }

    public function getMeta($attribute = null)
    {
        $meta =  $this->meta(); 
        

        if($attribute == null) {
            return $meta ;
        }


        if(array_key_exists($attribute  , $meta)) {
            return $meta[$attribute] ?: ""; 
        }

        return null ;
    }

    public function getUrl($attribute = null )
    {
        $url =  $this->url() ;
        if($attribute == null) {
            return $url ;
        }

        if(array_key_exists($attribute  , $url)) {
            return $url[$attribute] ?: ""; 
        }

        
        return null ;
    }

    public function getBody()
    {
        return $this->body();
    }
    
    public function addSum($sum)
    {
        $this->sum+=$sum ;
        $this->latestSum = $sum ;
    }

    public function setLatestTest($test)
    {
        $this->latestTest = $test ; 
    }

    public function getSum()
    {
       return $this->sum;
    }

    public function getLatestSum()
    {
       return $this->latestSum;
    }
}