<?php

/**
 * Clase Leer
 * 
 * @version 0.9
 * @author izv
 * @license http://...
 * @copyright izv by 2daw
 * 
 * Esta clase dispone de metodos estaticos que se utilizan para la lectura de
 *  parametros de entranda a traves de get y post
 * 
 */
class Leer {
    /**
     * Trata de leer el parametro de entrada que se pasa como argumento.
     * @access public
     * @param string $param cadena con el nombre del parametro
     * @return Devuelve una cadena con el valor del parametro, null si el 
     * parametro no se ha pasado y un array si en parametro es multiple.
     */
    public static function get($param, $filtrar=true) {

        //leer datos get
        if (isset($_GET[$param])) {//comprobamos si esta el parametro
            $v = $_GET[$param];
            if (is_array($v)) {
                return Leer::leerArray($v);
            } else {
                if($filtrar){
                return Leer::limpiar($v);
                }
                else{
                    return $v;
                }
            }
        } else {
            return NULL; //devolvemos nulo
        }
    }

    public static function isArray($param, $filtrar=true) {
        if (isset($_GET[$param])) {//comprobamos si esta el parametro
            return is_array($_GET[$param]); //devolvemos un array
        } elseif (isset($_POST[$param])) {
            return is_array($_POST[$param]);
        }
        return NULL;
    }

    public static function isArrayV2($param) {
        return is_array(Leer::request($param));
    }

    private static function leerArray($param, $filtrar=true) {
        $array = array();
        foreach ($param as $key => $value) {//recorremos el array y guardamos los datos limpios
            $array[] = Leer::limpiar($value);
        }
        return $array;
    }

    //leer datos post
    public static function post($param, $filtrar=true) {
        if (isset($_POST[$param])) {//comprobamos si esta el parametro
            $v = $_POST[$param];
            if (is_array($v)) {
                return Leer::leerArray($v);
            } else {
                if($filtrar){
                    return Leer::limpiar($v);
                }else{
                    return $v;
                }
            }
            
        } else {
            return NULL; //devolvemos nulo
        }
    }

    //leer datos request
    public static function request($param, $filtrar=true) {
        $v = Leer::get($param);
        if ($v == NULL) {
            $v = Leer::post($param);
        }
        return $v;
    }

    private static function limpiar($param) {
        return $param;
    }

}
