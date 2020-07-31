<?php

//header('Content-Type: text/html; charset=utf-8');
require_once('config.php');
require_once(DBAPI);
$cadastros = null;
$cadastro = null;

//seleciona todos os registros
function index() {
  global $cadastros;
  $sql = "SELECT consolidado.*, 
  primeiro.total 
  FROM   (SELECT c.nome, 
  c.nome_cartola, 
  c.url_escudo_svg, 
  c.foto_perfil, 
  c.nome                                  AS nome_tela,
  c.facebook_id, 
  ( Count(jogos.vencedor) * 3 ) + ( ( 
  Count(empate_casa.empate_casa) 
  + Count(empate_visitante.empate_visitante) ) 
                                                 * 1 ) AS pontos, 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  p.time = c.nome)                AS pontos_pro, 
  contra.contra, 
  Cast((Count(jogos.vencedor) * 3) + 
  ((Count(empate_casa.empate_casa) + 
  Count( 
  empate_visitante.empate_visitante)) * 1) AS UNSIGNED INTEGER) / 
  Cast(((SELECT Max(p.rodada) FROM pontuacao p WHERE p.time = 
  c.nome) * 3) 
  AS 
  UNSIGNED 
  INTEGER)                                AS rendimento 
  FROM   cadastro c 
  LEFT JOIN (SELECT DISTINCT j.*, 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_casa = p.time 
  AND j.rodada = p.rodada) AS 
  pts_casa, 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_visitante = p.time 
  AND j.rodada = p.rodada) AS 
  pts_visitante, 
  CASE 
  WHEN 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_casa = p.time 
  AND j.rodada = p.rodada) = 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_visitante = p.time 
  AND j.rodada = p.rodada) THEN 
  'Empate' 
  WHEN 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_casa = p.time 
  AND j.rodada = p.rodada) > 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_visitante = p.time 
  AND j.rodada = p.rodada) THEN 
  j.time_casa 
  ELSE j.time_visitante 
  end                              AS 
  vencedor, 
  CASE 
  WHEN 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_casa = p.time 
  AND j.rodada = p.rodada) = 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_visitante = p.time 
  AND j.rodada = p.rodada) THEN 
  'Empate' 
  WHEN 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_casa = p.time 
  AND j.rodada = p.rodada) < 
  (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_visitante = p.time 
  AND j.rodada = p.rodada) THEN 
  j.time_casa 
  ELSE j.time_visitante 
  end                              AS 
  perdedor 
  FROM   jogos j 
  WHERE  rodada <= (SELECT Max(rodada) 
  FROM   pontuacao)) jogos 
  ON c.nome = jogos.vencedor 
  LEFT JOIN (SELECT CASE 
  WHEN (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_casa = p.time 
  AND j.rodada = p.rodada) = ( 
  SELECT 
  Sum(p.pontos) 
  FROM 
  pontuacao p 
  WHERE 
  j.time_visitante = p.time 
  AND j.rodada = p.rodada) THEN 
  j.time_casa 
  end AS empate_casa 
  FROM   jogos j) empate_casa 
  ON c.nome = empate_casa.empate_casa 
  LEFT JOIN (SELECT CASE 
  WHEN (SELECT Sum(p.pontos) 
  FROM   pontuacao p 
  WHERE  j.time_casa = p.time 
  AND j.rodada = p.rodada) = ( 
  SELECT 
  Sum(p.pontos) 
  FROM 
  pontuacao p 
  WHERE 
  j.time_visitante = p.time 
  AND j.rodada = p.rodada) THEN 
  j.time_visitante 
  end AS empate_visitante 
  FROM   jogos j) empate_visitante 
  ON c.nome = empate_visitante.empate_visitante 
  LEFT JOIN (SELECT tab_contra.nome, 
  Sum(tab_contra.pts_contra) AS contra 
  FROM   (SELECT c.nome, 
  Sum(tab_jogos.pts_visitante) AS 
  pts_contra 
  FROM   cadastro c 
  LEFT JOIN (SELECT j.*, 
  pts_casa.pontos 
  AS 
  pts_casa, 
  pts_visitante.pontos 
  AS 
  pts_visitante 
  FROM   jogos j 
  LEFT JOIN pontuacao 
  pts_casa 
  ON j.time_casa 
  = 
  pts_casa.time 
  AND 
  j.rodada = pts_casa.rodada 
  LEFT JOIN pontuacao 
  pts_visitante 
  ON j.time_visitante = 
  pts_visitante.time 
  AND 
  j.rodada = 
  pts_visitante.rodada) 
  tab_jogos 
  ON c.nome = tab_jogos.time_casa 
  GROUP  BY c.nome 
  UNION 
  SELECT c.nome, 
  Sum(tab_jogos.pts_casa) AS pts_contra 
  FROM   cadastro c 
  LEFT JOIN (SELECT j.*, 
  pts_casa.pontos      AS 
  pts_casa, 
  pts_visitante.pontos AS 
  pts_visitante 
  FROM   jogos j 
  LEFT JOIN pontuacao pts_casa 
  ON j.time_casa = 
  pts_casa.time 
  AND 
  j.rodada = pts_casa.rodada 
  LEFT JOIN pontuacao 
  pts_visitante 
  ON j.time_visitante = 
  pts_visitante.time 
  AND 
  j.rodada = 
  pts_visitante.rodada) 
  tab_jogos 
  ON c.nome = tab_jogos.time_visitante 
  GROUP  BY c.nome) tab_contra 
  GROUP  BY tab_contra.nome) contra 
  ON c.nome = contra.nome 
  WHERE  c.pago = 1 
  GROUP  BY c.nome, 
  c.nome_cartola, 
  c.url_escudo_svg, 
  c.foto_perfil, 
  c.nome) consolidado 
  LEFT JOIN (SELECT total.time, 
  Sum(total.qtd) AS total 
  FROM   (SELECT p.time AS time, 
  1      AS qtd 
  FROM   pontuacao p 
  INNER JOIN (SELECT rodada, 
  Max(pontos) AS pontos 
  FROM   pontuacao 
  GROUP  BY rodada) m 
  ON p.rodada = m.rodada 
  AND p.pontos = m.pontos) total 
  GROUP  BY total.time) primeiro 
  ON consolidado.nome = primeiro.time 
  ORDER  BY 6 DESC, 
  7 DESC, 
  8 ASC ";
  $cadastros = find_all($sql);
}

function quadrangular() {
  global $cadastros;
  $sql = "SELECT DISTINCT c.*
  ,case when c.cartola = 'Pekeno' then ((v.total_vitorias * 3) - 2) 
  when c.time = 'E.C. MarkWillian F.C' then ((v.total_vitorias * 3) + 1) 
  when isnull((v.total_vitorias * 3)) then 0 
  else (v.total_vitorias * 3) end as pontos
  /*,case when isnull((v.total_vitorias * 3)) then 0 else (v.total_vitorias * 3) end as pontos*/
  ,case when isnull(pro.total_pontos_pro) then 0.00 else pro.total_pontos_pro end as pontos_pro
  ,tabPontosContra.contra

  FROM cadastro c
  LEFT JOIN 
  (SELECT time, sum(pontos) as total_pontos_pro FROM pontuacao where rodada in (37,38) group by time) pro
  ON c.time = pro.time

  LEFT JOIN
  (
  select tab.vencedor
  ,count(tab.vencedor) as total_vitorias
  from
  (
  SELECT j.*, pc.pontos as pontos_casa, pv.pontos as pontos_visitante,
  case when isnull(pc.pontos) or isnull(pv.pontos) then null
  when pc.pontos > pv.pontos then j.time_casa else j.time_visitante  end as vencedor
  FROM jogos j
  LEFT JOIN pontuacao pc
  ON j.rodada = pc.rodada and j.time_casa = pc.time
  LEFT JOIN pontuacao pv
  ON j.rodada = pv.rodada and j.time_visitante = pv.time) tab
  where tab.rodada in (37,38)
  group by tab.vencedor
  ) v
  ON c.time = v.vencedor
  /**************************************************************************/
  LEFT JOIN

  (select tabContra.vencedor        as time
  ,sum(tabContra.ptsContra_1)  as contra
  from
  (
  select tabContraVenc.vencedor
  ,sum(tabContraVenc.pontos_contra_1) as ptsContra_1
  from
  (
  SELECT 
  case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then j.time_casa else j.time_visitante end     as vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then pc.pontos else pv.pontos end        as pontos_contra_1
  FROM jogos j
  LEFT JOIN pontuacao pc    
  ON j.rodada = pc.rodada and j.time_casa = pc.time
  LEFT JOIN pontuacao pv    
  ON j.rodada = pv.rodada and j.time_visitante = pv.time
  LEFT JOIN cadastro cc    
  ON j.time_casa = cc.time 
  LEFT JOIN cadastro cv    
  ON j.time_visitante = cv.time
  where j.rodada in (37,38)
) tabContraVenc
group by tabContraVenc.vencedor

UNION

select tabContraPerd.perdedor
,sum(tabContraPerd.pontos_contra_2) as ptsContra_1
from
(
  SELECT 
  case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then j.time_casa else j.time_visitante end     as perdedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then pc.pontos else pv.pontos end        as pontos_contra_2
  FROM jogos j
  LEFT JOIN pontuacao pc    
  ON j.rodada = pc.rodada and j.time_casa = pc.time
  LEFT JOIN pontuacao pv    
  ON j.rodada = pv.rodada and j.time_visitante = pv.time
  LEFT JOIN cadastro cc    
  ON j.time_casa = cc.time 
  LEFT JOIN cadastro cv    
  ON j.time_visitante = cv.time
  where j.rodada in (37,38) 
) tabContraPerd
group by tabContraPerd.perdedor
) tabContra
group by tabContra.vencedor) tabPontosContra
ON c.time = tabPontosContra.time
where c.cartola <> 'Andre</br>coelho' and c.cartola <> 'Fabricio</br>Souza' and c.cartola <> 'Wendel</br>Felipe' and c.cartola <> 'Guilherme</br>Oliveira'
order by 9 desc, 1 asc";
$cadastros = find_all($sql);
}

function valorPremio() {
  global $cadastro;
  $sql = 'select count(1) as total from cadastro where pago = 1';
    $cadastro = find($sql, 1); //O paramentro 1 é utlizado apenas para bater com a funcção que pede dois parametros
  }
