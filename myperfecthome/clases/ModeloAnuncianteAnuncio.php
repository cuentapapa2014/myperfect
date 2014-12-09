<?php
/**
 * Description of ModeloAnuncianteAnuncio
 *
 * @author MARTIN
 */
class ModeloAnuncianteAnuncio {
    //put your code here
    private $bd;
    private $tabla1 = "anunciantes";
    private $tabla2 = "anuncios";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function getCount($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        $resultado = $this->bd->getFila();
        return $resultado[0];
//        return $r;
    }

    function getList($pagina = 0, $rpp = 10, $condicion = "1=1", $parametros = array(), $orderby = "1") {
        $list = array();
        //paginacion
        $principio = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby limit $principio,$rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $persona = new Persona();
                $persona->set($fila);
                $list[] = $persona;
            }
        } else {
            return NULL;
        }

        return $list;
    }

    //
    function celltHtml($id, $name, $condicion, $parametros, $orderby = "1", $valorSeleccionado = "", $blanco = true, $textoBlanco = "&nbsp;") {
        $select = "<select name='$name' id='$id'>";
        if ($blanco) {
            $select.="<option value=''>$textoBlanco;</option>";
        }
        $lista = $this->getList($condicion, $parametros, $orderby);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getId() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select.="<option $selected value='" . $objeto->getId() . "'>" . $objeto->getApellido() . "," . $objeto->getNombre() . "</option>";
        }
        $select.="</select>";
        return $select;
    }
}
