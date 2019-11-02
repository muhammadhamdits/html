<?php
require '../connect.php';
# Include required geoPHP library and define wkb_to_json function
require_once('assets/geoPHP/geoPHP.inc');
function wkb_to_json($wkb) {
    $geom = geoPHP::load($wkb,'wkb');
    return $geom->out('json');
}

# Build SQL SELECT statement and return the geometry as a WKB element
$sql = 'SELECT *, ST_ASWKB(geom) AS wkb FROM district';

# Try query or error
$rs = mysqli_query($conn, $sql);
if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
}

# Build GeoJSON feature collection array
$geojson = array(
	'type'      => 'FeatureCollection',
	'features'  => array()
 );
 
 # Loop through rows to build feature arrays
 while ($row = mysqli_fetch_assoc($rs)) {
	 $properties = $row;
	 # Remove wkb and geometry fields from properties
	 unset($properties['wkb']);
	 unset($properties['geom']);
	 $feature = array(
		  'type' => 'Feature',
		  'geometry' => json_decode(wkb_to_json($row['wkb'])),
		  'properties' => $properties
	 );
	 # Add feature arrays to feature collection array
	 array_push($geojson['features'], $feature);
 }
 echo(json_encode($geojson));
?>