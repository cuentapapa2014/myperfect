<?php
/**
 * Description of Anuncio
 *
 * @author MARTIN
 */
class Anuncio {
    private $id;
    private $titulo;/**/
    private $precio;
    private $producto;/**/
    private $operacion;
    private $metros;/**/
    private $habitaciones;/**/
    private $aseos;/**/
    private $descripcion;/**/
    private $calle;
    private $numero;
    private $planta;
    private $localidad;
    private $provincia;
    //private $cp;
    private $idAnunciante;
    function __construct($id=null, $titulo=null, $descripcion=null, $producto=null, $metros=null, $habitaciones=null, $aseos=null,
                         $calle=null, $numero=null, $planta=null, $localidad=null, $provincia=null, $operacion=null, $precio=null,  
                         $idAnunciante=null /*$cp=null*/) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->precio = $precio;
        $this->producto = $producto;
        $this->operacion = $operacion;
        $this->metros = $metros;
        $this->habitaciones = $habitaciones;
        $this->aseos = $aseos;
        $this->descripcion = $descripcion;
        $this->calle = $calle;
        $this->numero = $numero;
        $this->planta = $planta;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        //$this->cp = $cp;
        $this->idAnunciante = $idAnunciante;
    }
    
    function set($datos, $inicio = 0) {
        $this->id = $datos[0+$inicio];
        $this->titulo = $datos[1+$inicio];
        $this->descripcion = $datos[2+$inicio];
        $this->producto = $datos[3+$inicio];
        $this->metros = $datos[4+$inicio];
        $this->habitaciones = $datos[5+$inicio];
        $this->aseos = $datos[6+$inicio];;
        $this->calle = $datos[7+$inicio];
        $this->numero = $datos[8+$inicio];
        $this->planta = $datos[9+$inicio];
        $this->localidad = $datos[10+$inicio];
        $this->provincia = $datos[11+$inicio];
        $this->operacion = $datos[12+$inicio];
        $this->precio = $datos[13+$inicio];
        //$this->cp = $datos[14+$inicio];
        $this->idAnunciante = $datos[14+$inicio];
    }

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getProducto() {
        return $this->producto;
    }

    public function getOperacion() {
        return $this->operacion;
    }

    public function getMetros() {
        return $this->metros;
    }

    public function getHabitaciones() {
        return $this->habitaciones;
    }

    public function getAseos() {
        return $this->aseos;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getCalle() {
        return $this->calle;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getPlanta() {
        return $this->planta;
    }

    public function getLocalidad() {
        return $this->localidad;
    }

    public function getProvincia() {
        return $this->provincia;
    }
    /*
    public function getCp() {
        return $this->cp;
    }
     * */
    public function getIdAnunciante(){
        return $this->idAnunciante;
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

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setProducto($producto) {
        $this->producto = $producto;
    }

    public function setOperacion($operacion) {
        $this->operacion = $operacion;
    }

    public function setMetros($metros) {
        $this->metros = $metros;
    }

    public function setHabitaciones($habitaciones) {
        $this->habitaciones = $habitaciones;
    }

    public function setAseos($aseos) {
        $this->aseos = $aseos;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setCalle($calle) {
        $this->calle = $calle;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setPlanta($planta) {
        $this->planta = $planta;
    }

    public function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }
    /*
    public function setCp($cp) {
        $this->cp = $cp;
    }
     * 
     */
    
    public function setIdAnunciante($idAnunciante) {
       $this->idAnunciante = $idAnunciante; 
    }

}
