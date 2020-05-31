<?php

error_reporting(0);
//ini_set('display_errors', 0);

  if(isset($_POST["submit"])){
     $benef=htmlentities(trim($_POST["benef"]));
     $code=htmlentities(trim($_POST["code"]));
     $exec = $_POST["exec"];
     //$iniat=$_POST("iniat");
     /* Creation des donnees */
     $data =[
         'params'  => 'productOrdering',
         'productId'  => $code,
         'operation'  => 'add',
         'userConcerned'  => $benef,
         'userInitiator'  => '07070850'         
        ];
        

        /* Creation des options de contexte */
        $options =[
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/json",
                'ignore_errors' => true,
                'timeout' =>  2000,
                'content' => json_encode($data)]
                ,
            ];
            
            /* Creation du contexte HTTP */
            $context  = stream_context_create($options);
            for($i=0;$i<$exec;$i++)
            {
            /* Execution de la requete */

            $vu = file_get_contents('https://espaceclient.orange.ci/request/api', false, $context);
         }
            $obj= json_decode($vu);

            $donn=json_decode( $obj->data);
               if($donn->state=="completed")
                  {
                     echo (" <i style=\"color:green\"> Donnée <b>".$code." X ".$exec."</b> envoyé avec succès au <b> ".$benef."</b></br></i>");
                  }
               else
                  {
                     echo "<pre>";
                     echo "<p class=\"text-left text-danger\">Echec de l'operation  du à </br>".$donn->description."</p>" ;
                     //echo "<b style=\"color:red\">Echec de l'operation  du à </b>".$obj->data->description;
                     echo "</pre>";
                  }

      }
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="/assets/bootstrap.min.css">
   <script src="assets/bootstrap.min.css"></script>
   <title>ENVOI PUBLIC</title>
</head>

<style>
   form input{
      border:2px gray solid;margin-top: 13px;
      border-radius: 3px;
      width: auto;
      height:  30px;
   }  

</style>
<body>
   <div class="container ">
         
   <form action="" method="POST">
      <table>
         <tbody>

         <tr>
            <td>Forfait</td>
            <td><input type="text" name="code" id=""></td>
         </tr>
         <tr>
            <td>Numéro</td>
            <td><input type="text" name="benef"  maxlength="8" id=""></td>
         </tr>
         <tr>
            <td>Repetition</td>
            <td><input type="text" name="exec" id=""></td>
         </tr>
         </tbody>
        
      </table>
      <button type="submit" class="text-center btn btn-danger" name="submit">Valider</button>
   </form>

   </div>
</body>
</html>