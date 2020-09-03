<?php

namespace Lisync\IsNsfw\Core;

use \GuzzleHttp\Client;
use \Itx\Utilities\DomFetcher ;

class GetContents
{
    public $details = [];
    public function __construct($parsed)
    {
        $this->url  = $this->unParse($parsed);
        $this->type = $parsed["scheme"] === "ftp" ? "ftp" : "http";
    }

    public function get()
    {


        if ($this->type == "ftp") {
            if ($data = file_get_contents($this->url, false)) {

                return [
                    "body"  => $data,
                    "meta"  => []
                ];
            }
        }

        $client = (new Client)->request('GET', $this->url, []);

        $body = (string) $client->getBody();

        return [
            "body" => $body,
            "meta" => $this->getMeta($body)
        ];
    }

    private function getMeta($data)
    {
        return DomFetcher::using($data)->fetch([
            "title" => "//title",
            "description" => "(//meta[@name*=i'description'])[1]/@content",
            "ogDescription" => "(//meta[@property*=i'og:description'])[1]/@content",
            "keywords" => "(//meta[@name*=i'keywords'])[1]/@content",
            "rating" => "(//meta[@name*=i'rating'])[1]/@content"
        ]);
    }





    protected function unParse($parsed_url)
    {
        if (is_string($parsed_url)) {
            return $parsed_url;
        }

        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
        $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
        $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
        return "{$scheme}{$user}{$pass}{$host}{$port}{$path}{$query}{$fragment}";
    }
}
