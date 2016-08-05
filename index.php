<?php
//    Stocazzo 1.0
//    The most useful API ever
//
//    This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.

//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.

//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see <http://www.gnu.org/licenses/>.

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