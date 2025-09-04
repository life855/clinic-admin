SELECT 
	p.per_nombres AS NOMBRES, 
    p.per_apellido AS APELLIDOS, 
    g.gen_nombre AS SEXO, 
    e.ec_nombre AS "ESTADO CIVIL", 
    TIMESTAMPDIFF(YEAR, per_nacimiento, CURDATE()) AS EDAD
FROM persona p
LEFT JOIN genero g ON p.per_genero = g.gen_id
LEFT JOIN estado_civil e ON p.per_estadoCivil = e.ec_id