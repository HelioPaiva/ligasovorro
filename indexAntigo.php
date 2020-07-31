<?php
require_once('functions-cadastro.php');
index();
valorPremio();
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
        <link href="style.css" rel="stylesheet">
    </head>
    <body style="background-color:#E9E9E9;">
 <?php
        include 'menu.php';
        ?>  
        <div class="container">
            <?php //$total = ($cadastro['total'] * 50); ?>
            <!--<center><label>Total Arrecadado: R$ <?php //echo number_format($total,'2',',','.'); ?></label></center>-->
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
                                <th><p>Qtd 1º</p></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php if ($cadastros) : ?>
                                <?php $r = 1; ?>
                                <?php foreach ($cadastros as $cadastro) : ?>
                                    <tr>
                                        <td id="posicao"><?php echo $r . 'º'; ?><?php if ($r >= 1 && $r <= 8) {
                                            echo '<img class="img-responsive img-circle" src="./imagens/estrelaClassificados.jpeg" id="img_estrela">';
                                            } else if ($r == 34) {
                                              echo '<img class="img-responsive img-circle" src="./imagens/lanterna.png" id="img_estrela">';
                                            } ?>
                                        </td>
                                        <td id="time"><img class="img-responsive" src="<?php echo $cadastro['foto_escudo']; ?>" id="img"></br><?php echo utf8_encode(strtolower($cadastro['timeTela'])); ?></td>
                                        <td id="cartola"><img class="img-responsive img-circle" src="<?php echo $cadastro['foto_presidente']; ?>" id="img"></br><?php echo utf8_encode(strtolower($cadastro['cartola'])); ?></td>
                                        <td id="pontos" ><?php echo $cadastro['pontos'];  ?></td>
                                        <td id="pro"><?php echo $cadastro['pontos_pro'] ;?></td>
                                        <td id="contra"><?php echo $cadastro['contra'] ;?></td>
                                        <td id="aproveitamento"><?php echo number_format(($cadastro['total'] * 10),'2'); ?></td>
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

