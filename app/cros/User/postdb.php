<?php

namespace cros\user;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* posts db connection
*/
class postdb extends Eloquent
{
	
	protected $table = 'posts';

	protected $fillable = [
		'post',
		'user_id',
		'date_posted',
		'post_username',
		'parent_id'
	];

	//public $timestamps = false;


	/*public function create_html_links($input) {
	   $pattern = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
	   return $output = preg_replace($pattern, '<a href="http$2://$4">$0</a>', $input);
}
	public function create_html_links($str) {
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		$urls = array();
		$urlsToReplace = array();
		if(preg_match_all($reg_exUrl, $str, $urls)) {
			$numOfMatches = count($urls[0]);
			$numOfUrlsToReplace = 0;
			for($i=0; $i<$numOfMatches; $i++) {
				$alreadyAdded = false;
				$numOfUrlsToReplace = count($urlsToReplace);
				for($j=0; $j<$numOfUrlsToReplace; $j++) {
					if($urlsToReplace[$j] == $urls[0][$i]) {
						$alreadyAdded = true;
					}
				}
				if(!$alreadyAdded) {
					array_push($urlsToReplace, $urls[0][$i]);
				}
			}
			$numOfUrlsToReplace = count($urlsToReplace);
			for($i=0; $i<$numOfUrlsToReplace; $i++) {
				$str = str_replace($urlsToReplace[$i], "<a href=\"".$urlsToReplace[$i]."\">".$urlsToReplace[$i]."</a> ", $str);
			}
			return $str;
		} else {
			return $str;
		}
}*/
}

