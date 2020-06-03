
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SERVICE</title>
</head>
<body>
	<form action="" name="form" method="POST">

  <table>
   
    <tr>
      <td>
    	<input type="submit" value="sentSms" name="appel" >		
      </td>
    </tr>
    
    <tr>
      <td>
      <input type="text" name="numero" id="">
      </td>
    </tr>
    
  </table>
	
		
		
	
	
	</form>
</body>
</html>

<?php


error_reporting(1);

$numero=$_POST["numero"];

$options=$_POST["appel"];
if(isset($numero)&&isset($options)){


$curl = curl_init();

$info=[
  "params"=>"usageLayerManagement",
  //  "type"=>"call",
  "type"=>"sentSms",
  "mobile"=>$numero,
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



$response = curl_exec($curl);


$data = json_decode($response);

$fo= json_decode($data->data);
foreach ($fo as $key) {
    $init = $key->usageCharacteristic[5]->value;
    $init = $key->usageCharacteristic[5]->value;
    $hours = floor($init / 3600);
    $minutes = floor(($init / 60) % 60);
    $seconds = $init % 60;

	/* print_r($key->description." le ".date("d/m/Y", strtotime($key->usageCharacteristic[6]->value))."</br>");
                print_r("Duree de l'appel ". $hours.":".$minutes.":".$seconds." </br>");
        echo "</br>";  */
    
    
        #print_r($key->description." le ".date("d/m/Y", strtotime($key->usageCharacteristic[6]->value))."</br>");
        echo "<pre>";
        print_r($key);
          
          echo "</pre>";
        
}
curl_close($curl);


}


?>