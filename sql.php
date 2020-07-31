SELECT consolidado.*, 
       primeiro.total 
FROM 
(
	SELECT c.nome, 
		   c.nome_cartola, 
           c.url_escudo_svg, 
           c.foto_perfil, 
           c.nome                                  																											AS nome_tela, 
           (Count(jogos.vencedor) * 3 ) + ( (Count(empate_casa.empate_casa) + Count(empate_visitante.empate_visitante)) * 1 ) 								AS pontos, 
		   (SELECT Sum(p.pontos) FROM pontuacao p WHERE  p.time = c.nome) 																					AS pontos_pro, 
			contra.contra, 
			Cast((Count(jogos.vencedor) * 3) + ((Count(empate_casa.empate_casa) + Count( empate_visitante.empate_visitante)) * 1) AS UNSIGNED INTEGER) / Cast(((SELECT Max(p.rodada) FROM pontuacao p WHERE p.time = c.nome) * 3) AS UNSIGNED INTEGER)                                				AS rendimento 
        FROM   cadastro c 
		LEFT JOIN (
					SELECT DISTINCT j.*, 
                    (
						SELECT Sum(p.pontos) 
						FROM   pontuacao p 
						WHERE  j.time_casa = p.time AND j.rodada = p.rodada
					) AS pts_casa, 
					(
						SELECT Sum(p.pontos) 
                        FROM   pontuacao p 
						WHERE  j.time_visitante = p.time AND j.rodada = p.rodada
					) AS pts_visitante, 
					CASE WHEN (SELECT Sum(p.pontos) FROM pontuacao p WHERE  j.time_casa = p.time AND j.rodada = p.rodada) = (SELECT Sum(p.pontos) FROM  pontuacao p WHERE  j.time_visitante = p.timeAND j.rodada = p.rodada) THEN 'Empate' 
						 WHEN (SELECT Sum(p.pontos) FROM pontuacao p WHERE  j.time_casa = p.time AND j.rodada = p.rodada) > (SELECT Sum(p.pontos) FROM  pontuacao p WHERE  j.time_visitante = p.time AND j.rodada = p.rodada) THEN j.time_casa ELSE j.time_visitante end AS vencedor, 
					CASE WHEN 
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
WHERE  c.pago = 0 
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
          8 ASC 