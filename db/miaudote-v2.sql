


SELECT A.COD_ANIMAL, 
A.NOM_ANIMAL, 
A.DES_ANIMAL, 
A.DES_IDADE, 
A.IND_PORTE_ANIMAL, 
A.IND_SEXO_ANIMAL,
A.DAT_CADASTRO, 
A.DES_LOCAL, 
A.DES_MEDICAMENTO, 
E.DES_ESPECIE 
FROM ANIMAL A 
INNER JOIN ESPECIE E 
ON (E.COD_ESPECIE = A.ESPECIE_COD_ESPECIE) 
		