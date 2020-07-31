<?php
    require_once('functions-cadastro.php');
    valorPremio();
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
    #linha {
      background-color:#FFFFFF;
      margin-top:0px;
      -moz-border-radius:7px;
      -webkit-border-radius:7px;
      border-radius:7px;
    }
    #titulo{
        background-color:#00B9FF;
        font-size: 25px;
        color: white;
        height: 45px;
        -moz-border-radius:7px;
      -webkit-border-radius:7px;
      border-radius:7px;
      text-align: center;
    }
    p{
       color: white;
       font-size: 18px;
    }
    #regulamento{
        text-align: justify;
        font-size: 11px;
        height: 100px;
    }
    span{
        font-weight: bold;
    }
</style>
</head>
<body style="background-color:#E9E9E9;">
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
            <li><a href="premiacao.php">Premiação</a></li>
          </ul>
      <!--<ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>-->
    </div>
  </div>
</nav> 
<div class="container">
    <div class="row">
        <div class="form-group col-md-12" id="titulo">
          Premiação
        </div>
    </div>
    <div class="row" id="linha">
        <div class="form-group col-md-12">
            <?php 
               $total = ($cadastro['total'] * 50); 
            ?>
            <label>Total Arrecadado:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$ &nbsp; </label><span><?php echo number_format($total,'2',',','.'); ?></span> </br></br></br>
            <label>1º Colocado Liga Sovorro:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$&nbsp; </label><span><?php echo number_format(($total * 0.75),'2','.',','); ?></span> </br>
            <label>2º Colocado Liga Sovorro:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$&nbsp; </label><span><?php echo number_format(($total * 0.15),'2','.',','); ?></span></br>
            <label>3º Colocado Liga Sovorro:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$&nbsp; </label><span><?php echo number_format(($total * 0.05),'2','.',','); ?></span></br>
            <label>1º Colocado Liga Cartola:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$&nbsp; </label><span><?php echo number_format(($total * 0.05),'2','.',','); ?></span></br>
        </div>
    </div>
</div>
</body>
</html>

