<?php
error_reporting(0);
$name=$_POST["submit"];
		$curl = curl_init();

$info=[
  "params"=>"usageLayerManagement",
  "mobile"=>$numero,
  //"mobile"=>"07070736",
  "type"=>$name,
  // "dateGte"=>"call",
  //"dateLte"=>"call", 
  "limit"=>999,
  "productRef"=>null
  
];

$json =json_encode($info);
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://espaceclient.orange.ci:443/request/api",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$json,
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Cookie: BIGipServerpool_waf1_aviso_80=1258531008.20480.0000"
  ),
));




if(isset($_POST["appel"]))
	{


$response = curl_exec($curl);
$data = json_decode($response);

$fo= json_decode($data->data);
foreach ($fo as $key) {
    $init = $key->usageCharacteristic[5]->value;
    $init = $key->usageCharacteristic[5]->value;
    $hours = floor($init / 3600);
    $minutes = floor(($init / 60) % 60);
    $seconds = $init % 60;

	print_r($key->description." le ".date("d/m/Y", strtotime($key->usageCharacteristic[6]->value))."</br>");
                print_r("Duree de l'appel ". $hours.":".$minutes.":".$seconds." </br>");
        echo "</br>"; 
          

        
}
curl_close($curl);

	}





?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SERVICE</title>
</head>
<body>
	<form action="" method="POST">
		<input type="submit" value="call" name="appel" >		
		<input type="submit" value="getSms" name="appel" >		
		<input type="submit" value="charging" name="appel" >		
		<input type="submit" value="purchasePass" name="appel" >		
		<input type="submit" value="subscriptionPass" name="appel" >		
		<input type="text" name="numero" id="">
		<button type="submit"></button>
	</form>
</body>
</html>
