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
        background-color:#A52A2A;
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
<?php
        include 'menu.php';
        ?>  
<div class="container">
    <div class="row">
        <div class="form-group col-md-12" id="titulo">
          Premiação
        </div>
    </div>
    <div class="row" id="linha">
        <div class="form-group col-md-12">
            <?php $total = ($cadastro['total'] * 50); ?>
            <label>Total Arrecadado:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$ &nbsp; </label><span><?php echo number_format($total,'2',',','.'); ?></span> </br></br></br>
            <label>1º Colocado Liga Sovorro:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$&nbsp; </label><span><?php echo number_format(($total * 0.70),'2','.',','); ?></span> </br>
            <label>2º Colocado Liga Sovorro:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$&nbsp; </label><span><?php echo number_format(($total * 0.15),'2','.',','); ?></span></br>
            <label>3º Colocado Liga Sovorro:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$&nbsp; </label><span><?php echo number_format(($total * 0.07),'2','.',','); ?></span></br>
            <label>4º Colocado Liga Sovorro:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$&nbsp; </label><span><?php echo number_format(($total * 0.04),'2','.',','); ?></span></br>
            <label>1º Colocado Liga Cartola:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   R$&nbsp; </label><span><?php echo number_format(($total * 0.04),'2','.',','); ?></span></br>
        </div>
    </div>
</div>
</body>
</html>

