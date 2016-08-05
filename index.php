<?php
while (empty($result)) {
	$url = prepareUrl();
	$html = sendGetRequest($url);
	$array = json_decode($html,0);
	$result = @getRandomItem($array[1]);	
}
echo json_encode(["stocazzo"=>$result]);

// functions
function getRandomItem($array) {
	if (empty($array)) return null;
	return $array[rand(0,count($array)-1)];
}

function sendGetRequest($url) {
	$curl = curl_init();
	curl_setopt_array($curl, [
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_USERAGENT => 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:32.0) Gecko/20100101 Firefox/32.0'
	]);
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}

function prepareUrl() {
	$chars = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
	if (rand(0,1)) {
		$url = "http://www.google.it/complete/search?hl=it&client=firefox&q=stocazzo%20".getRandomItem($chars)."*&cp=12";	
	} else {
		$url = "http://www.google.it/complete/search?hl=it&client=firefox&q=".getRandomItem($chars)."*%20stocazzo&cp=0";
	}
	return $url;
}