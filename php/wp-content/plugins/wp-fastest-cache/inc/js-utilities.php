<?php
	class JsUtilities{
		private $html = "";
		private $jsLinks = array();
		private $jsLinksExcept = "";
		private $url = "";

		public function __construct($wpfc, $html){
			//$this->html = preg_replace("/\s+/", " ", ((string) $html));
			$this->html = $html;

			$this->setJsLinksExcept();

			$this->inlineToScript($wpfc);
			$this->setJsLinks();
			$this->setJsLinksExcept();
		}

		public function inlineToScript($wpfc){
			preg_match("/<head(.*?)<\/head>/si", $this->html, $head);


			$data = $head[1];
			$script_list = array();
			$script_start_index = false;

			for($i = 0; $i < strlen( $data ); $i++) {
				if(isset($data[$i-6])){
				    if(substr($data, $i-6, 7) == "<script"){
				    	$script_start_index = $i-6;
					}
				}

				if(isset($data[$i-8])){
					if($script_start_index){
						if(substr($data, $i-8, 9) == "</script>"){
							array_push($script_list, array("start" => $script_start_index, "end" => $i));
							$script_start_index = false;
						}
					}
				}
			}

			if(!empty($script_list)){
				foreach (array_reverse($script_list) as $key => $value) {
					$inline_script = substr($data, $value["start"], ($value["end"] - $value["start"] + 1));


					if(preg_match("/^<script[^\>\<]*src\=[^\>\<]*>/i", $inline_script)){
						continue;
					}

					if(preg_match("/yandex\.ru/i", $inline_script)){
						continue;
					}

					if(preg_match("/switchTo5x/i", $inline_script)){ // WP Socializer
						continue;
					}

					if(preg_match("/window\.dynamicgoogletags/i", $inline_script)){
						continue;
					}

					if(preg_match("/GoogleAnalyticsObject/i", $inline_script)){
						continue;
					}

					if(preg_match("/document\.write/i", $inline_script)){
						continue;
					}

					if(preg_match("/google\-analytics\.com/i", $inline_script)){
						continue;
					}

					if(preg_match("/addIgnoredOrganic/i", $inline_script)){
						continue;
					}

					if(preg_match("/WebFontConfig/i", $inline_script)){
						continue;
					}

					if(preg_match("/action\=wordfence_logHuman\&hid=/i", $inline_script)){
						continue;
					}

					if(preg_match("/connect\.facebook\.net/i", $inline_script)){
						continue;
					}

					if(preg_match("/document\.createElement\([^\(\)]+script[^\(\)]+\)/i", $inline_script)){
						continue;
					}

					if(strpos($this->getJsLinksExcept(), $inline_script) === false){
						$inline_script = preg_replace("/<!--((?:(?!-->).)+)-->/si", '', $inline_script);
						$inline_script = preg_replace("/^\s+/m", "", ((string) $inline_script));
						
						$attributes = "";
						$cachFilePath = WPFC_WP_CONTENT_DIR."/cache/wpfc-minified/".md5($inline_script);
						$jsScript = content_url()."/cache/wpfc-minified/".md5($inline_script);

						if(preg_match("/<script([^\>]*)>/i", $inline_script, $out)){
							$attributes = $out[1];
						}
						
						$inline_script = trim($inline_script);
						$inline_script = preg_replace("/<script([^\>]*)>/i", "", $inline_script);
						$inline_script = preg_replace("/<\/script>/i", "", $inline_script);

						if(!is_dir($cachFilePath)){
							$prefix = time();
							$wpfc->createFolder($cachFilePath, $inline_script, "js", $prefix);
						}

						if($jsFiles = @scandir($cachFilePath, 1)){
							$jsScript = str_replace(array("http://", "https://"), "//", $jsScript);
							$script = "<script src='".$jsScript."/".$jsFiles[0]."'".$attributes."></script>";
							$data = substr_replace($data, "<!-- ".$inline_script." -->"."\n".$script, $value["start"], ($value["end"] - $value["start"] + 1));
						}
					}
				}
			}

			$this->html = str_replace($head[1], $data, $this->html);
		}

		public function setJsLinks(){
			preg_match("/<head(.*?)<\/head>/si", $this->html, $head);

			preg_match_all("/<script[^<>]+src=[\"\']([^\"\']+)[\"\'][^<>]*><\/script>/", $head[1], $this->jsLinks);

			$this->jsLinks = $this->jsLinks[0];
		}

		public function setJsLinksExcept(){
			preg_match("/<head(.*?)<\/head>/si", $this->html, $head);

			$data = $head[1];
			$comment_list = array();
			$comment_start_index = false;

			for($i = 0; $i < strlen( $data ); $i++) {
				if(isset($data[$i-3])){
				    if($data[$i-3].$data[$i-2].$data[$i-1].$data[$i] == "<!--"){
				    	$comment_start_index = $i-3;
					}
				}

				if(isset($data[$i-2])){
					if($comment_start_index){
						if($data[$i-2].$data[$i-1].$data[$i] == "-->"){
							array_push($comment_list, array("start" => $comment_start_index, "end" => $i));
							$comment_start_index = false;
						}
					}
				}
			}

			if(!empty($comment_list)){
				foreach (array_reverse($comment_list) as $key => $value) {
					if(($value["end"] - $value["start"]) > 4){
						$this->jsLinksExcept = $this->jsLinksExcept.substr($data, $value["start"], ($value["end"] - $value["start"] + 1));
					}
				}
			}

			// preg_match_all("/<\!--\s*\[\s*if[^>]+>(.*?)<\!\s*\[\s*endif\s*\]\s*-->/si", $head[1], $jsLinksInIf);

			// preg_match_all("/<\!--(?!\[if)(.*?)(?!<\!\s*\[\s*endif\s*\]\s*)-->/si", $head[1], $jsLinksCommentOut);

			// $this->jsLinksExcept = implode(" ", array_merge($jsLinksInIf[0], $jsLinksCommentOut[0]));
		}

		public function getJsLinksExcept(){
			return $this->jsLinksExcept;
		}

		public function getJsLinks(){
			return array_unique($this->jsLinks);
		}

		public function minify($url, $minify = true){
			$this->url = $url;

			$cachFilePath = WPFC_WP_CONTENT_DIR."/cache/wpfc-minified/".md5($url);
			$jsLink = content_url()."/cache/wpfc-minified/".md5($url);

			if(is_dir($cachFilePath)){
				return array("cachFilePath" => $cachFilePath, "jsContent" => "", "url" => $jsLink);
			}else{
				if($js = $this->file_get_contents_curl($url)){
					if($minify){
						$js = preg_replace("/^\s+/m", "", ((string) $js));
					}

					$js = "\n// source --> ".$url." \n".$js;

					return array("cachFilePath" => $cachFilePath, "jsContent" => $js, "url" => $jsLink);
				}
			}
			return false;
		}

		public function checkInternal($link){
			$httpHost = str_replace("www.", "", $_SERVER["HTTP_HOST"]); 
			if(preg_match("/src=[\"\'](.*?)[\"\']/", $link, $src)){

				if(preg_match("/^\/[^\/]/", $src[1])){
					return $src[1];
				}

				if(@strpos($src[1], $httpHost)){
					return $src[1];
				}
			}
			return false;
		}

		public function replaceLink($search, $replace, $content){
			$href = "";

			if(stripos($search, "<script") === false){
				$href = $search;
			}else{
				preg_match("/.+src=[\"\'](.+)[\"\'].+/", $search, $out);
			}

			if(count($out) > 0){
				$content = preg_replace("/<script[^>]+".preg_quote($out[1], "/")."[^>]+><\/script>/", $replace, $content);
			}

			return $content;
		}


		public function mergeJs($prev, $wpfc){
			if(count($prev["value"]) > 0){
				$name = "";
				foreach ($prev["value"] as $prevKey => $prevValue) {
					if($prevKey == count($prev["value"]) - 1){
						$name = md5($name);
						$cachFilePath = WPFC_WP_CONTENT_DIR."/cache/wpfc-minified/".$name;

						if(!is_dir($cachFilePath)){
							$wpfc->createFolder($cachFilePath, $prev["content"], "js", time());
						}

						if($jsFiles = @scandir($cachFilePath, 1)){
							$prefixLink = str_replace(array("http:", "https:"), "", content_url());
							$newLink = "<script src='".$prefixLink."/cache/wpfc-minified/".$name."/".$jsFiles[0]."' type=\"text/javascript\"></script>";
							$this->html = $this->replaceLink($prevValue, "<!-- ".$prevValue." -->"."\n".$newLink, $this->html);
						}
					}else{
						$name .= $prevValue;
						$this->html = $this->replaceLink($prevValue, "<!-- ".$prevValue." -->", $this->html);
					}
				}
			}
			return $this->html;
		}

		public function file_get_contents_curl($url) {

			if(!preg_match("/\.php$/", $url)){
				$url = $url."?v=".time();
			}

			if(preg_match("/^\/[^\/]/", $url)){
				$url = home_url().$url;
			}

			$url = preg_replace("/^\/\//", "http://", $url);
			
			// $ch = curl_init();
		 
			// curl_setopt($ch, CURLOPT_HEADER, 0);
			// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
			// curl_setopt($ch, CURLOPT_URL, $url);
		 
			// $data = curl_exec($ch);
			// curl_close($ch);
		 
			// if(preg_match("/<\/\s*html\s*>\s*$/i", $data)){
			// 	return false;
			// }else{
			// 	return $data;	
			// }

			$response = wp_remote_get($url, array('timeout' => 10 ) );

			if ( !$response || is_wp_error( $response ) ) {
				return false;
			}else{
				if(wp_remote_retrieve_response_code($response) == 200){
					$data = wp_remote_retrieve_body( $response );

					if(preg_match("/<\/\s*html\s*>\s*$/i", $data)){
						return false;
					}else{
						return $data;	
					}
				}
			}
		}
	}
?>