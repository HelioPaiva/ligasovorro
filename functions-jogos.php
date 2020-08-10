<?php
//header('Content-Type: text/html; charset=utf-8');
require_once('config.php');
require_once(DBAPI);
$jogos = null;
$jogo = null;

//seleciona todos os registros
function index() {
  global $jogos;
  $sql = "
  select cons_parcial.*
,parcial_casa.parcial as parcila_casa
,parcial_visitante.parcial as parcila_visitante
from
(
SELECT j.id_jogo
  ,j.rodada
  ,j.time_casa
  ,j.time_visitante
  ,pc.pontos                                    as pontos_casa
  ,pv.pontos                                    as pontos_visitante
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then j.time_casa 
  when pc.pontos = pv.pontos then 'Empate' else j.time_visitante end        as vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then j.time_casa 
  when pc.pontos = pv.pontos then 'Empate' else j.time_visitante end        as perdedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then pc.pontos else pv.pontos end                as pontos_vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then pc.pontos else pv.pontos end          as pontos_perdedor
  ,cc.url_escudo_svg                                  as escudo_casa
  ,cv.url_escudo_svg                                  as escudo_visitante
  ,cc.time_id                     as time_id_casa
  ,cv.time_id                    as time_id_visitante
  FROM jogos j
  /*pesquisa time jogando em casa*/
  LEFT JOIN pontuacao pc    
  ON j.rodada = pc.rodada and j.time_casa = pc.time
  /*pesquisa time jogando com visitante*/
  LEFT JOIN pontuacao pv    
  ON j.rodada = pv.rodada and j.time_visitante = pv.time
  /*pesquisa escudo e estadio do time casa*/
  LEFT JOIN cadastro cc    
  ON j.time_casa = cc.nome 
  /*pesquisa escudo time visitante*/
  LEFT JOIN cadastro cv    
  ON j.time_visitante = cv.nome
  WHERE j.rodada <= 35
  ) cons_parcial
  LEFT JOIN
  (
        SELECT te.rodada
        ,te.id_time
        ,sum(pa.pontos) as parcial  
        FROM api_time_escalado te
        LEFT JOIN
        (
        SELECT * 
        FROM ligaso42_cartola.api_parciais
        ) pa
        ON te.rodada = pa.rodada and te.atleta_id = pa.atleta_id
        where pa.rodada = 1
        group by te.rodada
        ,te.id_time
  ) parcial_casa
  on cons_parcial.rodada = parcial_casa.rodada and cons_parcial.time_id_casa = parcial_casa.id_time
  LEFT JOIN
  (
        SELECT te.rodada
        ,te.id_time
        ,sum(pa.pontos) as parcial  
        FROM api_time_escalado te
        LEFT JOIN
        (
        SELECT * 
        FROM ligaso42_cartola.api_parciais
        ) pa
        ON te.rodada = pa.rodada and te.atleta_id = pa.atleta_id
        where pa.rodada = 1
        group by te.rodada
        ,te.id_time
  ) parcial_visitante
  on cons_parcial.rodada = parcial_visitante.rodada and cons_parcial.time_id_visitante = parcial_visitante.id_time
  ORDER BY 2,3 asc ";
  $jogos = consulta_todos($sql);
}

function quarta() {
  global $jogos;
  $sql = "SELECT j.rodada
  ,j.time_casa
  ,j.time_visitante
  ,pc.pontos																		as pontos_casa
  ,pv.pontos																		as pontos_visitante
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then j.time_casa else j.time_visitante end 		as vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then j.time_casa else j.time_visitante end 		as perdedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then pc.pontos else pv.pontos end 				as pontos_vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then pc.pontos else pv.pontos end 				as pontos_perdedor
  ,cc.foto_escudo																	as escudo_casa
  ,cv.foto_escudo																	as escudo_visitante
  ,cc.foto_estadio																	as estadio
  ,cc.timeTela																		as tela_casa
  ,cv.timeTela																		as tela_visitante
  FROM jogos j
  /*pesquisa time jogando em casa*/
  LEFT JOIN pontuacao pc    
  ON j.rodada = pc.rodada and j.time_casa = pc.time
  /*pesquisa time jogando com visitante*/
  LEFT JOIN pontuacao pv    
  ON j.rodada = pv.rodada and j.time_visitante = pv.time
  /*pesquisa escudo e estadio do time casa*/
  LEFT JOIN cadastro cc    
  ON j.time_casa = cc.time 
  /*pesquisa escudo time visitante*/
  LEFT JOIN cadastro cv    
  ON j.time_visitante = cv.time
  WHERE j.rodada >= 36 and j.rodada <= 39 
  ;";
  $jogos = find_all($sql);
}





function semi() {
  global $jogos;
  $sql = "SELECT j.rodada
  ,j.time_casa
  ,j.time_visitante
  ,pc.pontos																		as pontos_casa
  ,pv.pontos																		as pontos_visitante
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then j.time_casa else j.time_visitante end 		as vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then j.time_casa else j.time_visitante end 		as perdedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then pc.pontos else pv.pontos end 				as pontos_vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then pc.pontos else pv.pontos end 				as pontos_perdedor
  ,cc.foto_escudo																	as escudo_casa
  ,cv.foto_escudo																	as escudo_visitante
  ,cc.foto_estadio																	as estadio
  ,cc.timeTela																		as tela_casa
  ,cv.timeTela																		as tela_visitante
  FROM jogos j
  /*pesquisa time jogando em casa*/
  LEFT JOIN pontuacao pc    
  ON j.rodada = pc.rodada and j.time_casa = pc.time
  /*pesquisa time jogando com visitante*/
  LEFT JOIN pontuacao pv    
  ON j.rodada = pv.rodada and j.time_visitante = pv.time
  /*pesquisa escudo e estadio do time casa*/
  LEFT JOIN cadastro cc    
  ON j.time_casa = cc.time 
  /*pesquisa escudo time visitante*/
  LEFT JOIN cadastro cv    
  ON j.time_visitante = cv.time
  WHERE j.rodada >= 40 and j.rodada <= 41
  ;";
  $jogos = find_all($sql);
}

function terceiro() {
  global $jogos;
  $sql = "SELECT j.rodada
  ,j.time_casa
  ,j.time_visitante
  ,pc.pontos																		as pontos_casa
  ,pv.pontos																		as pontos_visitante
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then j.time_casa else j.time_visitante end 		as vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then j.time_casa else j.time_visitante end 		as perdedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then pc.pontos else pv.pontos end 				as pontos_vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then pc.pontos else pv.pontos end 				as pontos_perdedor
  ,cc.foto_escudo																	as escudo_casa
  ,cv.foto_escudo																	as escudo_visitante
  ,cc.foto_estadio																	as estadio
  ,cc.timeTela																		as tela_casa
  ,cv.timeTela																		as tela_visitante
  FROM jogos j
  /*pesquisa time jogando em casa*/
  LEFT JOIN pontuacao pc    
  ON j.rodada = pc.rodada and j.time_casa = pc.time
  /*pesquisa time jogando com visitante*/
  LEFT JOIN pontuacao pv    
  ON j.rodada = pv.rodada and j.time_visitante = pv.time
  /*pesquisa escudo e estadio do time casa*/
  LEFT JOIN cadastro cc    
  ON j.time_casa = cc.time 
  /*pesquisa escudo time visitante*/
  LEFT JOIN cadastro cv    
  ON j.time_visitante = cv.time
  WHERE j.rodada = 42
  ;";
  $jogos = find_all($sql);
}


function finais() {
  global $jogos;
  $sql = "SELECT j.rodada
  ,j.time_casa
  ,j.time_visitante
  ,pc.pontos																		as pontos_casa
  ,pv.pontos																		as pontos_visitante
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then j.time_casa else j.time_visitante end 		as vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then j.time_casa else j.time_visitante end 		as perdedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos > pv.pontos then pc.pontos else pv.pontos end 				as pontos_vencedor
  ,case when isnull(pc.pontos) or isnull(pv.pontos) then null 
  when pc.pontos < pv.pontos then pc.pontos else pv.pontos end 				as pontos_perdedor
  ,cc.foto_escudo																	as escudo_casa
  ,cv.foto_escudo																	as escudo_visitante
  ,cc.foto_estadio																	as estadio
  ,cc.timeTela																		as tela_casa
  ,cv.timeTela																		as tela_visitante
  FROM jogos j
  /*pesquisa time jogando em casa*/
  LEFT JOIN pontuacao pc    
  ON j.rodada = pc.rodada and j.time_casa = pc.time
  /*pesquisa time jogando com visitante*/
  LEFT JOIN pontuacao pv    
  ON j.rodada = pv.rodada and j.time_visitante = pv.time
  /*pesquisa escudo e estadio do time casa*/
  LEFT JOIN cadastro cc    
  ON j.time_casa = cc.time 
  /*pesquisa escudo time visitante*/
  LEFT JOIN cadastro cv    
  ON j.time_visitante = cv.time
  WHERE j.rodada = 43
  ;";
  $jogos = find_all($sql);
}



