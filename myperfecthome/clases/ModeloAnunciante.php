<?php
/**
 * Description of ModeloAnunciante
 *
 * @author MARTIN
 */
class ModeloAnunciante {
    //put your code here
    //put your code here
    private $bd;
    private $tabla = "anunciantes";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function add(Anunciante $objeto) {
        $sql = "INSERT INTO $this->tabla VALUES(null,:nif,:nombre,:apellidos,:telefono,:email);";
        $params["nif"] = $objeto->getNif();
        $params["nombre"] = $objeto->getNombre();
        $params["apellidos"] = $objeto->getApellidos();
        $params["telefono"] = $objeto->getTelefono();
        $params["email"] = $objeto->getEmail();
        $r = $this->bd->setConsulta($sql, $params);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //0
    }

    function delete(Anunciante $objeto) {
        $sql = "DELETE from $this->tabla where id=:id;";
        $params["id"] = $objeto->getId();
        $r = $this->bd->setConsulta($sql, $params);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //0
    }

    function deletePorId($id) {
        //hemos creado un constructor de persona pasandole el id, haciendo lo mismo que delete, solo que con id.
        return $this->delete(new Anunciante($id));
    }

    function edit(Anunciante $objeto) {
        $sql = "update $this->tabla set nif=:nif,nombre=:nombre,apellidos=:apellidos,telefono=:telefono,email=:email where id=:id;";
        $params["id"] = $objeto->getId();
        $params["nif"] = $objeto->getNif();
        $params["nombre"] = $objeto->getNombre();
        $params["apellidos"] = $objeto->getApellidos();
        $params["telefono"] = $objeto->getTelefono();
        $params["email"] = $objeto->getEmail();
        $r = $this->bd->setConsulta($sql, $params);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //0
    }

    function editPK(Anunciante $objetoOriginal, Anunciante $objetoNuevo) {
        $sql = "update $this->tabla set id=:id nombre=:nombre,apellidos=:apellidos where id=:idpk;";
        $params["nombre"] = $objetoNuevo->getNombre();
        $params["apellido"] = $objetoNuevo->getApellido();
        $params["id"] = $objetoNuevo->getId();
        $params["idpk"] = $objetoOriginal->getId();
        $r = $this->bd->setConsulta($sql, $params);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //0
    }

    function get($id) {
        $sql = "select * from $this->tabla where id=:id;";
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $anunciante = new Anunciante();
            $anunciante->set($this->bd->getFila());
            return $anunciante;
        }
        return NULL;
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
                $anunciante = new Anunciante();
                $anunciante->set($fila);
                $list[] = $anunciante;
            }
        } else {
            return NULL;
        }

        return $list;
    }

    //
    function selectHtml($id, $name, $condicion, $parametros, $orderby = "1", $valorSeleccionado = "", $blanco = true, $textoBlanco = "&nbsp;") {
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