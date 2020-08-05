<?php
require_once('functions-parciais.php');
index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Liga Sovorro</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style type="text/css">

  </style>
</head>
<body style="background-color: #FFFFFF; padding-top: 50px;">
 <?php  include 'menu.php'; ?>

<div class="table-responsive">
  <table class="table" border="1">
    <thead>
      <tr><td colspan="3" style="text-align: center;">1º Rodada</td></tr>
      <tr>
       <th style="width: 10px; text-align: center">
             <div style=" text-align: center;vertical-align: middle;">
               <img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_134/escudo/a4/47/27/00079c2fcc-1495-40c7-8c58-3c5bea9d47a420190403224727" style="width: 40px; height: 40px;">
             </div>
             <div style="text-align: center;vertical-align: middle; margin-top: -30px; margin-left: 35px; position: relative;">
               <img style="border-radius: 50%;width: 30px; height: 30px;" id="foto" src="https://graph.facebook.com/v2.2/234000320134394/picture?width=100&amp">
             </div>
             <b><?php echo 'Power2020'; ?></b></br>
             
             <b><h2 style="color: #32CD32"><?php echo '0.00'// $cadastro['pontos_pro'] ;?></h2></b>
       </th>

       <th style="width: 150px;  text-align: center"></th>

       <th style="width: 100px; text-align: center">
          <div style=" text-align: center;vertical-align: middle;">
               <img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_134/escudo/a4/47/27/00079c2fcc-1495-40c7-8c58-3c5bea9d47a420190403224727" style="width: 40px; height: 40px;">
             </div>
             <div style="text-align: center;vertical-align: middle; margin-top: -30px; margin-left: 35px; position: relative;">
               <img style="border-radius: 50%;width: 30px; height: 30px;" id="foto" src="https://graph.facebook.com/v2.2/234000320134394/picture?width=100&amp">
             </div>
             <b><?php echo 'Power2020'; ?></b></br>
             
             <b><h2 style="color: #32CD32"><?php echo '0.00'// $cadastro['pontos_pro'] ;?></h2></b>
       </th>
       <!--<th style="width: 100px; text-align: center">Pró</th>
       <th style="width: 100px; text-align: center">Contra</th>-->
       <!--<th style="width: 100px; text-align: center">Qtd 1º</th>-->
     </tr>
     <tbody>
       <?php //if ($cadastros) : ?>
        <?php for ($i=0; $i <= 12; $i++) :  
          # code...
        //foreach ($cadastros as $cadastro) : ?>
          <tr>
            <td style="text-align: center;">
              <img src="https://s.glbimg.com/es/sde/f/2018/05/07/98bee57585b8dde8e58e642b147a3a11_140x140.png"  style="width: 60px; height: 60px;"></br>
              <?php echo 'Fábio Santos'; ?></br>
              <b style="color: #32CD32"><?php echo '0.00'// $cadastro['pontos_pro'] ;?></b>
           </td>
            <td></td>
           <td style="text-align: center;">
             <img src="https://s.glbimg.com/es/sde/f/2018/05/07/98bee57585b8dde8e58e642b147a3a11_140x140.png"  style="width: 60px; height: 60px;"></br>
              <?php echo 'Fábio Santos'; ?></br>
              <b style="color: #32CD32"><?php echo '0.00'// $cadastro['pontos_pro'] ;?></b>   
                      </td>
           <!--<td><?php echo '0'// $cadastro['pontos_pro'] ;?></td>
           <td><?php echo '0.00'//$cadastro['contra'] ;?></td>-->
           <!--<td style="text-align: center;vertical-align: middle;">20.00</td>-->
         </tr>
       <?php endfor; ?>
     <?php //endif; ?>
   </tbody>
 </table>
</div>



</body>
</html>
