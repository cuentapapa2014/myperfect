<?php

/**
 * Description of ModeloAnuncio
 *
 * @author MARTIN
 */
class ModeloAnuncio {

    //put your code here
    private $bd;
    private $tabla = "anuncios";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function add(Anuncio $objeto) {
        $sql = "INSERT INTO $this->tabla VALUES(null,:titulo,:descripcion,:producto,:metros,:habitaciones, :aseos,"
                . "                             :calle,:numero,:planta,:localidad,:provincia,:operacion,:precio, :idanunciante)";
        $params["titulo"] = $objeto->getTitulo();
        $params["precio"] = $objeto->getPrecio();
        $params["producto"] = $objeto->getProducto();
        $params["operacion"] = $objeto->getOperacion();
        $params["metros"] = $objeto->getMetros();
        $params["habitaciones"] = $objeto->getHabitaciones();
        $params["aseos"] = $objeto->getAseos();
        $params["descripcion"] = $objeto->getDescripcion();
        $params["calle"] = $objeto->getCalle();
        $params["numero"] = $objeto->getNumero();
        $params["planta"] = $objeto->getPlanta();
        $params["localidad"] = $objeto->getLocalidad();
        $params["provincia"] = $objeto->getProvincia();
        $params["idanunciante"] = $objeto->getIdAnunciante();
        //$params["cp"] = $objeto->getCp();
        //$params["idanunciante"] = $objeto->getCp();
        $r = $this->bd->setConsulta($sql, $params);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //0
    }

    function delete(Anuncio $objeto) {
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
        return $this->delete(new Anuncio($id));
    }

    function edit(Anuncio $objeto) {
        $sql = "update $this->tabla set titulo=:titulo,descripcion=:descripcion, producto=:producto, metros=:metros,"
                . "habitaciones=:habitaciones, aseos=:aseos, calle=:calle, numero=:numero, planta=:planta, localidad=:localidad,"
                . "provincia=:provincia, operacion=:operacion, precio=:precio, id_anunciante=:idanunciante where id=:id;";
        $params["titulo"] = $objeto->getTitulo();
        $params["descripcion"] = $objeto->getDescripcion();
        $params["producto"] = $objeto->getProducto();
        $params["metros"] = $objeto->getMetros();
        $params["habitaciones"] = $objeto->getHabitaciones();
        $params["aseos"] = $objeto->getAseos();
        $params["calle"] = $objeto->getCalle();
        $params["numero"] = $objeto->getNumero();
        $params["planta"] = $objeto->getPlanta();
        $params["localidad"] = $objeto->getLocalidad();
        $params["provincia"] = $objeto->getProvincia();
        $params["operacion"] = $objeto->getOperacion();
        $params["precio"] = $objeto->getPrecio();
        $params["idanunciante"] = $objeto->getIdAnunciante();
        $params["id"] = $objeto->getId();
        $r = $this->bd->setConsulta($sql, $params);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //0
    }

    function editPK(Persona $objetoOriginal, Persona $objetoNuevo) {
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
            $anuncio = new Anuncio();
            $anuncio->set($this->bd->getFila());
            return $anuncio;
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
        //$principio = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderby";
        //$sql = "select * from $this->tabla where $condicion order by $orderby limit $principio,$rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $anuncio = new Anuncio();
                $anuncio->set($fila);
                $list[] = $anuncio;
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
