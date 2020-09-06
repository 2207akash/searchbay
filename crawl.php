<?php
include("classes/DOMDocumentParser.php");

function followLinks($url) {
	$parser = new DomDocumentParser($url);

	$linkList = $parser->getLinks();

	foreach($linkList as $link) {
		$href = $link->getAttribute("href");
		echo $href . "<br>";
	}
}

$startURL = "http://www.google.com";
followLinks($startURL);

?>