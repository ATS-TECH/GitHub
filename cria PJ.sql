use componentes;
INSERT INTO rastreado
(idrastreado,
idpessoa,
nomerastreado,
indalmox,
indbeacon,
indchipado,
indqrcode,
indmanual,
indbarras,
indveiculo)
VALUES
(1,5,'VEÍCULOS',
'S',
'N',
'S',
'N',
'N',
'N',
'S'
);
INSERT INTO componente
(idcomponente,
descrComponente,
ispneu,
idpessoa,
cindchipado
)
VALUES
(
2,
'PNEUS',
'S',
5,
'S'
);

INSERT INTO familia_rastreado
(idrastreado,
idcomponente,
idpessoa)
VALUES
(
1,
2,
5
);
