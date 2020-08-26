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

if ($result = $conn->query("SELECT * FROM cache_of_parsing_result WHERE number_of_offers > 0")) {
    /* determine number of rows result set */
    $p1 = $result->num_rows;
    /* close result set */
    $result->close();
}
##"p2" повинна містити кількість стрічок в яких 'number_of_competitors' > 0
			
if ($result = $conn->query("SELECT * FROM cache_of_parsing_result WHERE number_of_competitors > 0")) {
    /* determine number of rows result set */
    $p2 = $result->num_rows;
    /* close result set */
    $result->close();
}
			
##"p3" повинна містити кількість стрічок в яких  number_of_competitors > 0  і  price_position_in_the_price_ranking = number_of_competitors
			
if ($result = $conn->query("SELECT * FROM cache_of_parsing_result WHERE number_of_competitors > 0 AND price_position_in_the_price_ranking = number_of_competitors")) {
    /* determine number of rows result set */
    $p3 = $result->num_rows;
    /* close result set */
    $result->close();
}

$conn->close();

// Результат має бути в вигляді 1 стрічки!! 
// 		Наприклад:
// 			| p1 |  p2 | p3 |
// 			-----------------	
// 			| 15 |  32 | 9  |


printf("| %s | %s | %s |\n", 'p1', 'p2', 'p3'); 
printf("%'=16s\n", '='); 
printf("| %u | %u | %u |\n", $p1, $p2, $p3); 
