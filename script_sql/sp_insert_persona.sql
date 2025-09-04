DELIMITER //
CREATE PROCEDURE sp_insert_persona (
  IN in_nombres VARCHAR(35),
  IN in_apellido VARCHAR(25),
  IN in_nacimiento DATE,
  IN in_usuario VARCHAR(15),
  IN in_clave VARCHAR(125), -- aquí esperar el hash ya calculado en PHP
  IN in_genero INT,
  IN in_estadoCivil INT,
  OUT out_per_cod INT
)
BEGIN
  INSERT INTO persona (per_nombres, per_apellido, per_nacimiento, per_usuario, per_clave, per_genero, per_estadoCivil)
  VALUES (in_nombres, in_apellido, in_nacimiento, in_usuario, in_clave, in_genero, in_estadoCivil);

  SET out_per_cod = LAST_INSERT_ID();
END //
DELIMITER ;
