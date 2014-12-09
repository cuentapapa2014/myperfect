<?php

/**
 * Description of BaseDatos
 *
 * @author Usuario
 */
class BaseDatos {
    //conexion BBDD
    private $conexion = null;
    //N�mero del �ltimo registro insertado
    private $autonumerico = 0;
    //Cursor de una consulta
    private $sentencia = null;
    //N�mero de filas afectadas
    private $numFilas = 0;
    //Resultado de una transaccion
    private $transaccion = null;

    //Constructor que abre la conexion
    function __construct() {
        try{
        $this->conexion = new PDO(
                'mysql:host=' . Configuracion::SERVIDOR . ';dbname=' . Configuracion::BD, Configuracion::USUARIO, Configuracion::CLAVE, array(
            PDO::ATTR_PERSISTENT => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
        );
        }catch( PDOException $e){
            $this->conexion = null;
        }
    }
    //M�todo para cerrar la conexion
    public function closeConesxion() {
        $this->conexion = null;
        //return true;
    }
    
    //M�todo que devuelve el �ltimo id de un registro insertado
    public function getAutonumerico() {
        return $this->conexion->lastInsertId();
    }

    //M�todo que devuelve una fila de un resultado
    public function getFila() {
        if($this->sentencia != null){
            return $this->sentencia->fetch();
        }
        return false;//null
    }

    //M�todo que devuelve el n�mero de filas afectadas en una operacion
    public function getNumFilas() {
        if($this->sentencia!=null){
        return $this->sentencia->rowCount();
        }
            return -1;
        
    }

    //M�todo para devolver el estado de la conexion a la base de datos
    public function isConectado() {
        return $this->conexion!=null;
    }
    
    
    function setBaseDatos($baseDatos){
        return $this->conexion->query("use $baseDatos")!=null;
    }
    
    //M�todo para realizar una consulta preparada
    //Se pasan como par�metros la consulta y un array asociativo
    public function setConsulta($consulta, $parametros) {
        $this->sentencia = $this->conexion->prepare($consulta);
        foreach ($parametros as $key => $value) {
            $this->sentencia->bindValue($key, $value);
        }
        return $this->sentencia->execute();
        //return $this->getNumFilas();
    }

    //M�todo para realizar una consulta preparada con parametros posicionales
    //Se pasan como par�metros la consulta y un array indexado
    public function setConsultaPreparada($consulta, $parametros=array()) {
        $this->sentencia = $this->conexion->prepare($consulta);
        for ($i = 0; $i <= count($parametros); $i++) {
            $this->sentencia->bindValue($i+1, $parametros[$i]);
        }
        return $this->sentencia->execute();
    }
    
    //M�todo para realizar una consulta SQL
    //Se pasan como par�metros la consulta y un array (puede ser indexado o asociativo)
    public function setConsultaSQL($consulta) {
        /*foreach ($parametros as $key => $value) {
            $consulta = +"'$value', ";
        }*/
        //$consulta = substr($consulta, 0, -1);
        //$consulta+=");";
        $this->sentencia = $this->conexion->query($consulta);
        return $this->sentencia;
    }
    //M�todo que prepara una transaccion
    //Se le pasan como par�metros un array de sentencias y un array bidimensional de par�matros
    public function setTransaction() {
        $this->transaccion->beginTransaction();
        /*for($i=0; $i<count($sentencias);$i++){
            $this->setConsulta($sentencias[i], $parametros[i]);
        }*/
    }
    //M�todo que anula una transaccion
    public function anulaTransaccion() {
        $this->transaccion->rollBack();
        /*$this->transaccion=null;
        return true;*/
    }
    
    public function setTransaccion($sentencias, $parametros){
        $this->setTransaction();
        $error = false;
        foreach ($sentencias as $key => $value) {
            $r = $this->setConsulta($value, $parametros[$key]);
            if($r===false || $this->getNumFilas()<1){
                $error = true;
                break;
            }
        }
        if($error){
            $this->anulaTransaccion();
            return false;
        } else {
            $this->validaTransaccion();
            return true;
        }
    }
    
    //M�todo que ejecuta una transaccion
    public function validaTransaccion() {
        /*if(!trans){*/
            $this->transaccion->rollBack();
        //    $this->transaccion = null;
        //    return false;
       // }
        //$this->transaccion->commit();
        //$this->transaccion = null;
        return true;
    }
}
