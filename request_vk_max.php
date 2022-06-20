<?php
require_once("grant.php");
require_once("config.php");

function getAge($b) {
    $a = explode(".", $b);
    if($a[1] > date('m') || $a[1] == date('m') && $a[0] > date('d'))
      return (date('Y') - $a[2] - 1);
    else
      return (date('Y') - $a[2]);
}

$result = [];
$members = [];
$member = [];
$group_id = GROUP_TEST_ID;
$fields = implode(",",[BDATE,CITY,COUNTRY]);

$request_params = array(
    'access_token' => TOKEN,
    'v' => V
);
$get_params = http_build_query($request_params);

$code = urlencode('
        var partMembers = [];
        var result = [];
        var iter = 25;
        var offset = 0;
        var stepOffset = 1000;
        var countRec = iter * stepOffset;
        //if(stepOffset == null){stepOffset = 1000;}
        //if(offset == null){offset = 0;}

while (iter != 0 && offset < countRec ) {
    iter = iter - 1;
    partMembers = API.groups.getMembers({"group_id":"'.$group_id.'", "fields":"'.$fields.'","offset":offset});
    countRec = partMembers.count;
    result.push(partMembers);
    offset = offset + stepOffset;
}
    return result;
');

$result = file_get_contents(URL_API.EXECUTE.$code."&".$get_params);
$result = json_decode($result, false);

$count = $result->response[0]->count;
print_r("Количество записей = ".$count."<br>");

for ($i=0;$i<count($result->response);$i++){

$temp = $result->response[$i]->items;
    foreach ($temp as $value) {
        $member['first_name'] = $value->first_name;
        $member['last_name'] = $value->last_name;
        $member['bdate'] = $value->bdate;
        $member['age'] = getAge($value->bdate);
        $member['city'] = $value->city->title;
        $member['country'] = $value->country->title;
        $members [] = $member;
        /*
        print_r($value->first_name."<br>");
        print_r($value->last_name."<br>");
        print_r($value->bdate."<br>");
        $age = explode(".", $value->bdate);
        print_r(getAge($age[2],$age[1],$age[0])." полных лет.  <br>");
        print_r(explode(".", $value->bdate)."<br>");
        print_r($value->city->title."<br>");
        print_r($value->country->title."<br>");
        */
    }

}

echo"<pre>";
print_r(gettype($members));
echo"</pre>";

?>
