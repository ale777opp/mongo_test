<?php
require_once("grant.php");
require_once("config.php");
//**************************
$user_id = TEST_ID;
$fields = [BDATE,CITY,COUNTRY];

$request_params = array(
    'access_token' => TOKEN,
    'user_ids' => $user_id,
    'fields' => $fields,
    'v' => V
);

$get_params = http_build_query($request_params);

$result = json_decode(file_get_contents(URL_API.USER_GET.$get_params));
echo"<pre>";
print_r("Фамилия -- ".$result->response[0]->first_name." <br>");
print_r("Имя -- ".$result->response[0]->last_name." <br>");
print_r("День рождения -- ".$result->response[0]->bdate." <br>");
print_r("Город -- ".$result->response[0]->city->title." <br>");
print_r("Страна -- ".$result->response[0]->country->title." <br>");
echo"</pre>";


echo"<pre>";var_export($result);echo"</pre>";

/* для работы сгруппой

$group_id = GROUP_TEST_ID;
$fields = [BDATE,'city','country'];

$request_params = array(
    'access_token' => TOKEN,
    'group_id' => $group_id,
    'fields' => BDATE,
   'fields' => 'city',
  // 'fields' => 'country',
    'v' => V
);

$get_params = http_build_query($request_params);
echo"<pre>";
print_r($get_params);
echo"<pre>";
$result = json_decode(file_get_contents(URL_API.MEMBERS_GET.$get_params));
echo"<pre>";
print_r($result);
echo"<pre>";
*/

/*метод execute
//$user_id = TEST_ID;
//$fields = BDATE;

$group_id = GROUP_TEST_ID;
$fields = [BDATE,'city','country'];

$request_params = array(
    'access_token' => TOKEN,
    'v' => V
);

$get_params = http_build_query($request_params);

$code = urlencode('return API.groups.getMembers(
    {
        "group_id":"'.$group_id.'",
        "fields":"'.$fields.'"
    });
');

$result = json_decode(file_get_contents(URL_API.EXECUTE.$code."&".$get_params));
echo"<pre>";
print_r($result);
echo"</pre>";
*/
?>





