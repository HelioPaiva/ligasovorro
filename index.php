<?php
require_once('functions-cadastro.php');
index();
valorPremio();
$valor = count($cadastros);
$rodada = 1;
$pontosTotal = $rodada * 3
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

  <?php $total = ($cadastro['total'] * 50); ?>
  <center>
    <label>Total Arrecadado: R$ <?php echo number_format($total,'2',',','.'); ?></label>
  </center>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
         <th style="width: 10px; text-align: center">Rank</th>
         <th style="width: 150px;  text-align: center">Time</th>
         <th style="width: 100px; text-align: center">Pts</th>
         <th style="width: 100px; text-align: center">Pró</th>
         <th style="width: 100px; text-align: center">Contra</th>
         <!--<th style="width: 100px; text-align: center">Qtd 1º</th>-->
       </tr>
       <tbody>
         <?php if ($cadastros) : ?>
          <?php $r = 1; ?>
          <?php foreach ($cadastros as $cadastro) : ?>
            <tr>
             <?php if($r <= 8) { ?>
              <td style="text-align: center;vertical-align: middle; font-size: 16px; color: #1E90FF; font-weight: bold; ">
              <?php }else{ ?>
                <td style="text-align: center;vertical-align: middle; font-size: 16px; color: #363636; font-weight: bold; ">
                <?php }?>
                <?php echo $r.'º'; ?>
              </td>
              <td>
                <div style=" text-align: center;vertical-align: middle;">
                 <img src="<?php echo $cadastro['url_escudo_svg']; ?>" style="width: 40px; height: 40px;">
               </div>
               <div style="text-align: center;vertical-align: middle; margin-top: -30px; margin-left: 35px; position: relative;">
                <img style="border-radius: 50%;width: 30px; height: 30px;" id="foto" 
                src="
                <?php
                if($cadastro['facebook_id'] == ""){ 
                  echo $cadastro['foto_perfil'];
                  }else{
                    echo substr($cadastro['foto_perfil'],0,64);
                  } 
                  ?>
                  ">
                </div>
                <div style="text-align: center;vertical-align: middle;">
                 <b><?php echo $cadastro['nome']; ?></b></br><?php echo $cadastro['nome_cartola']; ?>
               </div>
             </td>
             <td style="text-align:	center;vertical-align: middle; font-weight: bold; font-size: 16px"><?php echo $cadastro['pontos'];  ?></td>
             <td style="text-align: center;vertical-align: middle;"><?php if(is_null($cadastro['pontos_pro']) ==true){echo '0.00';}else{echo $cadastro['pontos_pro'];};?></td>
             <td style="text-align: center;vertical-align: middle;"><?php if(is_null($cadastro['contra']) == true){echo '0.00';}else{echo $cadastro['contra'];};?></td>
             <!--<td style="text-align: center;vertical-align: middle;">20.00</td>-->
           </tr>
           <?php $r = $r + 1; ?>
         <?php endforeach; ?>
       <?php endif; ?>
     </tbody>
   </table>
 </div>
</body>
</html>
