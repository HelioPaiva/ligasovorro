<?php
    require_once('functions-jogos.php');
    semi();
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
        background-color:#EE7600;
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
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Liga Sovorro</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Classificação</a></li>
          <li><a href="jogos.php">Jogos</a></li>
          <li><a href="jogos_semifinal.php">Semifinal</a></li>
          <li><a href="jogos_terceiro.php">3º Colocação</a></li>
        <li><a href="jogos_final.php">Final</a></li>
        <li><a href="jogos_quadrangular.php">Quadrangular</a></li>
          <li><a href="premiacao.php">Premiação</a></li>
        <li><a href="regulamento.php">Regulamento</a></li>
      </ul>
    </div>
  </div>
</nav>
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
                <td colspan="4" id="rodada"><a name="<?php echo 'Semifinal'; ?>"></a><p><?php echo ' '; ?>Semifinal</p></td>
                <td id="rodada"><a href="#top"><p></p></a></td>
            </tr> 
          <?php };?>
            <tr>
                
              <!--imagens/cartola_dourada.png
              <td id="pontos">
                <?php echo $jogo['rodada'] ?>
              
              </td>
              -->
              <td id="time"><img class="img-responsive" src="<?php echo $jogo['escudo_casa']; ?>" id="img"><?php if($contador == 1){echo utf8_encode($jogo['tela_casa']);}else{echo '2º Colocado';}//utf8_encode($jogo['tela_casa']); ?></td>
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
              <td id="time"><img class="img-responsive" src="<?php echo $jogo['escudo_visitante']; ?>" id="img"><?php if($contador == 1){echo utf8_encode($jogo['tela_visitante']);}else{echo '3º Colocado';}//utf8_encode($jogo['tela_visitante']); ?></td>
              <!--<td id="time"><img class="img-responsive img-circle" src="imagens/estadio.jpg" id="img"><?php //echo 'Estádio '.utf8_encode($jogo['time_casa']); ?></td>-->
            </tr>
            <?php
                $contador++;
                if($contador == 14){
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

