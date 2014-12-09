<?php
/**
 * Description of Validar
 *
 * @author Usuario
 */
class Validar {
    
    static function isCorreo($v){
        return filter_var($v, FILTER_VALIDATE_EMAIL);
    }
    
    static function isFloat($v){
        return filter_var($v, FILTER_VALIDATE_FLOAT);
    }
    
    static function isNumero($v){
        return filter_var($v, FILTER_VALIDATE_INT);
    }
    
    static function isTelefono($v){
        $expresion = "/[0-9]{9}$/";
        return preg_match($expresion, $v);
    }
    
    static function isURL($v){
        return filter_var($v, FILTER_VALIDATE_URL);
    }
    
    static function isIP($v){
        return filter_var($v, FILTER_VALIDATE_IP);
    }
    
    static function isFecha($v){
        //Formato ingles
        //return preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$v);
        //Formato español
        return preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/",$v);
    }
    
    static function isDNI($v){
        return (preg_match("^\d{8}[a-zA-Z]$", $v));     
    }
    
    static function isDNIValido($v){
        $cadena="TRWAGMYFPDXBNJZSQVHLCKE";
        $letra = substr($v, strlen($v)-1);
        $numero = substr($v, 0, 8);
        if (substr($cadena,($numero%23),1)===$letra) {
            return true;
        }
        return false;
    }


    static function isCP($v){
        $expresion = "/[1-7]{1}+[0-9]{4}$/";
        return preg_match($expresion, $v);
    }
    
    static function isLongitud($v, $lmin){
        return (strlen($v)<$lmin);
    }
    
    static function isScript($v){
        
    }
    
    static function isCondicion($v, $lmin){
    
    }
}
