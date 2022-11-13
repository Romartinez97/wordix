<?php

/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DEFINICION DE CONSTANTES *******/
/**************************************/
const CANT_INTENTOS = 6;

/*
    disponible: letra que aún no fue utilizada para adivinar la palabra
    encontrada: letra descubierta en el lugar que corresponde
    pertenece: letra descubierta, pero corresponde a otro lugar
    descartada: letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**      (REVISAR SI COMPLETE CORRECTAMENTE)
 *  Solicita un numero entre un Nro minimo y un Nro Maximo
 *  @param int $min
 *  @param int $max
 *  @return int
 */
function solicitarNumeroEntre($min, $max)
{
    //int $numero
    $numero = trim(fgets(STDIN));
    while (!is_int($numero) && !($numero >= $min && $numero <= $max)) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}

/**
 * Escrbir un texto en color ROJO
 * @param string $texto)
 */
function escribirRojo($texto)
{
    echo "\e[1;37;41m $texto \e[0m";
}

/**
 * Escrbir un texto en color VERDE
 * @param string $texto)
 */
function escribirVerde($texto)
{
    echo "\e[1;37;42m $texto \e[0m";
}

/**
 * Escrbir un texto en color AMARILLO
 * @param string $texto)
 */
function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}

/**
 * Escrbir un texto en color GRIS
 * @param string $texto)
 */
function escribirGris($texto)
{
    echo "\e[1;34;47m $texto \e[0m";
}

/**
 * Escrbir un texto pantalla.
 * @param string $texto)
 */
function escribirNormal($texto)
{
    echo "\e[0m $texto \e[0m";
}

/**
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * @param string $texto
 * @param string $estado
 */
function escribirSegunEstado($texto, $estado)
{
    switch ($estado) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal($texto);
            break;
        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde($texto);
            break;
        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo($texto);
            break;
        case ESTADO_LETRA_DESCARTADA:
            escribirRojo($texto);
            break;
        default:
            echo " $texto ";
            break;
    }
}

/**
 * Escribe en pantalla un mensaje de bienvenida. 
 * @param string $usuario
 */
function escribirMensajeBienvenida($usuario)
{
    echo "***************************************************\n";
    echo "** Hola ";
    escribirAmarillo($usuario);
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}


/** 
 * Verifica si una palabra ingresa es correcta
 * @param string $cadena
 * @return boolean 
 */
function esPalabra($cadena)
{
    //int $cantCaracteres, $i, boolean $esLetra
    $cantCaracteres = strlen($cadena);
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]);
        $i++;
    }
    return $esLetra;
}

/**
 *  Leer una palabra de 5 letras
 * @return string
 */
function leerPalabra5Letras()
{
    //string $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = trim(fgets(STDIN));
    $palabra  = strtoupper($palabra);

    while ((strlen($palabra) != 5) || !esPalabra($palabra)) {
        echo "Debe ingresar una palabra de 5 letras:";
        $palabra = strtoupper(trim(fgets(STDIN)));
    }
    return $palabra;
}


/**
 * Inicia una estructura de datos Teclado. La estructura es de tipo: ¿Indexado, asociativo o Multidimensional?
 *@return array
 */
function iniciarTeclado()
{
    //array $teclado (arreglo asociativo, cuyas claves son las letras del alfabeto)
    $teclado = [
        "A" => ESTADO_LETRA_DISPONIBLE, "B" => ESTADO_LETRA_DISPONIBLE, "C" => ESTADO_LETRA_DISPONIBLE, "D" => ESTADO_LETRA_DISPONIBLE, "E" => ESTADO_LETRA_DISPONIBLE,
        "F" => ESTADO_LETRA_DISPONIBLE, "G" => ESTADO_LETRA_DISPONIBLE, "H" => ESTADO_LETRA_DISPONIBLE, "I" => ESTADO_LETRA_DISPONIBLE, "J" => ESTADO_LETRA_DISPONIBLE,
        "K" => ESTADO_LETRA_DISPONIBLE, "L" => ESTADO_LETRA_DISPONIBLE, "M" => ESTADO_LETRA_DISPONIBLE, "N" => ESTADO_LETRA_DISPONIBLE, "Ñ" => ESTADO_LETRA_DISPONIBLE,
        "O" => ESTADO_LETRA_DISPONIBLE, "P" => ESTADO_LETRA_DISPONIBLE, "Q" => ESTADO_LETRA_DISPONIBLE, "R" => ESTADO_LETRA_DISPONIBLE, "S" => ESTADO_LETRA_DISPONIBLE,
        "T" => ESTADO_LETRA_DISPONIBLE, "U" => ESTADO_LETRA_DISPONIBLE, "V" => ESTADO_LETRA_DISPONIBLE, "W" => ESTADO_LETRA_DISPONIBLE, "X" => ESTADO_LETRA_DISPONIBLE,
        "Y" => ESTADO_LETRA_DISPONIBLE, "Z" => ESTADO_LETRA_DISPONIBLE
    ];
    return $teclado;
}

/**
 * Escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
 * @param array $teclado
 */
function escribirTeclado($teclado)
{
    //array $ordenTeclado (arreglo indexado con el orden en que se debe escribir el teclado en pantalla)
    //string $letra, $estado
    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];

    foreach ($ordenTeclado as $letra) {
        switch ($letra) {
            case 'salto':
                echo "\n";
                break;
            default:
                $estado = $teclado[$letra];
                escribirSegunEstado($letra, $estado);
                break;
        }
    }
    echo "\n";
};


/**
 * Escribe en pantalla los intentos de Wordix para adivinar la palabra
 * @param array $estruturaIntentosWordix
 */
function imprimirIntentosWordix($estructuraIntentosWordix)
{
    $cantIntentosRealizados = count($estructuraIntentosWordix);
    $cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];
        echo "\n" . ($i + 1) . ")  ";
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }
        echo "\n";
    }

    for ($i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++) {
        echo "\n" . ($i + 1) . ")  ";
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");
        }
        echo "\n";
    }
    echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/**
 * Dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabra que intenta adivinar la palabra wordix.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * @param string $palabraWordix
 * @param array $estruturaIntentosWordix
 * @param string $palabraIntento
 * @return array estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estructuraIntentosWordix, $palabraIntento)
{
    $cantCaracteres = strlen($palabraIntento);
    $estructuraPalabraIntento = []; /*almacena cada letra de la palabra intento con su estado */
    for ($i = 0; $i < $cantCaracteres; $i++) {
        $letraIntento = $palabraIntento[$i];
        $posicion = strpos($palabraWordix, $letraIntento);
        if ($posicion === false) {
            $estado = ESTADO_LETRA_DESCARTADA;
        } else {
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA;
            } else {
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }
        array_push($estructuraPalabraIntento, ["letra" => $letraIntento, "estado" => $estado]);
    }

    array_push($estruturaIntentosWordix, $estructuraPalabraIntento);
    return $estruturaIntentosWordix;
}

/**
 * Actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @param array $teclado
 * @param array $estructuraPalabraIntento
 * @return array el teclado modificado con los cambios de estados.
 */
function actualizarTeclado($teclado, $estructuraPalabraIntento)
{
    foreach ($estructuraPalabraIntento as $letraIntento) {
        $letra = $letraIntento["letra"];
        $estado = $letraIntento["estado"];
        switch ($teclado[$letra]) {
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[$letra] = $estado;
                break;
            case ESTADO_LETRA_PERTENECE:
                if ($estado == ESTADO_LETRA_ENCONTRADA) {
                    $teclado[$letra] = $estado;
                }
                break;
        }
    }
    return $teclado;
}

/**
 * Determina si se ganó una palabra intento posee todas sus letras "Encontradas".
 * @param array $estructuraPalabraIntento
 * @return bool
 */
function esIntentoGanado($estruturaPalabraIntento)
{
    $cantLetras = count($estructuraPalabraIntento);
    $i = 0;

    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true;
    } else {
        $ganado = false;
    }

    return $ganado;
}

/**
 * Obtine el puntaje de una partida teniendo en cuenta la palabra y el numero de intento
 * @param int $nroIntento
 * @param string $palabra
 * @return int
 */


function obtenerPuntajeWordix($nroIntento, $palabra)
{
    //int , $puntajeInt, $puntajePalabra, $puntajeTotal, $n
    //array , $arrayPalabra
    $puntajeTotal = 0;
    $puntajeIntentos = 0;
    $puntajePalabra = 0;
    if ($nroIntento < 7 )
    {
        switch ($nroIntento){
            case (1):
                $puntajeIntentos = 6;
                break;
            case (2):
                $puntajeIntentos = 5;
                break;
            case (3):
                $puntajeIntentos = 4;
                break;
            case (4):
                $puntajeIntentos = 3;
                break;
            case (5):
                $puntajeIntentos = 2;
                break;
            case (6):
                $puntajeIntentos = 1;
                break;
        }
    }
    $nPalabra = strlen($palabra);
    $vocales = "aeiou";
    $consonantesM = "bcdfghjklm";
    $consonantesP = "nñpqrstwxyz";
    for ($i=0; $i < $nPalabra; $i++) 
    {
       for ($j=0; $j < strlen($vocales); $j++) 
       { 
        if ($palabra[$i] == $vocales[$j]) 
        {
            $puntajePalabra = $puntajePalabra + 1;
        }

       }
       for ($q=0; $q < strlen($consonantesM) ; $q++) 
       { 
        if ($palabra[$i] == $consonantesM[$q]) 
        {
            $puntajePalabra = $puntajePalabra + 2;
        }
       }
       for ($r=0; $r < strlen($consonantesP) ; $r++) 
       { 
        if ($palabra[$i] == $consonantesP[$r]) 
        {
            $puntajePalabra = $puntajePalabra + 3;
        }
       }
    }
    $puntajeTotal = $puntajeIntentos + $puntajePalabra;
    return $puntajeTotal;

}

/**
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix($palabraWordix, $nombreUsuario)
{
    /*Inicialización*/
    $arregloDeIntentosWordix = [];
    $teclado = iniciarTeclado();
    escribirMensajeBienvenida($nombreUsuario);
    $nroIntento = 1;
    do {

        echo "Comenzar con el Intento " . $nroIntento . ":\n";
        $palabraIntento = leerPalabra5Letras();
        $indiceIntento = $nroIntento - 1;
        $arregloDeIntentosWordix = analizarPalabraIntento($palabraWordix, $arregloDeIntentosWordix, $palabraIntento);
        $teclado = actualizarTeclado($teclado, $arregloDeIntentosWordix[$indiceIntento]);
        /*Mostrar los resultados del análisis: */
        imprimirIntentosWordix($arregloDeIntentosWordix);
        escribirTeclado($teclado);
        /*Determinar si la plabra intento ganó e incrementar la cantidad de intentos */

        $ganoElIntento = esIntentoGanado($arregloDeIntentosWordix[$indiceIntento]);
        $nroIntento++;
    } while ($nroIntento <= CANT_INTENTOS && !$ganoElIntento);


    if ($ganoElIntento) {
        $nroIntento--;
        $puntaje = obtenerPuntajeWordix();
        echo "Adivinó la palabra Wordix en el intento " . $nroIntento . "!: " . $palabraIntento . " Obtuvo $puntaje puntos!";
    } else {
        $nroIntento = 0; //reset intento
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    $partida = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];

    return $partida;
}
/**
 * funcion encargada de imprimir el menú de opciones con el que el usuario va a interactuar
 * funcion sin parametros actuales, devuelve un valor entero necesario para las otras funciones
 * @return int
 */
function seleccionarOpcion(){

    //ACA VA A IMPRIMIR EL MENU DE OPCIONES
    
    echo "\n -------- MENÚ DE OPCIONES--------\n";
    echo "\n   1) Jugar al Wordix con una palabra elegida";
    echo "\n   2) Jugar al Wordix con una palabra aleatoria";
    echo "\n   3) Mostrar una partida";
    echo "\n   4) Mostrar la primer partida ganadora";
    echo "\n   5) Mostrar resumen de jugador";
    echo "\n   6) Mostrar listado de partidas ordenadas por jugador y palabra";
    echo "\n   7) Agregar una palabra de 5 letras a Wordix";
    echo "\n   8) Salir\n";
    
    do {
        echo "\nIngrese un número del 1 al 8 para elegir la opción: ";
        $opcion = trim(fgets(STDIN));
        if ($opcion <= 0 || $opcion > 8){
            echo "\n¡VALOR NO VALIDO! Por favor ingrese un número valido\n";
        }
    } while ($opcion <= 0 || $opcion > 8);
    
    return $opcion;
}

/**
 * Inicializa una colección de partidas
 * @return array
 */
function cargarPartidas()
{
    $coleccionPartidas = [];
    $coleccionPartidas[0] = ["palabraWordix" => "QUESO","jugador" => "Juan", "intentos" => 1, "puntaje" => 15];
    $coleccionPartidas[1] = ["palabraWordix" => "RASGO","jugador" => "Maria", "intentos" => 2, "puntaje" => 14];
    $coleccionPartidas[2] = ["palabraWordix" => "GATOS","jugador" => "Pedro", "intentos" => 3, "puntaje" => 14];
    $coleccionPartidas[3] = ["palabraWordix" => "MUJER","jugador" => "Juan", "intentos" => 4, "puntaje" => 12];
    $coleccionPartidas[4] = ["palabraWordix" => "FUEGO","jugador" => "Pablo", "intentos" => 5, "puntaje" => 9];
    $coleccionPartidas[5] = ["palabraWordix" => "CASAS","jugador" => "Juan", "intentos" => 7, "puntaje" => 0];
    $coleccionPartidas[6] = ["palabraWordix" => "GOTAS","jugador" => "Ana", "intentos" => 2, "puntaje" => 15];
    $coleccionPartidas[7] = ["palabraWordix" => "HUEVO","jugador" => "Juan", "intentos" => 6, "puntaje" => 8];
    $coleccionPartidas[8] = ["palabraWordix" => "CASAS","jugador" => "Carlos", "intentos" => 7, "puntaje" => 0];
    $coleccionPartidas[9] = ["palabraWordix" => "ZORRO","jugador" => "Carlos", "intentos" => 2, "puntaje" => 16];  
 
    return ($coleccionPartidas);
}

/**
 * Escribe el nombre de un jugador en minúsculas, asegurando que el nombre empiece
 * con una letra
 * @return string
 */
function nombreEnMinusculas(){
    //array $cadenaJugador
    //string $jugador, $jugadorMinusculas
    $cadenaJugador = [];
    $jugadorMinusculas = "";
    echo "Ingrese el nombre del jugador: ";
    $jugador = trim(fgets(STDIN));
    $cadenaJugador = str_split ($jugador);
    while (!(ctype_alpha($cadenaJugador[0]))){
        echo "El nombre no empieza con una letra, ingrese un nombre válido (debe empezar con una letra).";
        $jugador = trim(fgets(STDIN));
        $cadenaJugador = str_split ($jugador);
    }
    $jugadorMinusculas = strtolower ($jugador);
    return $jugadorMinusculas;
}
/**
 * funcion sin retorno que según el usuario, va a devolver los datos de la partida seleccionada de la coleccion de partidas
 * @param array $coleccionPartidas
 * @param int $num
 */
function mostrarPartida($coleccionPartidas, $num){
    // int $valorLimite
    $valorLimite = count ($coleccionPartidas);
        if (($num) <= $valorLimite){
            echo "PARTIDA Wordix número ".($num)." : palabra ". $coleccionPartidas[($num-1)]["palabraWordix"]."\n";
            echo    "Jugador: ".$coleccionPartidas[($num-1)]["jugador"]."\n";
            echo "Puntaje: ".$coleccionPartidas[($num-1)]["puntaje"]."\n";
            if ($coleccionPartidas[($num-1)]["puntaje"] > 0){
                echo "Intento: Adivino la palabra en ".$coleccionPartidas[($num-1)]["intentos"]." intentos\n";
            }else{
                echo "No adivino la palabra";
            }
        
        }
}
/**
 * funcion encargada de actualizar la estructura $coleccionPalabras cada vez que se añade una nueva palabra
 * @param array $coleccionPalabras
 * @return array
 
*/
function agregarPalabra ($array){
    // string $palabra
    $cantElementos = count ($array);
    echo "Ingrese la palabra a añadir: ";
    $palabra = trim(fgets(STDIN));
    $array [$cantElementos] = $palabra;
    return $array;
    
}

function primerPartida ($coleccionPartidas){
$i=-1;
echo  "ingrese el nombre del jugador";
$nombre = trim(fgets(STDIN));
do {
$i++;
    if ($coleccionPartidas [$i]["jugador"] == $nombre && $coleccionPartidas [$i]["puntaje"] > 0){

        echo "el indice de la primera partida ganada es: ",$i;
    } 
    else if ($coleccionPartidas [$i]["jugador"] == $nombre && $coleccionPartidas [$i]["puntaje"] <= 0){
        echo "-1";
    }
    
}  while ($coleccionPartidas [$i]["jugador"] == $nombre ) ;



function resumenJ ($coleccionPartidas){
    echo  "ingrese el nombre del jugador";
    $nom = trim(fgets(STDIN)); 
    $n=count($coleccionPartidas);
    $mayorPuntaje = 0;
    $acum_puntaje = 0;
    $acum_intentos=0;
    for ($i=0; $i<$n ;$i++){
        if ($coleccionPartidas [$i]["jugador"] == $nom ){
            $puntaje=$coleccionPartidas [$i]["puntaje"];
            $acum_puntaje= ($acum_puntaje+$puntaje);
            $intentos=$coleccionPartidas [$i]["intentos"];
            $acum_intentos= ($acum_intentos + $intentos);
            if ($puntaje > $mayorPuntaje){
                $mayorPuntaje = $puntaje;
            }
    
        }
    }
    echo "-----------------------------------";
    echo "nombre del jugador: ".$nom;
    echo "el puntaje total de ".$nom."es: ".$acum_puntaje;
    echo "el mayor puntaje en una partida fue de: ".$mayorPuntaje;
    echo "el total de intentos fue de: ".$acum_intentos;
    echo "-----------------------------------";
    
    
    }
      
    }  
  
