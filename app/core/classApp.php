<?php
/**
 * dev by @fortrou, @itachinight
 * class Application basic
 * private: currentUrl, currentUri
 * methods: parse_uri, parse_config, connect_database
 *
 **/
class App {
	private $currentUrl;
	private $currentUri;
	private $action;

	public function __construct($url, $uri = '') {
		$this->currentUrl = $url;
		$this->currentUri = $uri;
	}

	private function object_to_array($obj) {
	    if(is_object($obj) || is_array($obj)) {
	        $ret = (array) $obj;
	        foreach($ret as &$item) {
	            $item = $this->object_to_array($item);
	        }
	        return $ret;
	    } else {
	        return $obj;
	    }
	}

	public function parse_uri() {
		$keys_array = $this->object_to_array(simplexml_load_file('config.xml'));
		$routers = $keys_array['routers'];

		$this->currentUri = ltrim($this->currentUri, '/');
		$uriArray = explode('/', $this->currentUri);

		if($this->currentUri == '') {
			$controller = "MainController";
		} else if($routers[$uriArray[0]]) {
			$controller = $routers[$uriArray[0]]["controller"]["initController"];

			if($uriArray[1]){
				$this->action = $routers[$uriArray[0]]["controller"][$uriArray[1]]["initAction"];
			}
		} else $controller = "AuthorizationController";

		if (isset($this->action)) {
			$actionToLoad = $this->action;
		} else {
			$actionToLoad = "init_work";
		}

		SessionManager::add_cookieToSession('user');
        $app_controller = new $controller();
		$app_controller->$actionToLoad();
	}

}