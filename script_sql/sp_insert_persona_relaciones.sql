DELIMITER //
CREATE PROCEDURE sp_insert_persona_relaciones (
  IN in_per_cod INT,
  IN in_docs_json JSON,
  IN in_tels_json JSON,
  IN in_dirs_json JSON
)
BEGIN
  DECLARE doc_count INT DEFAULT 0;
  DECLARE tel_count INT DEFAULT 0;
  DECLARE dir_count INT DEFAULT 0;

  DECLARE i INT DEFAULT 0;

  -- DOCUMENTOS
  IF in_docs_json IS NOT NULL AND JSON_LENGTH(in_docs_json) > 0 THEN
    SET doc_count = JSON_LENGTH(in_docs_json);
    SET i = 0;
    WHILE i < doc_count DO
      INSERT INTO persona_documento(per_cod, pd_tipo, pd_codigo)
      VALUES (
        in_per_cod,
        CAST(JSON_EXTRACT(in_docs_json, CONCAT('$[', i, '].pd_tipo')) AS UNSIGNED),
        JSON_UNQUOTE(JSON_EXTRACT(in_docs_json, CONCAT('$[', i, '].pd_codigo')))
      );
      SET i = i + 1;
    END WHILE;
  END IF;

  -- TELEFONOS
  IF in_tels_json IS NOT NULL AND JSON_LENGTH(in_tels_json) > 0 THEN
    SET tel_count = JSON_LENGTH(in_tels_json);
    SET i = 0;
    WHILE i < tel_count DO
      INSERT INTO persona_telefono(per_cod, pt_tipo, pt_codigo)
      VALUES (
        in_per_cod,
        CAST(JSON_EXTRACT(in_tels_json, CONCAT('$[', i, '].pt_tipo')) AS UNSIGNED),
        JSON_UNQUOTE(JSON_EXTRACT(in_tels_json, CONCAT('$[', i, '].pt_codigo')))
      );
      SET i = i + 1;
    END WHILE;
  END IF;

  -- DIRECCIONES
  IF in_dirs_json IS NOT NULL AND JSON_LENGTH(in_dirs_json) > 0 THEN
    SET dir_count = JSON_LENGTH(in_dirs_json);
    SET i = 0;
    WHILE i < dir_count DO
      INSERT INTO persona_direccion(per_cod, pd_departamento, pd_provincia, pd_distrito, pd_anexo, pd_direccion)
      VALUES (
        in_per_cod,
        CAST(JSON_EXTRACT(in_dirs_json, CONCAT('$[', i, '].pd_departamento')) AS UNSIGNED),
        CAST(JSON_EXTRACT(in_dirs_json, CONCAT('$[', i, '].pd_provincia')) AS UNSIGNED),
        CAST(JSON_EXTRACT(in_dirs_json, CONCAT('$[', i, '].pd_distrito')) AS UNSIGNED),
        CAST(JSON_EXTRACT(in_dirs_json, CONCAT('$[', i, '].pd_anexo')) AS UNSIGNED),
        JSON_UNQUOTE(JSON_EXTRACT(in_dirs_json, CONCAT('$[', i, '].pd_direccion')))
      );
      SET i = i + 1;
    END WHILE;
  END IF;
END //
DELIMITER ;
