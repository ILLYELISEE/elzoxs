<?php
 error_reporting(0);
 ini_set('display_errors', 0);

 
 $num =htmlentities(trim(($_POST["numero"])))  ; 
 
 if(isset($num)&& !empty($num)){

     
     /* Creation des donnees */
     $data =[
         'params'  => 'usageCunsomptionReport',
         'publicKey'  => $num
         
        ];
        
        
        /* Creation des options de contexte */
        $options =[
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/json",
                'ignore_errors' => true,
                'timeout' =>  40,
                'content' => json_encode($data)]
                ,
            ];
            
            /* Creation du contexte HTTP */
            $context  = stream_context_create($options);
            
            /* Execution de la requete */
$vu = file_get_contents('https://espaceclient.orange.ci/request/api', false, $context);

$obj= json_decode($vu);

$donn= $obj->data;

$un = json_decode($donn);
print_r($un->message);

}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap.css">
    <script src="assets/bootstrap.js"></script>
    <title>Consulter son credit sur sa puce Orange</title>
</head>
<body>
<div class="container">
   <form  action="" method="POST" class="mt-2 ml-3">
 <table class=" form-group">
 <tr><td>Numero : <?= $num?></td></tr>
<?php
?>
<?php
foreach($un as $key){
      print_r( "Consommation du mois ".$key->bucket[0]->bucketCounter[0]->valueLabel);
    for($i=0;$i<count($key->bucket);$i++)
   {
      for($j=0;$j<count($key->bucket[$i]->bucketBalance);$j++){

?>
    <tr>     
        <td><?php print_r($key->bucket[$i]->name."  ".$key->bucket[$i]->bucketBalance[$j]->remainingValueLabel." Valable jusqu'au ".date("d-m-Y ", strtotime($key->bucket[$i]->bucketBalance[$j]->validFor->endDateTime )));?></td>
    </tr>
    <tr>
  
    </tr>
<?php

      }}
}?>

<tr><td><input type="phone" autofocus="" class ="formm-control" pattern="[0-9]{8}" maxlength="8" name="numero" id="" required></td></tr>
</table><button class="btn btn-success text-right" type="submit">Valider</button></form>

</div>
</body>
</html>