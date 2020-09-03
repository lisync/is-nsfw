<?php

namespace Lisync\IsNsfw\Core;

class GetType
{
	protected $case = null;
	public function __construct($case)
	{
		$probabilities  = [
			"social", "youtube", "darknet", "ftp", "blog", "sharing", "shortner", "chan", "image"
		];

		foreach ($probabilities as $probability) {
			if ($this->{"is" . ucfirst($probability)}($case)) {
				return $this->type =  $probability;
			}
		}

		return $this->type = "website";
	}

	public function isSocial($case) {
		return preg_match("/vk\.com|facebook\.com|fb\.com|twitter\.com|pinterest\.com/i", $case->getUrl("host"));
	}

	public function isYoutube($case)
	{
		return preg_match("/youtube\.com|youtu\.be/i", $case->getUrl("host"));
	}

	public function isDarknet($case)
	{
		return preg_match("/\.onion|\.i2p$/", $case->getUrl("host"));
	}

	public function isFtp($case)
	{
		return strcmp($case->getUrl("scheme"), "ftp") === 0;
	}

	public function isBlog($case)
	{
		return preg_match("/tumblr\.com|blogspot\.com/", $case->getUrl("host"));
	}

	public function isSharing($case)
	{
		return preg_match(
			"/drive\.google\.com|dropbox\.com|yadi\.sk|mega\.co\.nz|cloud\.mail\.ru|box\.com/",
			$case->getUrl("host")
		);
	}

	public function isShortner()
	{
		/**
		 *  1- check for link size ;
		 *  2- check if link has query  
		 *  3- check title for " shortening" 
		 */



		return false;
	}

	public function isImage()
	{
		/**
		 *  img , image , picture << in domain 
		 *  jpg , png , jpeg ... in link
		 *	
		 * */
	}

	public function isChan()
	{
		/**
		 * 
		 * [0-9]{1,5}chan 
		 */
	}

	public function isWebsite()
	{
		return true;
	}


	public function __toString()
	{
		return $this->type;
	}
}
