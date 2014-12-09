<?php
/**
 * Description of Subir
 *
 * @author Martin
 */
class Subir {
    //put your code here
    const RENOMBRAR = 0,
            REEMPLAZAR = 1, //Constantes para la politica de nombres      
            IGNORAR = 2;
    private $input; //almacena la entrada de ficheros que se asigna a la clase al instanciarla--
    private $destino = "."; //almacena la carpeta de destino del fichero--
    private $nombre = ""; //almacena el nombre que se le asignará al fichero--
    private $file;
    private $permisos; //Se utiliza para asignar los permisos en linux cuando se crean las carpetas. En este caso (aunque no es correcto) le doy control total.
    private $accion = self::IGNORAR; //indica la acción que realizará la clase si encuentra un fichero con el mismo nombre--
    private $maximo; //almacena el tamaño máximo del fichero a subir--
    private $extension; //almacena las extensiones de fichero--
    private $tipo; //almacena los tipos de archivos permitidos para subir
    private $error; //almacena el código de error de la operacion--
    private $mensaje_error; //almacena el mensaje de error
    private $pref;
//Constructor al que se le pasan los ficheros a subir
    function __construct($pref ,$nombre) {
        $this->input = $nombre; //obtenemos el nombre del campo file que nos envía los ficheros
        $this->file = $_FILES[$nombre]; //obtenemos el/los archivos que se corresponden de la variable $_FILES
        $this->nombre = ""; //El nombre del fichero lo asigno a cadena vacía
        $this->destino = "../img/"; //La carpeta en la que se almacenarán los ficheros subidos
        $this->maximo = 1024 * 1024 * 2; //Le doy 5MB te tamáño máximo de fichero
        $this->tipo = array(); //Instacio la variable de tipos de ficheros permitidos
        $this->extension = array(); //Instancio la variable de extensiones de fichero permitidas
        $this->crearCarpeta = true; //Permito que se pueda crear la carpeta de destino en caso de no existir
        $this->accion = Subir::IGNORAR; //asigno el valor ignorar en la política de nombres de fichero
        $this->permisos = 777; //Asigno control total de permisos para la carpeta de destino (no es lo correcto).
        $this->pref=$pref;
    }
    //retorna el nombre asignado para guardar los ficheros
    public function getNombre() {
        return $this->nombre;
    }
    //retorna la ruta a la carpeta de destino de los ficheros subidos
    public function getDestino() {
        return $this->destino;
    }
    //retorna el valor de la clase en cuanto a la política de nombres
    public function getAccion() {
        return $this->accion;
    }
    //retorna el valor máximo del tamaño de los ficheros a subir
    public function getMaximo() {
        return $this->maximo;
    }
    //retorna el array de extensiones permitidas eb los ficheros
    public function getExtensiones() {
        return $this->extension;
    }
    //retotna el valor de los permisos asignados a la carpeta destino de los ficheros  
    public function getPermisos() {
        return $this->permisos;
    }
    //Asigna el nombre que se dará al fichero cuando se almacene en la carpeta.
    //Se le pasa como parámetro un string y tras comprobar que no se trata de 
    //variable vacía ni nula los asigna a $nombre
    public function setNombre($nombre) {
        if (!empty($nombre) || $nombre != NULL) {
            $this->nombre = $nombre;
        }
    }
    //Asignamos la carpeta de destino de los ficheros.
    //Comprobamos que el último caracter es /, en caso de no serlo se le concatena
    //recibe como parámetro un string
    public function setDestino($destino) {
        $ultimo = substr($destino, -1);
        if ($ultimo != "/") {
            $destino.="/";
        }
        $this->destino = $destino;
    }
    //Se asigna la accion a realizar en la po´litica de nombress
    //recibe como parámetro una de las constantes declaradas en la clase
    public function setAccion($accion) {
        $this->accion = $accion;
    }
    //Asigna el tamaño máximo de los ficheros a subir
    //recibe como parámetro un número de bytes
    public function setMaximo($maximo) {
        $this->maximo = $maximo;
    }
    //asigna a la clase la opción de crear una carpeta
    //recibe como parámetro un valor bool true=si false=no
    public function setCrearCarpeta($crearCarpeta) {
        $this->crearCarpeta = $crearCarpeta;
    }
    //asigna los permisos que se tendrán en la carpeta de destino de ficheros
    //recibe como parámetro un entero entre 000-777
    public function setPermisos($permisos) {
        $this->permisos = $permisos;
    }
    //asigna las extensiones permitidas para los nombres de fichero
    //recibe como parámetro un string o n array y lo agrega al array de extensiones (puede tener valores duplicados).
    public function addExtension($extension) {
        if (is_array($extension)) {
            $this->extension = array_merge($this->extension, $extension);
        } else {
            $this->extension[] = $extension;
        }
    }
    //asigna los tipos MIME permitidos para los ficheros a subir
    //recibe como parámetro un string o n array y lo agrega al array de tipos (puede tener valores duplicados).
    public function addTipo($tipo) {
        if (is_array($tipo)) {
            $this->tipo = array_merge($this->tipo, $tipo);
        } else {
            $this->tipo[] = $tipo;
        }
    }
    //indica si existe un elemento con el nombre de destino y comprueba si es un directorio
    // retorna un valor bool true=es carpeta false=no es carpeta
    private function isCarpeta() {
        return is_dir($this->destino);
    }
    //crea una carpeta en la ruta indicada
    //recibe la ruta de la carpeta, se asignan llos permisos(para linux), se establece recursividad
    public function crearCarpeta($param) {
        return mkdir($param, $this->permisos, true);
    }
    //retorna la existencia de una extension en el array de extensiones permitidas
    //recibe como parámetro un string y se comprueba sicoincide con los permitidos
    //en caso de que no existan extensiones permitidas no hay restricciones.
    //en caso de haber restringidas devolverá true=si está permitida false=no está permitida
    private function comprobarExtension($extension) {
        if (count($this->extension) > 0) {
            if (in_array($extension, $this->extension)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
    //retorna la existencia de un tipo en el array de tipos permitidos
    //recibe como parámetro un string y se comprueba sicoincide con los permitidos
    //en caso de que no existan tipos permitidos no hay restricciones.
    //en caso de haber restringidos devolverá true=si está permitido false=no está permitido
    private function comprobarTipo($tipo) {
        if (count($this->tipo) > 0) {
            if (in_array($tipo, $this->tipo)) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
    //comprueba que el tamaño pasado como parámetro (en bytes) no excede del máximo permitido
    //retorna true=tam correcto false=tam incorrecto
    private function isTamano($tam) {
        if ($tam < $this->maximo) {
            return true;
        } else {
            return false;
        }
    }
    //realiza la subida de uno o varios ficheros a la carpeta de destino
    public function subir() {
        if (!$this->isCarpeta() && $this->crearCarpeta) { //Comprobamos que existe la carpeta de destino
            if (!$this->crearCarpeta($this->destino)) {//si no existe intentamos crearla y en caso de no ser posible (no esté habilitada la opcion) detiene la ejecución retornando false
                return false;
            }
        }
        //iniciamos un bucle para realizar la acción de subir archivos del array $files fichero a fichero
        for ($i = 0; $i < count($this->file['name']); $i++) {
            if ($this->nombre != "") { //comprobamos que el valor de es válido para obtener su pathinfo
                $n = pathinfo($this->destino . $this->nombre); //obtenemos la información del fichero
            } else {
                $n = pathinfo($this->destino . $this->pref.$this->file['name'][$i]); //en caso de que el nombre del fichero sea cadena vacía lo extraemos del array de files
            }
            if (!$this->file['error'][$i] == UPLOAD_ERR_OK) { //En caso de no haberse subido correctamente el fichero devolvemos un false
                return false;
            }
            if (!$this->comprobarExtension($n['extension'])) {//en caso de no estar permitida su extension devolveremos false
                return false;
            }
            if (!$this->isTamano($this->file['size'][$i])) { //en caso de exceder del tamaño máximo retornamos false
                return FALSE;
            }
            //comprobamos la política de nombres
            switch ($this->accion) {
                //En caso de esar marcada la opción de renombrar el fichero, crearemos para poder modificar el nombre concatenándole el sub-guion con el valor del contador
                case Subir::RENOMBRAR:
                    $nuevo = $n['filename'] . "." . $n['extension'];
                    $cont = 1;
                    while (file_exists($this->destino . $nuevo)) {
                        $nuevo = $n['filename'] . "_" . $cont . "." . $n['extension'];
                        $cont++;
                    }
                    if (!move_uploaded_file($this->file['tmp_name'][$i], $this->destino . $nuevo)) {//Si el fichero no se ha subido rtornamos false
                        return false;
                    }
                    break;
                case Subir::REEMPLAZAR:
                    if (!move_uploaded_file($this->file['tmp_name'][$i], $this->destino . $n['filename'] . "." . $n['extension'])) { //intentamos subir el fichero seleccionado
                        return false;                                                                         //Si coincide con uno existente lo elimina y crea uno nuevo
                    }                                                                                       //En caso de no sealizar la subida devuelvo false
                    break;
                default:
                    if (!file_exists($this->destino . $n['filename'] . "." . $n['extension'])) {//Buscamos que el fichero no esté en la carpeta de destino. En caso de existir no se subirá a la carpeta
                        if (!move_uploaded_file($this->file['tmp_name'][$i], $this->destino . $n['filename'] . "." . $n['extension'])) {
                            return false;
                        }
                    }
                    break;
            }
        }
        //Si la operación se ha realizado sin problemas retornamos true
        return true;
    }
}
