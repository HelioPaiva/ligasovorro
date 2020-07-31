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
        <li><a href="#">Jogos</a></li>
        <li><a href="#">Premiação</a></li>
        <li><a href="#">Regulamento</a></li>
      </ul>
      <!--<ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>-->
    </div>
  </div>
</nav>
<div class="table-responsive">
<table class="table">
	 <thead>
     	<tr>
     		<th style="width: 10px; text-align: center">Rank</th>
     		<th style="width: 150px;  text-align: center">Time</th>
     		<th style="width: 100px; text-align: center">Pts</th>
     		<th style="width: 100px; text-align: center">Pró</th>
     		<th style="width: 100px; text-align: center">Contra</th>
     		<th style="width: 100px; text-align: center">Qtd 1º</th>
     	</tr>
     	<tbody>
     		<?php for ($i=1; $i <=34 ; $i++) { ?>
	     		<tr>
	     			<?php if($i <= 8) { ?>
	     				<td style="text-align: center;vertical-align: middle; font-size: 16px; color: #1E90FF; font-weight: bold; ">
	     			<?php }else{ ?>
	     				<td style="text-align: center;vertical-align: middle; font-size: 16px; color: #363636; font-weight: bold; ">
	     			<?php }?>
	     				<?php echo $i.'º'; ?>
     				</td>
	     			<td>
	     				<div style=" text-align: center;vertical-align: middle;">
	     					<img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_134/escudo/a4/47/27/00079c2fcc-1495-40c7-8c58-3c5bea9d47a420190403224727" style="width: 40px; height: 40px;">
	     				</div>
	     				<div style="text-align: center;vertical-align: middle; margin-top: -30px; margin-left: 35px; position: relative;">
	     					<img style="border-radius: 50%;" id="foto" src="https://graph.facebook.com/v2.9/234000320134394/picture?width=30&amp;height=30">
	     				</div>
	     				<div style="text-align: center;vertical-align: middle;">
	     					<b>Power2019</b></br>Hélio Paiva
	     				</div>
	     			</td>
	     			<td style="text-align:	center;vertical-align: middle; font-weight: bold; font-size: 16px">75</td>
	     			<td style="text-align: center;vertical-align: middle;">1950.45</td>
	     			<td style="text-align: center;vertical-align: middle;">456.09</td>
	     			<td style="text-align: center;vertical-align: middle;">20.00</td>
	     		</tr>
     		<?php } ?>
     	</tbody>

</table>
</div>

<!--<div class="container" style="background-color:#F8F8FF;">
  <h1>Ranking</h1>
  <div class="row" style="background-color:#FFFFFF;">
    <div class="col-sm-1">
      1º
    </div>
     <div class="col-sm-4">
      <img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_134/escudo/a4/47/27/00079c2fcc-1495-40c7-8c58-3c5bea9d47a420190403224727" style="width: 50px; height: 50px;">
      </br>
      <img id="foto" src="https://graph.facebook.com/v2.9/234000320134394/picture?width=35&amp;height=35">
      </br>
     </div>
     <div class="col-sm-4">
      <span id="time"><b>Power2019</b></span></br>
  	  <span id="time">Hélio Paiva</span>
      <p>Pontos</p>
      78
      <b><p>PRO</p></b>
      1998.98
      <b><p>Contra</p></b>
      <span id="pontos_contra_num">500.56</span>
      <b><p>Qtd 1º</p></b>
      <span id="pontos_qtd_num">10.00</span>
  	</div>-->
    <!--<div class="col-sm-6" style="background-color:pink;">
      <p>Sed ut perspiciatis...</p>
    </div>-->
  <!--</div>
   <div class="row" style="background-color:#FFFFFF;">
    <div class="col-sm-1">
      1º
    </div>
     <div class="col-sm-4">
      <img src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_134/escudo/a4/47/27/00079c2fcc-1495-40c7-8c58-3c5bea9d47a420190403224727" style="width: 50px; height: 50px;">
      </br>
      <img id="foto" src="https://graph.facebook.com/v2.9/234000320134394/picture?width=35&amp;height=35">
      </br>
     </div>
     <div class="col-sm-4">
      <span id="time"><b>Power2019</b></span></br>
  	  <span id="time">Hélio Paiva</span>
      <p>Pontos</p>
      78
      <b><p>PRO</p></b>
      1998.98
      <b><p>Contra</p></b>
      <span id="pontos_contra_num">500.56</span>
      <b><p>Qtd 1º</p></b>
      <span id="pontos_qtd_num">10.00</span>
  	</div>-->
    <!--<div class="col-sm-6" style="background-color:pink;">
      <p>Sed ut perspiciatis...</p>
    </div>-->
  <!--</div>
</div>-->



<!--
<div id="page-content-wrapper">
	<div class="page-content inset" data-spy="scroll" data-target="#spy">
        <!--<div class="row">-->
        	<!--<div class="col-md-12 well">
        		<legend id="anch1">Ranking</legend>
        		<?php for ($i=1; $i <= 34; $i++) { ?> 
        			<div class="row">
                		<div class="form-group col-md-8">
                			<div id="jogador">
                				</br></br></br></br></br></br>
                			</div>
                			<div id="posicao">
                				<?php if($i <= 8) { ?>
                					<b><span id="oito"><?php echo $i; ?>º</span></b>
                				<?php } else { ?>
                					<b><?php echo $i; ?>º</b>
                				<?php }?>
                			</div>
                			<div id="escudo">
                				<img id="escudo" src="https://s3.glbimg.com/v1/AUTH_58d78b787ec34892b5aaa0c7a146155f/cartola_svg_134/escudo/a4/47/27/00079c2fcc-1495-40c7-8c58-3c5bea9d47a420190403224727">
                			</div>
                			<div id="foto">
                				<img id="foto" src="https://graph.facebook.com/v2.9/234000320134394/picture?width=35&amp;height=35">
                			</div>
                			<div id="time">
                				<b>Power2019</b><p>Hélio Paiva</p>
                			</div>
                			<div id="pontos">
                				<b>
                					<p>Pontos</p>
                					<span id="pontos_num"><?php echo '78'; ?></span>
                				</b>
                			</div>
                			<div id="pontos_pro">
                				<b><p>&nbsp;&nbsp;PRO</p></b>
                				<span id="pontos_pro_num"><?php echo '1900.56'; ?></span>
                			</div>
                			<hr id="separador">
                			<div id="pontos_contra">
                				<b><p>&nbsp;Contra</p></b>
                				<span id="pontos_contra_num"><?php echo '500.56'; ?></span>
                			</div>
                			<div id="qtd">
                				<b><p>&nbsp;&nbsp;&nbsp;Qtd 1º</p></b>
                				<span id="pontos_qtd_num">&nbsp;<?php echo '10.00'; ?></span>
                			</div>
                		</div>
                	</div>
                </br>
                <?php }; ?>
            </div>   
        <!--</div>-->
    <!--</div>
</div>-->
  

</body>
</html>
