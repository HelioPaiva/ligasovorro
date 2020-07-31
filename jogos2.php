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
<body style="background-color: #FFFFFF">

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href=""><img src="https://s2.glbimg.com/wxnA27lBKoieDU-mKj085STU5ec=/https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_150/flamula/76/02/53/001637620190522180253" style="width: 50px; height: 50px; margin-top: -16px;"></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Classificação</a></li>
          <!--<li><a href="#">Jogos</a></li>-->
          <li><a href="regulamento.php">Regulamento</a></li>
          <!--<li><a href="premiacao.php">Premiação</a></li>-->
        </ul>
      <!--<ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>-->
    </div>
  </div>
</nav>


<div class="table-responsive">          
  <table class="table" border="1">
    <tbody>
      <?php if ($jogos) : ?>
        <?php 
        $contador = 1;
        foreach ($jogos as $jogo) : 
          ?>
          <?php if($contador == 1){?>
            <tr>
              <td style="background-color:#00B9FF; color: white;" colspan="4" id="rodada"><a name="<?php echo $jogo['rodada']; ?>"></a><p><?php echo $jogo['rodada'].'º '; ?>Rodada</p></td>
              <td style="background-color:#00B9FF; color: white;"><a href="#top"><p>Voltar</p></a></td>
            </tr> 
          <?php };?>
          <tr>
            <td>
              <img class="img-responsive" src="<?php echo $jogo['escudo_casa']; ?>" style="width: 60px; height: 60px;">
              <?php echo utf8_encode($jogo['time_casa']); ?>
            </td>
            <?php if($jogo['pontos_casa'] < 0){ ?>
              <td>
                <?php if($jogo['pontos_casa'] != ""){echo $jogo['pontos_casa'];}else{echo '0.00';} ?>
              </td>
            <?php } else {?>
              <td>
                <?php if($jogo['pontos_casa'] != ""){echo $jogo['pontos_casa'];}else{echo '0.00';} ?>
              </td>
            <?php }?>
            <td>x</td>
            <?php if($jogo['pontos_visitante'] < 0){ ?>
              <td>
                <?php if($jogo['pontos_visitante'] != ""){echo $jogo['pontos_visitante'];}else{echo '0.00';} ?>
              </td>
            <?php } else {?>
              <td>
                <?php if($jogo['pontos_visitante'] != ""){echo $jogo['pontos_visitante'];}else{echo '0.00';} ?>
              </td>
            <?php }?>
            <td>
              <img class="img-responsive" src="<?php echo $jogo['escudo_visitante']; ?>" style="width: 60px; height: 60px;"><?php echo utf8_encode($jogo['time_visitante']); ?>
            </td>
          </tr>
          <?php
          $contador++;
          if($contador == 18){
            $contador = 1;
          }
        endforeach; 
        ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>



</body>
</html>
