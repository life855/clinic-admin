-- Usar una base de datos ya creada, p. ej. compraenuna
CREATE DATABASE IF NOT EXISTS clinic_admin_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE clinic_admin_db;

-- Tabla persona
CREATE TABLE IF NOT EXISTS persona (
  per_cod INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  per_nombres VARCHAR(35) NOT NULL,
  per_apellido VARCHAR(25) NOT NULL,
  per_nacimiento DATE NULL NOT NULL,
  per_usuario VARCHAR(15) NOT NULL UNIQUE,
  per_clave VARCHAR(125) NOT NULL, -- guardaremos password_hash()
  per_genero INT NOT NULL,
  per_estadoCivil INT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla persona_documento
CREATE TABLE IF NOT EXISTS persona_documento (
  pd_doc_codigo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  per_cod INT NOT NULL,
  pd_tipo INT NULL,
  pd_codigo VARCHAR(15) NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (per_cod) REFERENCES persona(per_cod) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla persona_telefono
CREATE TABLE IF NOT EXISTS persona_telefono (
  pt_tel_codigo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  per_cod INT NOT NULL,
  pt_tipo INT NULL,
  pt_codigo VARCHAR(15) NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (per_cod) REFERENCES persona(per_cod) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla persona_direccion
CREATE TABLE IF NOT EXISTS persona_direccion (
  pd_dir_codigo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  per_cod INT NOT NULL,
  pd_departamento INT NULL,
  pd_provincia INT NULL,
  pd_distrito INT NULL,
  pd_anexo INT NULL,
  pd_direccion VARCHAR(200) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (per_cod) REFERENCES persona(per_cod) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Talba sexo con valores insertados
CREATE TABLE IF NOT EXISTS sexo (
  sexo_id INT AUTO_INCREMENT PRIMARY KEY,
  sexo_nombre VARCHAR(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO sexo (sexo_nombre) VALUES
('Masculino'), ('Femenino');

-- Tabla de estado civil con valores insertados
CREATE TABLE IF NOT EXISTS estado_civil (
  ec_id INT AUTO_INCREMENT PRIMARY KEY,
  ec_nombre VARCHAR(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO estado_civil (ec_nombre) VALUES
('Soltero'), ('Casado'), ('Divorciado'), ('Viudo'), ('Conviviente');

-- Tabla de tipo de documento con valores insertados
CREATE TABLE IF NOT EXISTS tipo_documento (
  td_id INT AUTO_INCREMENT PRIMARY KEY,
  td_nombre VARCHAR(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO tipo_documento (td_nombre) VALUES
('DNI'), ('Carné de extranjería'), ('Pasaporte');