<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'conf.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// prepare and bind

$stmt = $conn->prepare("INSERT INTO cache_of_parsing_result (cdate, mdate, user_id, feed_products__id,  number_of_offers, number_of_ads_without_status, number_of_competitors, min_price_of_competitors, avg_price_of_competitors, difference_relative_to_average_price, difference_relative_to_minimum_price, price_position_in_the_price_ranking, number_of_unrecognized_ads) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);");

$stmt->bind_param('iiiiiiiiiiiii', $cdate, $mdate, $user_id, $feed_products__id,  $number_of_offers, $number_of_ads_without_status, $number_of_competitors, $min_price_of_competitors, $avg_price_of_competitors, $difference_relative_to_average_price, $difference_relative_to_minimum_price, $price_position_in_the_price_ranking, $number_of_unrecognized_ads);

for ($i = 0; $i<100; $i++) {
   
    $cdate = idate('U');
    $mdate = idate('U');
    $user_id = mt_rand(1, 10); 
    $feed_products__id = mt_rand(1, 10);
    $number_of_offers = mt_rand(0, 10);
    $number_of_ads_without_status =  mt_rand(1, 4);
    $number_of_competitors = mt_rand(0, 10);
    $min_price_of_competitors = mt_rand(1, 10);
    $avg_price_of_competitors = mt_rand(1, 10);
    $difference_relative_to_average_price = mt_rand(1, 10);
    $difference_relative_to_minimum_price = mt_rand(1, 10);
    $price_position_in_the_price_ranking = mt_rand(0, 10);
    $number_of_unrecognized_ads = mt_rand(1, 10);
    $stmt->execute();
}

$stmt->close();
$conn->close();
