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

<div class="row">
  <div class="form-group col-md-2">
    <select name="rodada" class="form-control" onchange="window.location=this.value">
      <option value="">Rodada</option>
      <?php for($x = 1; $x <= 35; $x++){ ?>
        <option value="#<?php echo $x; ?>"><?php echo $x; ?>º Rodada</a></option>
      <?php };?>
    </select>
  </div>
</div>

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
                <b style="color: #32CD32"><?php echo $jogo['pontos_casa'];?></b>
              </td>
              <td style="text-align: center;vertical-align: middle;">
                x</br></br>
                <a href="parciais.php?id=<?php echo $jogo['id_jogo'];?>" class="btn btn-default">ver escalações</a>
              </td>
              <td style="text-align: center;">
               <img src="<?php echo $jogo['escudo_visitante']; ?>"  style="width: 40px; height: 40px;"></br>
               <?php echo $jogo['time_visitante'] ?></br>
               <b style="color: #32CD32"><?php echo $jogo['pontos_visitante'];?></b>   
             </td>
           </tr>
         <?php
          $contador++;
          if($contador == 18){
            $contador = 1;
          } 
          endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
   </div>
 </body>
 </html>
