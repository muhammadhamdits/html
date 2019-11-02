<?php
require '../connect.php';

$tipe   = @$_GET["tipe"];		// Cari berdasarkan apa
$nilai  = @$_GET["nilai"];	// Isi yang dicari
$nilai2 = @$_GET["nilai2"];	// Isi yang dicari
$rad    = @$_GET["rad"];	// rad yang dicari

/*
ISI TIPE:
	1 => Nama
	2 => Alamat
	3 => Harga Tiket
	4 => Tipe tourism
	5 => Fasilitas
*/

if ($tipe == 1) {
	$querysearch	="SELECT id, name, st_x(st_centroid(geom)) as lon ,st_y(st_centroid(geom)) as lat  from tourism where  LOWER(name) like '%' || LOWER('$nilai') || '%'";
} elseif ($tipe == 2) {
	$querysearch	="SELECT id, name, st_x(st_centroid(geom)) as lon ,st_y(st_centroid(geom)) as lat  from tourism where  LOWER(address) like '%' || LOWER('$nilai') || '%'";
} elseif ($tipe == 3) {
	$querysearch	="SELECT tourism.id, tourism.name, st_x(st_centroid(tourism.geom)) as lon ,st_y(st_centroid(tourism.geom)) as lat  from tourism left join tourism_type on tourism_type.id = tourism.id_type where tourism.id_type = '$nilai'";
} elseif ($tipe == 4) {
	$querysearch	="SELECT tourism.id, tourism.name, st_x(st_centroid(tourism.geom)) as lon ,st_y(st_centroid(tourism.geom)) as lat  from tourism left join detail_facility_tourism on detail_facility_tourism.id_tourism=tourism.id left join facility_tourism on facility_tourism.id = detail_facility_tourism.id_facility where  LOWER(facility_tourism.name) like '%' || LOWER('$nilai') || '%'  GROUP BY (tourism.id)";
} elseif ($tipe == 5) {
	$querysearch	="SELECT DISTINCT tourism.id, tourism.name, st_x(st_centroid(tourism.geom)) as lon ,st_y(st_centroid(tourism.geom)) as lat FROM worship_place left JOIN detail_facility ON worship_place.id=detail_facility.id_worship_place left JOIN facility ON detail_facility.id_facility=facility.id left JOIN facility_condition ON facility_condition.id=detail_facility.id_facility_condition left JOIN tourism ON ST_DistanceSphere(ST_Centroid(worship_place.geom), ST_Centroid(tourism.geom)) < $rad WHERE LOWER(facility.name) like '%' || LOWER('$nilai') || '%'  ";
	$qswp = "SELECT distinct worship_place.id, worship_place.name, st_x(st_centroid(worship_place.geom)) as lon ,st_y(st_centroid(worship_place.geom)) as lat  from worship_place left join detail_facility on detail_facility.id_worship_place=worship_place.id left join facility on facility.id = detail_facility.id_facility  JOIN tourism ON ST_DistanceSphere(ST_Centroid(worship_place.geom), ST_Centroid(tourism.geom)) < $rad where LOWER(facility.name) like '%' || LOWER('$nilai') || '%'  GROUP BY (worship_place.id)";
} elseif ($tipe == 6) {
	$querysearch	="SELECT DISTINCT tourism.id, tourism.name, st_x(st_centroid(tourism.geom)) as lon ,st_y(st_centroid(tourism.geom)) as lat FROM culinary_place left JOIN detail_facility_culinary ON culinary_place.id=detail_facility_culinary.id_culinary_place left JOIN facility_culinary ON detail_facility_culinary.id_facility=facility_culinary.id left JOIN detail_culinary ON culinary_place.id=detail_culinary.id_culinary_place left JOIN culinary ON detail_culinary.id_culinary=culinary.id left JOIN tourism ON ST_DistanceSphere(ST_Centroid(culinary_place.geom), ST_Centroid(tourism.geom)) < $rad WHERE LOWER(culinary.name) like '%' || LOWER('$nilai2') || '%' AND LOWER(facility_culinary.facility) like '%' || LOWER('$nilai') || '%'";
} elseif ($tipe == 7) {
	$querysearch	="SELECT DISTINCT tourism.id, tourism.name, st_x(st_centroid(tourism.geom)) as lon ,st_y(st_centroid(tourism.geom)) as lat, district.name as d FROM tourism JOIN district ON ST_Within(tourism.geom, district.geom) JOIN small_industry ON ST_DistanceSphere(ST_Centroid(small_industry.geom), ST_Centroid(tourism.geom)) < $rad JOIN industry_type ON small_industry.id_industry_type=industry_type.id WHERE LOWER(district.name) like '%' || LOWER('$nilai') || '%' AND LOWER(industry_type.name) like '%' || LOWER('$nilai2') || '%'";
} elseif ($tipe == 8) {
	$querysearch	="SELECT DISTINCT tourism.id, tourism.name, st_x(st_centroid(tourism.geom)) as lon ,
	st_y(st_centroid(tourism.geom)) as lat FROM hotel
	left JOIN detail_facility_hotel ON hotel.id=detail_facility_hotel.id_hotel 
	left JOIN facility_hotel ON detail_facility_hotel.id_facility=facility_hotel.id 
	left JOIN hotel_type ON hotel.id_type=hotel_type.id 
	left JOIN tourism ON ST_DistanceSphere(ST_Centroid(hotel.geom), ST_Centroid(tourism.geom))
	< $rad WHERE LOWER(hotel_type.name) like '%' || LOWER('$nilai2') || '%' AND LOWER(facility_hotel.name) like '%' || LOWER('$nilai') || '%'";
}
// var_dump($qswp);
// die();

$hasil=pg_query($querysearch);
$dataarray = [];
while($baris = pg_fetch_assoc($hasil))
	{
		if($baris['id'] != NULL){
			$id=$baris['id'];
			$name=$baris['name'];
			$lng=$baris['lon'];
			$lat=$baris['lat'];
			$dataarray1[]=array('id'=>$id,'name'=>$name,'lng'=>$lng,'lat'=>$lat);
		}
	}
if(isset($qswp)){
	$hasil2=pg_query($qswp);
	while($baris = pg_fetch_assoc($hasil2)){
		if($baris['id'] != NULL){
			$id=$baris['id'];
			$name=$baris['name'];
			$lng=$baris['lon'];
			$lat=$baris['lat'];
			$dataarray2[]=array('id'=>$id,'name'=>$name,'lng'=>$lng,'lat'=>$lat);
		}
	}
}
$dataarray = [$dataarray1, $dataarray2];
echo json_encode ($dataarray);
?>
