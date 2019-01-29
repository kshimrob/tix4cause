@extends('layout')
@section('title')
Sports, Concert & Show Tickets | Tix4Cause | Live Event Tickets
@endsection
@section('content')
<?php
include(app_path().'/Includes/tnwsConstants.php');
include(app_path().'/Includes/genericLib.php');
?>
<style>
.search-filters #location-dropdown {
  display: none;
  position: relative;
  box-shadow: 0 3px 7px 2px rgba(0, 0, 0, 0.2);
  z-index: 10;
  padding: 10px;
  right: 0;
  background-color: white;
  width:233px;
}
.search-filters #location-dropdown #current-location {
  background-color: #E81C40;
  color: white;
  text-transform: uppercase;
  font: bold 14px "Roboto Condensed", sans-serif;
  letter-spacing: 0.2px;
  padding: 5px 10px;
  border: 2px solid #E81C40;
  display: inline-block;
  margin-bottom: 10px;
  -webkit-appearance: none;
  -moz-appearance: none;
}
.search-filters #user-location{
	    height: 45px;
    width: 100%;
    border: 2px solid #12A8DE;
    color: #000000;
    font-family: Roboto;
    font-size: 18px;
    font-weight: 500;
    line-height: 24px;
    padding-left: 10px;
    padding: 10px;
    position: relative;
    width: 233px;
    background: white;
}
.search-filters #location-dropdown #city-input-toggle {
  display: block;
  text-align: left;
}
.search-filters #location-dropdown #city-input-container {
  display: none;
  background-color: #dfdfdf;
  padding: 10px;
}
.search-filters #location-dropdown #city-input-container #close-btn {
  font-size: 30px;
  margin-bottom: 0;
  line-height: 0.8;
  float:right;
}
.search-filters #location-dropdown #city-input-container label {
  display: block;
  text-align: left;
  font-size: 12px;
  font-weight: bold;
}
.search-filters #location-dropdown #city-input-container input {
  display: block;
  width: 150px;
  color: black;
  font-family: "Roboto", sans-serif;
}
.search-filters #location-dropdown #city-input-container #change-location {
  background-color: #FFDA00;
  color: black;
  text-transform: uppercase;
  font: bold 14px "Roboto Condensed", sans-serif;
  letter-spacing: 0.2px;
  padding: 5px 10px;
  width: 100%;
  margin-top: 10px;
  border: 2px solid #FFDA00;
  display: inline-block;
}
.search-filters #location-dropdown #city-input-container #nav-error-message {
  display: none;
  color: red;
  font-weight: bold;
  font-size: 12px;
  text-align: left;
  margin-bottom: 0;
}
.search-filters #location-dropdown #city-input-container #error-input {
  border-color: red;
}

</style>
<?php
        $location = GeoIP::getLocation();
        $country = $location['country'];
        $city = $location['city'];
        $state = $location['state'];
        $lat = $location['lat'];
        $lng = $location['lon'];
?>
<?php
	$main_cat_array = array(
		'sports'	=> 1,
		'concerts'	=> 2,
		'arts-and-theater'	=> 3,
		'other-tickets'	=> 4,
	);
	$cat_concerts = array(
		'country'	=> 23,
		'pop'	=> 62,
		'rock'	=> 61,
		'rap-hip-hop'	=> 36,
		'comedy'	=> 24,
		'r-and-b'	=> 45,
		'children-and-family'	=> 55,
		'alternative'	=> 22,
		'festival-tour'	=> 100,
		'jazz-blues'	=> 21,
		'latin'	=> 73,
		'classical'	=> 49,
		'holiday'	=> 86,
	);
	$cat_sports	= array(
		'nfl'	=> 32,
		'nba'	=> 30, 
		'mlb'	=> 16,
		'nhl'	=> 19,
		'ncaaf'	=> 17,
		'ncaab'	=> 17,
		'soccer'	=> 71,
		'wwe'	=> 26,
		'pga'	=> 18,
		'nascar'	=> 187,
		'mma'	=> 101,
		'boxing'	=> 50,
		'tennis'	=> 27,

	);

	$cat_sports_parent = array(
		'ncaaf'	=> 65,
		'ncaab'	=> 66,
		'nfl'	=> 65,
		'nba'	=> 66
	);
	$cat_arts_theater = array(
		'broadway'	=> 70,
		'children-family'	=> 97,
		'musical-play'	=> 38,
		'opera'	=> 75,
		'ballet-and-dance'	=> 60,/***combine ballet and dance 60 & 82 **/
		'off-broadway'	=> 32,
	);
	$cat_other = array(
		'las-vegas-shows'	=> 99,
		'fairs-festiavls'	=> 58,
		'circus'	=> 59,
		'magic-shows'	=> 72,
		'lecture'	=> 92,
	);
?>
<?php
			//require_once 'vendor/autoload.php';

			use MaxMind\Db\Reader;

			$ipAddress = $_SERVER['REMOTE_ADDR'];
			$databaseFile = app_path().'/Includes/GeoLite2-City.mmdb';
			
			$reader = new Reader($databaseFile);
			$ipArray = $reader->get($ipAddress);
			//$userCity =  $ipArray['city']['names']['en'];
			//print_r($ipArray['city']['names']['en']);
			//print_r($reader->get($ipAddress));
			$userCity = $city;
			$userCityString = 'city="'. $userCity . '"';
			//$userNotInCityString = 'city!="' . $userCity . '"';
			//print_r($userCityString);
			$reader->close();
			$todaysDate = "\"" . date("m-d-Y") . "\"";
			$todaysDateString = "Date > DateTime(" . $todaysDate . ")";
			$tomorrowsDate = "\"" . date("m-d-Y", strtotime("tomorrow")) . "\"";
			$tomorrowsDateString = "Date < DateTime(" . $tomorrowsDate . ")";
			$tomorrowsDateString2 = "Date > DateTime(" . $tomorrowsDate . ")";
			$dayAfterTomorrowDate = "\"" . date("m-d-Y", strtotime("tomorrow +1day")) . "\"";
			$dayAftterTomorrowDateString = "Date < DateTime(" . $dayAfterTomorrowDate . ")";
			$nearZip = '60647';
			$test = "Date < DateTime(\"01-16-2019\")";
			$dateOrderByClause = "'orderByClause' => 'Date'";
			$dateId = date("w");
			if($dateId == 1){
				$weekendStartDate = "\"" . date("m-d-Y", strtotime("today +3day")) . "\"";
				$weekendEndDate = "\"" . date("m-d-Y", strtotime("today +6day")) . "\"";
			}
			elseif($dateId == 2){
				$weekendStartDate = "\"" . date("m-d-Y", strtotime("today +2day")) . "\"";
				$weekendEndDate = "\"" . date("m-d-Y", strtotime("today +5day")) . "\"";
			}
			elseif($dateId == 3){
				$weekendStartDate = "\"" . date("m-d-Y", strtotime("today +1day")) . "\"";
				$weekendEndDate = "\"" . date("m-d-Y", strtotime("today +4day")) . "\"";
			}
			elseif($dateId == 4){
				$weekendStartDate = "\"" . date("m-d-Y", strtotime("today")) . "\"";
				$weekendEndDate = "\"" . date("m-d-Y", strtotime("today +3day")) . "\"";
			}
			elseif($dateId == 5){
				$weekendStartDate = "\"" . date("m-d-Y", strtotime("yesterday")) . "\"";
				$weekendEndDate = "\"" . date("m-d-Y", strtotime("today +2day")) . "\"";
			}
			elseif($dateId == 6){
				$weekendStartDate = "\"" . date("m-d-Y", strtotime("yesterday")) . "\"";
				$weekendEndDate = "\"" . date("m-d-Y", strtotime("today +1day")) . "\"";
			}
			elseif($dateId == 0){
				$weekendStartDate = "\"" . date("m-d-Y", strtotime("yesterday")) . "\"";
				$weekendEndDate = "\"" . date("m-d-Y", strtotime("today")) . "\"";
			}
			$weekendStartDateString = "Date > DateTime(" . $weekendStartDate . ")";
			$weekendEndDateString = "Date  < DateTime(" . $weekendEndDate . ")";
		?>
		<?php
		if(isset($_GET['keyword']) && !isset($_GET['dateFilter'])){
			$searchKeyword = $_GET['keyword'];
			$dateFilter = null;
			$searchEventArray = array('websiteConfigID' => WEB_CONF_ID, 'searchTerms' => $searchKeyword, 'whereClause' => $userCityString, 'orderByClause' => 'Date');
				$searchEventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'searchTerms' => $searchKeyword, 'orderByClause' => 'Date');
		}
		elseif(isset($_GET['keyword']) && isset($_GET['dateFilter'])){
			$searchKeyword = $_GET['keyword'];
			$dateFilter = $_GET['dateFilter'];
			if($dateFilter == 'today'){
				
				$searchEventArray = array('websiteConfigID' => WEB_CONF_ID, 'searchTerms' => $searchKeyword, 'whereClause' => $userCityString . ' AND ' . $todaysDateString . ' AND ' . $tomorrowsDateString , 'orderByClause' => 'Date');
			$searchEventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'searchTerms' => $searchKeyword, 'whereClause' => $todaysDateString . ' AND ' . $tomorrowsDateString, 'orderByClasue' => 'Date');
			}
			elseif($dateFilter == 'tomorrow'){
				
				$searchEventArray = array('websiteConfigID' => WEB_CONF_ID, 'searchTerms' => $searchKeyword, 'whereClause' => $userCityString . ' AND ' . $tomorrowsDateString2 . ' AND ' . $dayAfterTomorrowDateString , 'orderByClause' => 'Date');
			$searchEventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'searchTerms' => $searchKeyword, 'whereClause' => $tomorrowsDateString2 . ' AND '  . $dayAfterTomorrowDateString, 'orderByClasue' => 'Date');
			}
			elseif($dateFilter == 'weekend'){
				$searchEventArray = array('websiteConfigID' => WEB_CONF_ID, 'searchTerms' => $searchKeyword, 'whereClause' => $userCityString . ' AND ' . $weekendStartDateString . ' AND ' . $weekendEndDateString , 'orderByClause' => 'Date');
			$searchEventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'searchTerms' => $searchKeyword, 'whereClause' => $weekendStartDateString . ' AND ' . $weekendEndDateString, 'orderByClasue' => 'Date');
			}
		}
		else if(isset($_GET['category'])){
			$searchCategory = $_GET['category'];
			if($searchCategory == 'sports'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'parentCategoryID' => 1,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'parentCategoryID' => 1);
			}
			elseif($searchCategory == 'concerts'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'parentCategoryID' => 2,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'parentCategoryID' => 2);
			}
			elseif($searchCategory == 'arts-and-theater'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'parentCategoryID' => 3,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'parentCategoryID' => 3);
			}
			elseif($searchCategory == 'other-tickets'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'parentCategoryID' => 4,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'parentCategoryID' => 4);
			}
			elseif($searchCategory == 'country'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 23,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 23);
			}
			elseif($searchCategory == 'pop'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 62,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 62);
			}
			elseif($searchCategory == 'rock'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 61,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 61);
			}
			elseif($searchCategory == 'rap-hip-hop'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 36,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 36);
			}
			elseif($searchCategory == 'comedy'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 24,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 24);
			}
			elseif($searchCategory == 'r-and-b'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 45,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 45);
			}
			elseif($searchCategory == 'children-and-family'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 55,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 55);
			}
			elseif($searchCategory == 'alternative'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 22,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 22);
			}
			elseif($searchCategory == 'festival-tour'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 100,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 100);
			}
			elseif($searchCategory == 'jazz-blues'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 21,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 21);
			}
			elseif($searchCategory == 'latin'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 73,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 73);
			}
			elseif($searchCategory == 'classical'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 49,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 49);
			}
			elseif($searchCategory == 'holiday'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 86,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 86);
			}
			elseif($searchCategory == 'nfl'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 65, 'grandchildCategoryID' => 32, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 65, 'grandchildCategoryID' => 32);
			}
			elseif($searchCategory == 'nba'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 66, 'grandchildCategoryID' => 30, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 66, 'grandchildCategoryID' => 30);
			}
			elseif($searchCategory == 'ncaaf'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 65, 'grandchildCategoryID' => 17, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 65, 'grandchildCategoryID' => 17);
			}
			elseif($searchCategory == 'ncaab'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 66, 'grandchildCategoryID' => 17, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 66, 'grandchildCategoryID' => 17);
			}
			elseif($searchCategory == 'mlb'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 63, 'grandchildCategoryID' => 16, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 63, 'grandchildCategoryID' => 16);
			}
			elseif($searchCategory == 'nhl'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 68, 'grandchildCategoryID' => 19, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 68, 'grandchildCategoryID' => 19);
			}
			elseif($searchCategory == 'soccer'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 71, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 71);
			}
			elseif($searchCategory == 'wwe'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 39, 'grandchildCategoryID' => 26, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 39, 'grandchildCategoryID' => 26);
			}
			elseif($searchCategory == 'pga'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 67, 'grandchildCategoryID' => 18, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 67, 'grandchildCategoryID' => 18);
			}
			elseif($searchCategory == 'nascar'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 69, 'grandchildCategoryID' => 187, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 69, 'grandchildCategoryID' => 187);
			}
			elseif($searchCategory == 'mma'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 101, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 101);
			}
			elseif($searchCategory == 'boxing'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 50, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 50);
			}
			elseif($searchCategory == 'tennis'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 66, 'grandchildCategoryID' => 17, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 66, 'grandchildCategoryID' => 17);
			}
			elseif($searchCategory == 'broadway'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 70, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 70);
			}
			elseif($searchCategory == 'children-family'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 97, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 97);
			}
			elseif($searchCategory == 'musical-play'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 38, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 38);
			}
			elseif($searchCategory == 'opera'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 75, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 75);
			}
			elseif($searchCategory == 'ballet-and-dance'){
				$eventArray = array_merge(array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 60, 'cityZip' => $userCity),array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 82, 'cityZip' => $userCity));
				$eventArrayAll = array_merge(array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 60),array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 82));
			}
			elseif($searchCategory == 'off-broadway'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 32, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 32);
			}
			elseif($searchCategory == 'las-vegas-shows'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 99, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 99);
			}
			elseif($searchCategory == 'fairs-festivals'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 58, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 58);
			}
			elseif($searchCategory == 'circus'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 59, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 59);
			}
			elseif($searchCategory == 'magic-shows'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 72, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 72);
			}
			elseif($searchCategory == 'lecture'){
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 92, 'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => 92);
			}
			/*
			$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $searchCategory,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $searchCategory);
				*/
			/*
			if(array_key_exists($searchCategory, $main_cat_array)){
				$mainCategory = $main_cat_array[$searchCategory];
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'parentCategoryID' => $mainCategory,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'parentCategoryID' => $mainCategory);
			}
			/*
			elseif(array_key_exists($searchCategory, $cat_concerts)){
				$childCategory = $cat_concerts[$searchCategory];
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $childCategory,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $childCategory);
			}
			*/
			/*
			elseif(array_key_exists($searchCategory, $cat_sports)){
				if($searchCategory == 'nba'){
					$childCategory = 30;
					$sportParentCategory = 66;
					$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $sportParentCategory, 'grandchildCategoryID' => $childCategory ,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $sportParentCategory, 'grandchildCategoryID' => $childCategory );				}
				elseif($searchCategory == 'ncaab'){
					$childCategory = 17;
					$sportParentCategory = 66;
					$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $sportParentCategory, 'grandchildCategoryID' => $childCategory ,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $sportParentCategory, 'grandchildCategoryID' => $childCategory );
				}
				elseif($searchCategory == 'nfl'){
					$childCategory = 32;
					$sportParentCategory = 65;
					$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $sportParentCategory, 'grandchildCategoryID' => $childCategory ,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $sportParentCategory, 'grandchildCategoryID' => $childCategory );
				}
				elseif($searchCategory == 'ncaaf'){
					$childCategory = 17;
					$sportParentCategory = 65;
					$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $sportParentCategory, 'grandchildCategoryID' => $childCategory ,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $sportParentCategory, 'grandchildCategoryID' => $childCategory );
				}
				else{
				$childCategory = $cat_sports[$searchCategory];
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $childCategory,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $childCategory);
				}
			} 
			elseif(array_key_exists($searchCategory, $cat_arts_theater)){
				$childCategory = $cat_concerts[$searchCategory];
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $childCategory,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $childCategory);
			}
			elseif(array_key_exists($searchCategory, $cat_other)){
				$childCategory = $cat_other[$searchCategory];
				$eventArray = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $childCategory,'cityZip' => $userCity);
				$eventArrayAll = array('websiteConfigID' => WEB_CONF_ID, 'childCategoryID' => $childCategory);
			}
			*/
		}
		else{
			$searchKeyword = 'all';
		}

		?>
		
	<div class="container search-results">

		<div class="results-container-col">
		<div id="search-results-nearby">
			<?php 
			if(isset($_GET['keyword'])){ ?>
				<h2>Search results for <span style="font-style:italic;">"<?php echo $searchKeyword; ?>"</span> near <?php echo $userCity; ?></h2>
				<label>Sort By</label>
				<select>
					<option>Date</option>
					<option>Distance</option>
				</select>
				<?php searchEvents($searchEventArray); 

			?>
			
			<?php
			}
			elseif(isset($_GET['category'])){ ?>
				<h2>Search results for <span style="font-style:italic;">"<?php echo $searchCategory; ?>"</span> near <?php echo $userCity; ?></h2>
				<label>Sort By</label>
				<select>
					<option>Date</option>
					<option>Distance</option>
				</select>
				<?php getEvents($eventArray); 

			} 
			?>
		</div>

		<div id="search-results-all">
			
				
			<?php 
			if(isset($_GET['keyword'])){ ?>
				<h2 style="margin-top:50px;">All results for <span style="font-style:italic;">"<?php echo $searchKeyword; ?>"</span></h2>
				<label>Sort By</label>
				<select>
					<option>Date</option>
					<option>Distance</option>
				</select>
				<?php searchEvents($searchEventArrayAll); 
			}
			elseif(isset($_GET['category'])){ ?>
				<h2>Search results for <span style="font-style:italic;">"<?php echo $searchCategory; ?>"</span></h2>
				<label>Sort By</label>
				<select>
					<option>Date</option>
					<option>Distance</option>
				</select>
				<?php getEvents($eventArrayAll); 

			} 
			?>
		</div>
	</div>
		<div class="search-filters">
			<form action="">
				<h2>Filters</h2>
				<!--<div class="location-dropdown">
					<label>Location</label>
					<select>
						<option value="current location"><?php echo $userCity; ?></option>
					</select>
				</div>-->
				<div class="location-dropdown">
					<label style="margin-bottom:15px;">Location</label>
                @if($state) 
                    <a id="user-location">{{ $city }}, {{ $state }}</a>
                @else
                    <a id="user-location">{{ $city }}, {{ $country }}</a>
                @endif
                <div id="location-dropdown">
                    <button id="current-location">Get Current Location</button>
                    <a id="city-input-toggle">Enter City</a>
                    <div id="city-input-container">
                            <p id="close-btn">&times;</p>
                            <label for="city-input" required>City*</label>
                            <input type="text" placeholder="Enter city" id="city-input">
                            <p id="nav-error-message">The city name is invalid.</p>
                            <label for="state-input">State</label>
                            <input type="text" placeholder="Enter state" id="state-input">
                            <button type="submit" id="change-location">Change Location</button>
                    </div>
                </div>
            </div>
				<div class="date-filter">
					<label>When</label>
					<label>
						<input type="radio" name="date" id="all-dates" value="all-dates">
						<span>All Dates</span>
					</label>
					<label>
					<input type="radio" name="date" id="today" value="today">
					<span>Today</span>
					</label>
					<label>
						<input type="radio" name="date" id="tomorrow" value="tomorrow">
						<span>Tomorrow</span>
					</label>
					<label>
						<input type="radio" name="date" id="weekend" value="weekend">
						<span>This Weekend</span>
					</label>
				</div>
				<div class="category-filters">
					<label>Categories</label>
					<label>
						<input type="radio" name="categories" id="sports" value="sports">
						<span>Sports</span>
					</label>
					<label>
					<input type="radio" name="categories" id="art-theater" value="art-theater">
					<span>Art & Theater</span>
					</label>
					<label>
						<input type="radio" name="categories" id="concert" value="comedy">
						<span>Concerts</span>
					</label>
					<label>
						<input type="radio" name="categories" id="other" value="other">
						<span>Other</span>
					</label>
				</div>
			</form>
		</div>
	</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			
				$(document).ready(function(){
					var currentUri = location.href;
					function updateQueryStringParameter(uri,key,value){
						var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
						var seperator = uri.indexOf('?') !== -1 ? "&" : "?";
						if(uri.match(re)){
							return uri.replace(re, '$1' + key + "=" + value + '$2');
						}
						else{
							return uri + seperator + key + "=" + value;
						}
					}
					function removeQueryStringParamter(uri,key,value){
						var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
						var seperator = uri.indexOf('?') !== -1 ? "&" : "?";
						if(uri.match(re)){
							return uri.replace(re,)
						}
					}
						$('#sports').click(function(){
								var newUri = updateQueryStringParameter(currentUri, 'catFilter', '1');
								location.href = newUri;
								//window.location = location.href += '&catFilter=1';
						});
						$('#art-theater').click(function(){
							var newUri = updateQueryStringParameter(currentUri, 'catFilter', '3');
							location.href = newUri;
								//window.location = location.href += '&catFilter=3';
						});
						$('#concert').click(function(){
							var newUri = updateQueryStringParameter(currentUri, 'catFilter', '2');
							location.href = newUri;
								//window.location = location.href += '&catFilter=2';
						})
						$('#other').click(function(){
							var newUri = updateQueryStringParameter(currentUri, 'catFilter', '4');
							location.href = newUri;
								//window.location = location.href += '&catFilter=4';
						});
					
					$('#all-dates').click(function(){
						var newUri = removeQueryStringParameter(currentUri, 'dateFilter', 'all');
						location.href = newUri;
						//window.location = location.href += '&dateFilter=all';
					});
					$('#today').click(function(){
						var newUri = updateQueryStringParameter(currentUri, 'dateFilter', 'today');
						location.href = newUri;
						//window.location = location.href += '&dateFilter=today';
					});
					$('#tomorrow').click(function(){
						var newUri = updateQueryStringParameter(currentUri, 'dateFilter', 'tomorrow');
						location.href = newUri;
						//window.location = location.href += '&dateFilter=tomorrow';
					});
					$('#weekend').click(function(){
						var newUri = updateQueryStringParameter(currentUri, 'dateFilter', 'weekend');
						location.href = newUri;
						//window.location = location.href += '&dateFilter=weekend';
					});
				});	

			// if local storage values exist, replace the location in nav with it
    if (window.localStorage.getItem('city')) {
        var userCity = window.localStorage.getItem('city');
        var userState = window.localStorage.getItem('state');
        var userCountry = window.localStorage.getItem('country');
        !!userState ? $('.search-filters #user-location').html(`${userCity}, ${userState}, ${userCountry}`) : $('.search-filters #user-location').html(`${userCity}, ${userCountry}`);
    }
    // CURRENT LOCATION FINDER
    $('.search-filters #current-location').click(function(e){
        e.preventDefault();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        jQuery.ajax({
            url: "{{ url('/currentlocation') }}",
                  method: 'post',
                  data: {
                     _token: CSRF_TOKEN,
                  },
                  success: function(result){
                      // close the div
                      $('.search-filters #location-dropdown').hide();
                      // reflect it in the navigation
                      if (result['state']) {
                        $('.search-filters #user-location').html(result['city'] + ', ' + result['state'] + ', ' + result['country']);
                      } else {
                        $('.search-filters #user-location').html(result['city'] + ', ' + result['country']);
                      }
                      // store in local storage
                      window.localStorage.setItem('city', result['city']);
                      window.localStorage.setItem('country', result['country']);
                      if (result['state']) {
                          window.localStorage.setItem('state', result['state']);
                      }
                  }
                     
        });
    });
    // EDIT LOCATION DROPDOWN
    // open and close dropdown on click
    $('.search-filters #user-location').click(function(){
        $('.search-filters #location-dropdown').toggle();
    });
    // INPUT LOCATION FINDER
    // open finder on click
    $('.search-filters #city-input-toggle').click(function(){
        $('.search-filters #city-input-container').show();
    });
    // close finder on click
    $('.search-filters #close-btn').click(function(){
        $('.search-filters #city-input-container').hide();
    })
    // functionality
    $('.search-filters #change-location').click(function(e){
        e.preventDefault();
        var cityInput = $('.search-filters #city-input').val();
        var stateInput = $('.search-filters #state-input').val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        jQuery.ajax({
            url: "{{ url('/inputlocation') }}",
                  method: 'post',
                  data: {
                     _token: CSRF_TOKEN,
                     'cityInput': cityInput,
                     'stateInput': stateInput,
                  },
                  success: function(result){
                        if (result['city']) {
                            // reflect it in the navigation
                            if (result['state']) {
                                $('.search-filters #user-location').html(result['city'] + ', ' + result['state'] + ', ' + result['country']);
                            } else {
                                $('.search-filters #user-location').html(result['city'] + ', ' + result['country']);
                            }
                            // store in local storage
                            window.localStorage.setItem('city', result['city']);
                            window.localStorage.setItem('country', result['country']);
                            if (result['state']) {
                                window.localStorage.setItem('state', result['state']);
                            }
                            // close div and remove any error indications
                            $('.search-filters #nav-error-message').hide();
                            $('.search-filters #city-input').removeClass('error-input');
                            $('.search-filters #city-input-container').hide();
                            $('.search-filters #location-dropdown').hide();
                        } else {
                            // display error message and error styling
                            $('.search-filters #nav-error-message').show();
                            $('.search-filters #city-input').addClass('error-input');
                        }
                  }
        });
    });
		</script>
@endsection
