<?php
/**
 * Description of Anunciante
 *
 * @author MARTIN
 */
class Anunciante {
    private $id;/**/
    private $nif;/**/
    private $nombre;/**/
    private $apellidos;/**/
    private $telefono;/**/
    private $email;/**/
    
    function __construct($id=NULL, $nif=NULL, $nombre=NULL, $apellidos=NULL, $telefono=NULL, $email=NULL) {
        $this->id = $id;
        $this->nif = $nif;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->email = $email;
    }
    
    function set($datos, $inicio = 0) {
        $this->id = $datos[0+$inicio];
        $this->nif = $datos[1+$inicio];
        $this->nombre = $datos[2+$inicio];
        $this->apellidos = $datos[3+$inicio];
        $this->telefono = $datos[4+$inicio];
        $this->email = $datos[5+$inicio];
    }

    public function getId() {
        return $this->id;
    }

    public function getNif() {
        return $this->nif;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNif($nif) {
        $this->nif = $nif;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

}
