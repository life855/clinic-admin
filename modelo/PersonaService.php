<?php
// modelo/PersonaModel.php
require_once __DIR__ . '/DB.php';

class PersonaModel {
    private $pdo;
    public function __construct() {
        $this->pdo = DB::getInstance()->getConnection();
    }

    // obtiene persona por usuario usando el SP
    public function loginPersona(string $usuario, string $clave_md5) {
        $stmt = $this->pdo->prepare("CALL sp_login_persona(:usuario, :clave)");
        $stmt->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindValue(':clave', $clave_md5, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $row ?: null;
    }

    // inserta persona y retorna per_cod (usa OUT variable)
    public function insertPersona(array $data): int {
        // data debe contener: nombres, apellido, nacimiento (Y-m-d or null), usuario, clave(hashed), genero, estadoCivil
        $sql = "CALL sp_insert_persona(:nombres, :apellido, :nacimiento, :usuario, :clave, :genero, :estadoCivil, @out_per_cod)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nombres', $data['nombres'], PDO::PARAM_STR);
        $stmt->bindValue(':apellido', $data['apellido'], PDO::PARAM_STR);
        $stmt->bindValue(':nacimiento', $data['nacimiento'] ?? null);
        $stmt->bindValue(':usuario', $data['usuario'], PDO::PARAM_STR);
        $stmt->bindValue(':clave', $data['clave'], PDO::PARAM_STR);
        $stmt->bindValue(':genero', $data['genero'] ?? null);
        $stmt->bindValue(':estadoCivil', $data['estadoCivil'] ?? null);
        $stmt->execute();
        $stmt->closeCursor();

        // recuperar OUT
        $row = $this->pdo->query("SELECT @out_per_cod AS per_cod")->fetch(PDO::FETCH_ASSOC);
        return (int)$row['per_cod'];
    }

    // insertando persona por el form paciente
    public function insertar(array $data): int {
        $sql = "CALL sp_insert(:nombres, :apellidos, :nacimiento, :usuario, :clave, :sexo, :estado_civil, :tipo_documento, :codigo_documento, :tel_principal, :num_principal, :telefono_secundario, :num_secundario, :correo_tipo1, :correo1, :correo_tipo2, :correo2)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":nombres", $data["nombres"]);
        $stmt->bindValue(":apellidos", $data["apellidos"]);
        $stmt->bindValue(":nacimiento", $data["nacimiento"]);
        $stmt->bindValue(":usuario", $data["usuario"]);
        $stmt->bindValue(":clave", $data["clave"]);
        $stmt->bindValue(":sexo", $data["sexo"]);
        $stmt->bindValue(":estado_civil", $data["estado_civil"]);
        $stmt->bindValue(":tipo_documento", $data["tipo_documento"]);
        $stmt->bindValue(":codigo_documento", $data["codigo_documento"]);
        $stmt->bindValue(":tel_principal", $data["telefono_principal"]);
        $stmt->bindValue(":num_principal", $data["num_principal"]);
        $stmt->bindValue(":tel_secundario", $data["telefono_secundario"]);
        $stmt->bindValue(":num_secundario", $data["num_secundario"]);
        $stmt->bindValue(":correo_tipo1", $data["correo_tipo1"]);
        $stmt->bindValue(":correo1", $data["correo1"]);
        $stmt->bindValue(":correo_tipo2", $data["correo_tipo2"]);
        $stmt->bindValue(":correo2", $data["correo2"]);
        $stmt->execute();
        $stmt->closeCursor();
    }

    // inserta relaciones a través del SP que acepta JSON
    public function insertRelaciones(int $per_cod, ?array $docs = null, ?array $tels = null, ?array $dirs = null): void {
        $docs_json = $docs ? json_encode($docs, JSON_UNESCAPED_UNICODE) : null;
        $tels_json = $tels ? json_encode($tels, JSON_UNESCAPED_UNICODE) : null;
        $dirs_json = $dirs ? json_encode($dirs, JSON_UNESCAPED_UNICODE) : null;
        
        $sql = "CALL sp_insert_persona_relaciones(:per_cod, :docs_json, :tels_json, :dirs_json)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':per_cod', $per_cod, PDO::PARAM_INT);
        $stmt->bindValue(':docs_json', $docs_json, PDO::PARAM_STR);
        $stmt->bindValue(':tels_json', $tels_json, PDO::PARAM_STR);
        $stmt->bindValue(':dirs_json', $dirs_json, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
    }
}
