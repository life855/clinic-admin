<?php
// negocio/PersonaService.php
require_once __DIR__ . '/../modelo/PersonaService.php';

class PersonaService {
    private $model;
    public function __construct() {
        $this->model = new PersonaModel();
    }

    // login: devuelve array usuario si OK, false si no
    public function login(string $usuario, string $password) {
        // Aplica MD5 a la contraseña recibida
        $password_md5 = md5($password);

        $persona = $this->model->loginPersona($usuario, $password_md5);
        if ($persona) {
            return $persona; // aquí ya no viene la clave
        }
        return false;
    }

    // registro completo: inserta persona y luego relaciones
    public function registrarPersona(array $personaData, ?array $docs=null, ?array $tels=null, ?array $dirs=null) {
        // aplicar MD5 a la clave
        $personaData['clave'] = md5($personaData['clave']);

        // aquí asumo que $personaData['clave'] ya viene hasheada
        $newId = $this->model->insertPersona($personaData);
        if ($newId <= 0 || empty($newId)) {
            throw new Exception("No se pudo insertar persona");
        }
        $this->model->insertRelaciones($newId, $docs, $tels, $dirs);
        return $newId;
    }
}
