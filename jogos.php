<?php
require_once('functions-jogos.php');
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

  <div class="container">



    <div class="table-responsive">
      <table class="table" border="0">
        <?php if ($jogos) : ?>
          <?php 
          $contador = 1;
          foreach ($jogos as $jogo) : 
            ?>
            <tbody>
              <?php if($contador == 1){?>
                <tr>
                  <td colspan="3" style="background-color:#00B9FF; color: white; text-align: center;">
                    <a name="<?php echo $jogo['rodada']; ?>"></a><?php echo $jogo['rodada'].'º '; ?> Rodada
                    <a href="#top" style="color: white;">topo</a>
                  </td>
                </tr>
              <?php };?>
              <tr>
                <td style="text-align: center;">
                  <img src="<?php echo $jogo['escudo_casa']; ?>" style="width: 40px; height: 40px;"></br>
                  <?php echo $jogo['time_casa']; ?></br>
                  <?php if ($jogo['parcila_casa'] < 0) { ?>
                    <b style="color: #FF0000"><?php //echo number_format($jogo['parcila_casa'],2,',','.');?></b>
                  <?php } else { ?>
                  <b style="color: #32CD32"><?php //echo number_format($jogo['parcila_casa'],2,',','.');?></b>
                  <?php }; ?>
                  <b style="color: #32CD32"><?php echo $jogo['pontos_casa'];?></b>
                </td>
                <td style="text-align: center;vertical-align: middle;">
                x</br>
                <!--<a href="parciais.php?id=<?php echo $jogo['id_jogo'];?>">-->Times<!--</a>-->
              </td>
              <td style="text-align: center;">
               <img src="<?php echo $jogo['escudo_visitante']; ?>"  style="width: 40px; height: 40px;"></br>
               <?php echo $jogo['time_visitante'] ?></br>
               <?php if ($jogo['parcila_visitante'] < 0) { ?>
                    <b style="color: #FF0000"><?php //echo number_format($jogo['parcila_visitante'],2,',','.');?></b>
                  <?php } else { ?>
                  <b style="color: #32CD32"><?php //echo number_format($jogo['parcila_visitante'],2,',','.');?></b>
                  <?php }; ?>
               <b style="color: #32CD32"><?php echo $jogo['pontos_visitante'];?></b>   
             </td>
           </tr>
           <?php
           $contador++;
           if($contador == 19){
            $contador = 1;
          } 
        endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>
