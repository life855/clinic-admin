DELIMITER //
CREATE PROCEDURE sp_login_persona (
    IN in_usuario VARCHAR(15),
    IN in_clave VARCHAR(125)
)
BEGIN
    SELECT per_cod, per_usuario
    FROM persona
    WHERE per_usuario = in_usuario
      AND per_clave = in_clave
    LIMIT 1;
END //
DELIMITER ;
