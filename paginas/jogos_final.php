<?php
    require_once('functions-jogos.php');
    finais();
    //$valor = count($cadastros);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Liga Sovorro</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <style type="text/css">
    th{
      background-color:#A52A2A;   
      font-size: 11px;
      font-weight: bold;  
      vertical-align: middle;
      text-align: center;
    }
    td{
      vertical-align: middle;
      text-align: center;
    }
    #img{
      width:40px;
      height:40px;
      margin: 0 auto;
      /*margin-top:10px;*/
      /*margin-left:40px;*/
    }
    #linha {
      background-color:#FFFFFF;
      margin-top:0px;
      -moz-border-radius:7px;
      -webkit-border-radius:7px;
      border-radius:7px;
    }
    #time{
      font-size: 10px;
      width: 40px;
      font-weight: bold;
    }
    #pontos{
      font-size: 13px;
      line-height:50px;
      font-weight: bold;
      width: 30px;
      color: red;
    }
    #pontos_positivo{
      font-size: 13px;
      line-height:50px;
      font-weight: bold;
      width: 30px;
    }
    #x{
      font-size: 13px;
      line-height:50px;
      font-weight: bold;
      width: 5px;
    }
    #rodada{
        font-size: 16px;
        background-color:#A52A2A;
        height: 15px;
        font-weight: bold;
    }
    p{
       color: white;
       font-size: 14px;
    }
    
    
    
  </style>
</head>
<body style="background-color:#E9E9E9;">
    <a name="top"></a>
<?php
        include 'menu.php';
        ?>  
<div class="container">
    <div class="row" id="linha">
      <div class="table-responsive">          
          <table class="table">
          <tbody>
          <?php if ($jogos) : ?>
          <?php 
            $contador = 1;
            foreach ($jogos as $jogo) : 
          ?>
          <?php if($contador == 1){?>
            <tr>
                <td colspan="5" id="rodada"><a name="<?php echo $jogo['rodada']; ?>"></a><p><?php //echo $jogo['rodada'].'º '; ?>Final</p></td>
                
            </tr> 
          <?php };?>
            <tr>
                
              <!--imagens/cartola_dourada.png
              <td id="pontos">
                <?php echo $jogo['rodada'] ?>
              
              </td>
              -->
              <td id="time"><img class="img-responsive" src="<?php echo $jogo['escudo_casa']; ?>" id="img"><?php echo utf8_encode($jogo['tela_casa']); ?></td>
              <?php if($jogo['pontos_casa'] < 0){ ?>
                <td id="pontos"><?php if($jogo['pontos_casa'] != ""){echo $jogo['pontos_casa'];}else{echo '0.00';} ?></td>
              <?php } else {?>
                <td id="pontos_positivo"><?php if($jogo['pontos_casa'] != ""){echo $jogo['pontos_casa'];}else{echo '0.00';} ?></td>
              <?php }?>
              <td id="pontos_positivo">x</td>
              <?php if($jogo['pontos_visitante'] < 0){ ?>
                <td id="pontos"><?php if($jogo['pontos_visitante'] != ""){echo $jogo['pontos_visitante'];}else{echo '0.00';} ?></td>
              <?php } else {?>
                <td id="pontos_positivo"><?php if($jogo['pontos_visitante'] != ""){echo $jogo['pontos_visitante'];}else{echo '0.00';} ?></td>
              <?php }?>
              <td id="time"><img class="img-responsive" src="<?php echo $jogo['escudo_visitante']; ?>" id="img"><?php echo utf8_encode($jogo['tela_visitante']); ?></td>
              <!--<td id="time"><img class="img-responsive img-circle" src="imagens/estadio.jpg" id="img"><?php //echo 'Estádio '.utf8_encode($jogo['time_casa']); ?></td>-->
            </tr>
            <?php
                $contador++;
                if($contador == 6){
                    $contador = 1;
                }
                endforeach; 
            ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
</div>
</body>
</html>

