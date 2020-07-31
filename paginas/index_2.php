<?php
    require_once('functions-cadastro.php');
    index();
    $valor = count($cadastros);
    $rodada = 1;
    $pontosTotal = $rodada * 3
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
    #menu{
        /*background-color:#EE7600;
        color:black;*/
    }
    th{
      background-color:#EE7600;  
      font-size: 12px;
      font-weight: bold;  
      vertical-align: middle;
      text-align: center;
    }
    p{
       color: white;
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
     #img_estrela{
      width:20px;
      height:20px;
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
    #posicao{
      font-size: 12px;
      line-height:40px;
      font-weight: bold;
      width: 5px; 
    }
    #time{
      font-size: 10px;
      width: 50px;
      font-weight: bold;
    }
    #cartola{
      font-size: 10px;
      width: 50px;
      font-weight: bold;
    }
    #pontos{
      font-size: 12px;
      line-height:50px;
      font-weight: bold;
      width: 60px;
    }
    #pro{
      font-size: 12px;
      line-height:50px;
      /*font-weight: bold;*/
      width: 60px;
    }
    #contra{
      font-size: 12px;
      line-height:50px;
      /*font-weight: bold;*/
      width: 60px;
    }
    #aproveitamento{
      font-size: 12px;
      line-height:50px;
      /*font-weight: bold;*/
      width: 60px;
    }
    label{
      font-size: 18px;
      align-items: center;
      font-weight: bold;
      width: 900px;
      line-height:50px;
    }
  </style>
</head>
<body style="background-color:#E9E9E9;">
    <nav class="navbar navbar-inverse" id="menu">
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
          <thead>
            <tr>
              <th><p>#</p></th>
              <th><p>&nbsp;Time&nbsp;&nbsp;</p></th>
              <th><p>Cartola</p></th>
              <th><p>Pts</p></th>
              <th><p>PRO</p></th>
              <th><p>Contra</p></th>
              <th><p>%</p></th>
              <th><p></p></th>
              <th><p></p></th>
            </tr>
          </thead>
          <tbody> 
          <?php if ($cadastros) : ?>
          <?php $r = 1; ?>
          <?php foreach ($cadastros as $cadastro) : ?>
            <tr>
              <td id="posicao"><?php echo $r.'º'; ?><?php if($r>=1 && $r<=4){echo '<img class="img-responsive img-circle" src="./imagens/estrelaClassificados.jpeg" id="img_estrela">';}else if($r == 26){echo '<img class="img-responsive img-circle" src="./imagens/lanterna.png" id="img_estrela">';}?></td>
              <td id="time"><img class="img-responsive" src="<?php echo $cadastro['foto_escudo']; ?>" id="img"></br><?php echo utf8_encode(strtolower($cadastro['timeTela'])); ?></td>
              <td id="cartola"><img class="img-responsive img-circle" src="<?php echo $cadastro['foto_presidente']; ?>" id="img"></br><?php echo utf8_encode(strtolower($cadastro['cartola'])); ?></td>
              <td id="pontos" ><?php echo $cadastro['pontos']; ?></td>
              <td id="pro"><?php echo $cadastro['pontos_pro'];?></td>
              <td id="contra"><?php  echo $cadastro['contra'];?></td>
              <td id="aproveitamento"><?php  echo number_format(($cadastro['pontos'] / $pontosTotal)*100).'%';?></td>
              <td id="aproveitamento"></td>
              <td id="aproveitamento"></td>
            </tr>
            <?php $r = $r + 1; ?>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
</div>
</body>
</html>

