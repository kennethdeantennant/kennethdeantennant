<?php
//require("pages/phpsqlgeocode_dbinfo.php");
include("classes/Connection.php");
include("classes/Address.php");

define("MAPS_HOST", "maps.google.com");
define("KEY", "ABQIAAAA5Ib5VSyc9JNoOzDqNYggthSbBvwUKA7jgP3J-9UiK1xvW3Sp4BSIAwy-QeQP3aK-2takCE0Oz43RYw");

// Get all addresses NOT geo coded
$address = new Address();
$results = $address->getAllNotGeoCode();

// Initialize delay in geocode speed
$delay = 0;
$base_url = "http://" . MAPS_HOST . "/maps/geo?output=csv" . "&key=" . KEY;

$count = 0;
echo("<span style='font-weight: bolder; font-family: verdana; font-size: 28px' >GEO Coding for Addresses - ".date("m/d/Y")."</span><hr />");
echo("<span style='font-weight: bolder; font-family: verdana; font-size: 12px' >");
// Iterate through the rows, geocoding each address
while ($row = @mysql_fetch_assoc($results)) {
  $geocode_pending = true;

  while ($geocode_pending) {
	
    $fulladdress = $row["number"]." ".$row["street"].($result["apartment"] != "" ? " ".$result["apartment"] : "").", ".$row["city"].", ".$row["state"];
	echo("<br />".$fulladdress);
    $id = $row["id"];
    $request_url = $base_url . "&q=" . urlencode($fulladdress);
    $csv = file_get_contents($request_url) or die("url not loading");

    $csvSplit = split(",", $csv);
    $status = $csvSplit[0];
    $lat = $csvSplit[2];
    $lng = $csvSplit[3];
    if (strcmp($status, "200") == 0) {
      // successful geocode
      $geocode_pending = false;
      $lat = $csvSplit[2];
      $lng = $csvSplit[3];
	  echo("<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(".$lat." - ".$lng.")");

	  if($address->updateGEO($id, $lat, $lng)) $count += 1;
    } else if (strcmp($status, "620") == 0) {
      // sent geocodes too fast
      $delay += 100000;
    } else {
      // failure to geocode
      $geocode_pending = false;
      echo "Address " . $address . " failed to geocoded. ";
      echo "Received status " . $status . "\n";
    }
    usleep($delay);
  }
}
echo("<hr />Total Processed: ".$count);
echo("</span>");
?>