<?php

//echo extension_loaded("mongodb") ? "loaded\n" : "not loaded\n";

try {
/*
$bulk = new MongoDB\Driver\BulkWrite;

$document1 = '{"name":"Horny","dob":"new Date(1992,2,13,7,47)","loves":["carrot","papaya"],"weight":600,"gender":"m","vampires":63}';
$document2 = '{"name":"Aurora","dob":"new Date(1991, 0, 24, 13, 0)","loves":["carrot","grape"],"weight":450,"gender":"f","vampires":43}';
$document3 ='{"name":"Unicrom","dob":"new Date(1973, 1, 9, 22, 10)","loves":["energon","redbull"],"weight":984,"gender":"m","vampires":182}';
$document4 = '{"name":"Roooooodles","dob":"new Date(1979, 7, 18, 18, 44)","loves":["apple"],"weight":575,"gender":"m","vampires":99}';

$document1 = json_decode($document1, true);
$document2 = json_decode($document2, true);
$document3 = json_decode($document3, true);
$document4 = json_decode($document4, true);

$bulk->insert($document1);
$bulk->insert($document2);
$bulk->insert($document3);
$bulk->insert($document4);
*/
$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
//$result = $manager->executeBulkWrite('learn.unicorns', $bulk);

$query = new MongoDB\Driver\Query(array('name' => 'Unicrom'));
$cursor = $manager->executeQuery('learn.unicorns', $query);
echo"<pre>";
print_r($cursor->toArray());
echo"</pre>";

} catch (MongoConnectionException $e) {
 die('Error connecting to MongoDB server');
} catch (MongoException $e) {
 die('Error: ' . $e->getMessage());
}

?>