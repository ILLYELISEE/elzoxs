   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INFORMATION UTILISATEUR</title>
</head>
<body>
    <form class="form-group" action="" method="post">
        <input type="text" name="numero"  maxlength="8" id="" autofocus>
        <input type="submit" name="envoi" value="envoyer">
    </form>
</body>
</html>

<?php


error_reporting(1);
$numero = $_POST["numero"];
if(isset($numero)){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://espaceclient.orange.ci/request/api/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\"params\":\"productInventory\",\"publicKey\":\"".$numero."\"}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Cookie: wassup=B64NTQ2ODAxRTI2NzA1MjdDMkUyRTU4QkI0MjNDNTNFMzFWPVY2ICAgIDkyMDgwMDhhMDAwMDAwYTAwMGQ4ODAwMDAwNTgwMDAwMDAwMDAwNTg2L3lUdkwybHl5M2N0Q0VXekdJVmpJSmw3Nk1VaS9ndFZIMVhnejZNNU9aa3Y5Ni8yUS9tRzVRd3YrQUhTaENUcGZVQlhsamt1Q1B0ak9aSm9qUWxaalhDaTRoUmNOWDhFbm4xL2ZFOVh1ajJ0VWhwaldzYWoxWlZCRWZBQUUvb2czVlc2WW54ODhhbnNrR2s2SmgrWFMzWWcvQVBkTEpKZHhiVDFVQ0FNVEdPcFozbUd5RFVrUXdJQWdZSDVmSEtGYit0M0VxTldFTFl0VjdPSGJpUHVBPT18TUNPPU9DSXxWPVY2fFhfV0FTU1VQX1NZTkNfQ09PS0lFPTk3MDc5NHxYX1dBU1NVUF9WQUxJRF9EQVRFPTIwMjAwNTIwMDMzMDAwfGFvbD0xMHx3Y3Q9Mg==; BIGipServerpool_waf1_aviso_80=1224976576.20480.0000"
  ),
));

$response = curl_exec($curl);
$data= json_decode ($response)->data;
$getData= json_decode($data);

/* for ($i=0;$i<count($getData);$i++)  {
    $caract = $getData[$i]->productCharacteristic;
    foreach ($caract as $key) {
        echo "<pre>";
        print_r ("<b>$key->name </b> $key->value");
        echo "</pre>";
   
    }} */
    for ($i=0;$i<count($getData);$i++)  {
        $data_inside = $getData[$i];
        echo "<pre>";
        print_r("$data_inside->name  $data_inside->status");
        echo "</pre>";
        $caract = $getData[$i]->productCharacteristic;
    foreach ($caract as $key) {
        echo "<pre>";
        print_r ("<b>$key->name </b> $key->value");
        echo "</pre>";
    }}
         
curl_close($curl);
}
?>