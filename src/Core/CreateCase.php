<?php
namespace Lisync\IsNsfw\Core ; 
use  \Lisync\IsNsfw\Core\GetContents ;

class CreateCase extends AbstractCase 
{
    private $contents ; 
    private $url ;

    public function __construct($link)
    {
        $link = urldecode($link);
        $url = parse_url($link) ;
        if(preg_match("/ftps?/i" , $url["scheme"]))
        {
            $url["user"] = $url["username"] ?? 'anonymous' ;
            $url["pass"] =  $url["password"] ?? 'anonymouse@gmail.com' ;
        } 

        $this->url  = $url ;

        $this->isValid  = false  ;

        if( $this->contents = (new GetContents($url))->get() )  {

            $this->isValid  = true ;
        }
        
    }


    public function url()
    {
        return $this->url ;
    }
    
    public function type()
    {
        return (string) new GetType($this);
    }

    public function tests()
    {
        return null ;
    }
   

    public function isValid()
    {
        return $this->isValid ;
    }

    public function meta()
    {
        
        return $this->contents["meta"] ;
    }

    public function name()
    {
        return "generice case" ;
    }

    public function body()
    {
        return $this->contents["body"] ;
    }
}