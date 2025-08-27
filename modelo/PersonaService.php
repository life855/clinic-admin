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
