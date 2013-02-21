<?php
/* Last updated with phpFlickr 1.3.2
 *
 * This example file shows you how to call the 100 most recent public
 * photos.  It parses through them and prints out a link to each of them
 * along with the owner's name.
 *
 * Most of the processing time in this file comes from the 100 calls to
 * flickr.people.getInfo.  Enabling caching will help a whole lot with
 * this as there are many people who post multiple photos at once.
 *
 * Obviously, you'll want to replace the "<api key>" with one provided 
 * by Flickr: http://www.flickr.com/services/api/key.gne
 */

require_once("phpFlickr.php");
$f = new phpFlickr("9deed49f7a015b2082e63118343ca996");

//@suppresswarnings( unchecked );

?>
<a href="search.php">Volver</a><hr>
<?php 

$lugar = $f->places_find($_POST['lugar']);
$place_id = "";

foreach ($lugar['places']['place'] as $place) {
	$place_id = $place['place_id'];
}

$argumentos = array (/*"tags" => "clavijero,catedral,acueducto,morelia",*/"place_id" => $place_id);// "longitud" => "-101.26428","latitud" => "19.69950");

$recent = $f->photos_search($argumentos);

echo count($recent)."<br>";

echo $recent['total'];echo "<br>";

foreach ($recent['photo'] as $photo) {
	//$file = fopen("prueba_uno.txt","a+");
    $owner = $f->people_getInfo($photo['owner']);
    echo "<a href='http://www.flickr.com/photos/" . $photo['owner'] . "/" . $photo['id'] . "/'>";
    echo $photo['id'];
    //echo $photo['owner'];
    //echo "</a> Owner: ";
    //echo "<a href='http://www.flickr.com/people/" . $photo['owner'] . "/'>";
    echo $owner['username'];
    echo "</a><br>";
}
?>