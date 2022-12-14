<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/


/*Lagos, Fernando. Legajo FAI-2579. Tecnicatura Universitaria en Administración de Sistemas y Software Libre. Mail: fernando.lagos@est.fi.uncoma.edu.ar. Github: FernandoLagos05
Irigoyen, Joaquín. Legajo FAI-4223. Tecnicatura Universitaria en Desarrollo Web. Mail: joaquin.iri25@gmail.com. Github: joaquinirigoyen
Martínez Rodrigo. Legajo FAI-4318. Tecnicatura Universitaria en Desarrollo Web. Mail: rodrigo.martinez@est.fi.uncoma.edu.ar. GitHub: Romartinez97
Dominguez, Santiago. Legajo FAI-4244. Tecnicatura Universitaria en Desarrollo Web. Mail: santiago.dominguez@est.fi.uncoma.edu.ar. Github: sdominguez0271*/


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Inicializa una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras[0] = "MUJER";
    $coleccionPalabras[1] = "QUESO";
    $coleccionPalabras[2] = "FUEGO";
    $coleccionPalabras[3] = "CASAS";
    $coleccionPalabras[4] = "RASGO";
    $coleccionPalabras[5] = "GATOS";
    $coleccionPalabras[6] = "GOTAS";
    $coleccionPalabras[7] = "HUEVO";
    $coleccionPalabras[8] = "TINTO";
    $coleccionPalabras[9] = "NAVES";
    $coleccionPalabras[10] = "VERDE";
    $coleccionPalabras[11] = "MELON";
    $coleccionPalabras[12] = "YUYOS";
    $coleccionPalabras[13] = "PIANO";
    $coleccionPalabras[14] = "PISOS";
    $coleccionPalabras[15] = "ACERO";
    $coleccionPalabras[16] = "BALDE";
    $coleccionPalabras[17] = "TAZAS";
    $coleccionPalabras[18] = "JAULA";
    $coleccionPalabras[19] = "ZORRO";

    return ($coleccionPalabras);
}

/**
 * funcion encargada de imprimir el menú de opciones con el que el usuario va a interactuar
 * funcion sin parametros actuales, devuelve un valor entero necesario para las otras funciones
 * @return int
 */
function seleccionarOpcion()
{
    //int $opcion

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
        if ($opcion <= 0 || $opcion > 8) {
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
    //array $coleccionPartidas
    $coleccionPartidas = [];
    $coleccionPartidas[0] = ["palabraWordix" => "QUESO", "jugador" => "juan", "intentos" => 1, "puntaje" => 15];
    $coleccionPartidas[1] = ["palabraWordix" => "RASGO", "jugador" => "maria", "intentos" => 2, "puntaje" => 14];
    $coleccionPartidas[2] = ["palabraWordix" => "GATOS", "jugador" => "pedro", "intentos" => 3, "puntaje" => 14];
    $coleccionPartidas[3] = ["palabraWordix" => "MUJER", "jugador" => "juan", "intentos" => 4, "puntaje" => 12];
    $coleccionPartidas[4] = ["palabraWordix" => "FUEGO", "jugador" => "pablo", "intentos" => 5, "puntaje" => 9];
    $coleccionPartidas[5] = ["palabraWordix" => "CASAS", "jugador" => "juan", "intentos" => 7, "puntaje" => 0];
    $coleccionPartidas[6] = ["palabraWordix" => "GOTAS", "jugador" => "ana", "intentos" => 2, "puntaje" => 15];
    $coleccionPartidas[7] = ["palabraWordix" => "HUEVO", "jugador" => "juan", "intentos" => 6, "puntaje" => 8];
    $coleccionPartidas[8] = ["palabraWordix" => "CASAS", "jugador" => "carlos", "intentos" => 7, "puntaje" => 0];
    $coleccionPartidas[9] = ["palabraWordix" => "ZORRO", "jugador" => "carlos", "intentos" => 7, "puntaje" => 0];

    return ($coleccionPartidas);
}

/**
 * Escribe el nombre de un jugador en minúsculas, asegurando que el nombre empiece
 * con una letra
 * @return string
 */
function nombreEnMinusculas()
{
    //array $cadenaJugador
    //string $jugador, $jugadorMinusculas
    $cadenaJugador = [];
    $jugadorMinusculas = "";
    echo "Ingrese el nombre del jugador: ";
    $jugador = trim(fgets(STDIN));
    $cadenaJugador = str_split($jugador);
    while (!(ctype_alpha($cadenaJugador[0]))) {
        echo "El nombre no empieza con una letra, ingrese un nombre válido (debe empezar con una letra):\n";
        $jugador = trim(fgets(STDIN));
        $cadenaJugador = str_split($jugador);
    }
    $jugadorMinusculas = strtolower($jugador);
    return $jugadorMinusculas;
}

/**
 * funcion sin retorno que según el usuario, va a devolver los datos de la partida seleccionada de la coleccion de partidas
 * @param array $coleccionPartidas
 * @param int $num
 */
function mostrarPartida($coleccionPartidas, $num)
{
    // int $valorLimite
    $valorLimite = count($coleccionPartidas);
    while ($num < 0  || $num > $valorLimite) {
        echo "El número de partida ingresado no existe, intente nuevamente: ";
        $num = trim(fgets(STDIN));
    }
    echo "PARTIDA Wordix número " . ($num) . " : palabra " . $coleccionPartidas[($num - 1)]["palabraWordix"] . "\n";
    echo    "Jugador: " . $coleccionPartidas[($num - 1)]["jugador"] . "\n";
    echo "Puntaje: " . $coleccionPartidas[($num - 1)]["puntaje"] . "\n";
    if ($coleccionPartidas[($num - 1)]["puntaje"] > 0) {
        echo "Intento: Adivino la palabra en " . $coleccionPartidas[($num - 1)]["intentos"] . " intentos\n";
    } else {
        echo "No adivino la palabra";
    }
}

function primerGanadora($coleccionPartidas)
{
    //string $nom
    //int $n, $i, $corte
    $nom = nombreEnMinusculas();
    $n = count($coleccionPartidas);
    $i = 0;
    $corte = 0;
    while (($i < $n) && ($corte == 0)) {
        if (($coleccionPartidas[$i]["jugador"] == $nom) && ($coleccionPartidas[$i]["puntaje"] > 0)) {
            $corte = $corte + 1;
            echo "=================================================" . "\n";
            echo "Partida WORDIX " . ($i + 1) . ": palabra " . $coleccionPartidas[$i]["palabraWordix"] . "\n";
            echo "Jugador: " . $nom . "\n";
            echo "Puntaje: " . $coleccionPartidas[$i]["puntaje"] . "\n";
            echo "Intento: Adivino la palabra en " . $coleccionPartidas[$i]["intentos"] . " intentos" . "\n";
            echo "=================================================" . "\n";
        } else if (($coleccionPartidas[$i]["jugador"] == $nom) && ($coleccionPartidas[$i]["puntaje"] == 0)) {
            $corte = $corte + 1;
            echo "El jugador " . $nom . " no gano ninguna partida ;(" . "\n";
        }
        $i = $i + 1;
    }
    if ($corte == 0) {
        echo "No existe el jugador.\n";
    }
}

/**
 * funcion encargada de actualizar la estructura $coleccionPalabras cada vez que se añade una nueva palabra
 * @param array $coleccionPalabras
 * @return array
 */
function agregarPalabra($coleccion)
{
    //string $palabra
    //int $i
    $palabra = leerPalabra5Letras();
    $i = 0;
    while (($i < count($coleccion))) {
        if ($palabra == $coleccion[$i]) {
            echo "La palabra ya se encuentra en la colección, ingrese una distinta.\n";
            $palabra = leerPalabra5Letras();
            $i = -1;
        }
        $i++;
    }
    return $palabra;
}

/**
 * Arroja el resumen de un jugador ingresado por el usuario
 * @param array $coleccion
 */
function resumenJ($coleccion)
{
    //string $nombre
    //int $totalPartidas, $totalPuntaje, $totalVictorias, $en1Intento, $en2Intentos, $en3Intentos, $en4Intentos, $en5Intentos, $en6Intentos, $i, $j, $intentos   
    $totalPartidas = 0;
    $totalPuntaje = 0;
    $totalVictorias = 0;
    $en1Intento = 0;
    $en2Intentos = 0;
    $en3Intentos = 0;
    $en4Intentos = 0;
    $en5Intentos = 0;
    $en6Intentos = 0;
    $i = 0;
    $j = 0;
    $intentos = 0;
    $nombre = nombreEnMinusculas();
    $auxiliar = 0;
    for ($i = 0; $i < count($coleccion); $i++) {
        if (($coleccion[$i]["jugador"] == $nombre)) {
            $auxiliar = 1;
        }
    }
    if ($auxiliar == 1) {
        for ($j = 0; $j < count($coleccion); $j++) {
            if (($coleccion[$j]["jugador"] == $nombre)) {
                $totalPartidas = $totalPartidas + 1;
                if (($coleccion[$j]["puntaje"]) > 0) {
                    $totalPuntaje = $totalPuntaje + $coleccion[$j]["puntaje"];
                    $totalVictorias = $totalVictorias + 1;
                }
                $intentos = $coleccion[$j]["intentos"];
                switch ($intentos) {
                    case (1):
                        $en1Intento = $en1Intento + 1;
                        break;
                    case (2):
                        $en2Intentos = $en2Intentos + 1;
                        break;
                    case (3):
                        $en3Intentos = $en3Intentos + 1;
                        break;
                    case (4):
                        $en4Intentos = $en4Intentos + 1;
                        break;
                    case (5):
                        $en5Intentos = $en5Intentos + 1;
                        break;
                    case (6):
                        $en6Intentos = $en6Intentos + 1;
                        break;
                }
            }
        }
        if ($totalPartidas == 0) {
            $porcVictorias = 0;
        } else {
            $porcVictorias = ($totalVictorias / $totalPartidas) * 100;
        }
        $resumenJugador = [
            "jugador" => $nombre,
            "partidas" => $totalPartidas,
            "puntaje" => $totalPuntaje,
            "victorias" => $totalVictorias,
            "porcentajeVictorias" => $porcVictorias,
            "intento1" => $en1Intento,
            "intento2" => $en2Intentos,
            "intento3" => $en3Intentos,
            "intento4" => $en4Intentos,
            "intento5" => $en5Intentos,
            "intento6" => $en6Intentos
        ];

        echo "-----------------------------------\n";
        echo "Jugador: " . $nombre . "\n";
        echo "Partidas: " . $totalPartidas . "\n";
        echo "El puntaje total de " . $nombre . " es: " . $totalPuntaje . "\n";
        echo "Victorias: " . $totalVictorias . "\n";
        echo "Porcentaje de victorias: " . $porcVictorias . "% \n";
        echo "Adivinadas:\n";
        echo "  Intento 1: " . $en1Intento . "\n";
        echo "  Intento 2: " . $en2Intentos . "\n";
        echo "  Intento 3: " . $en3Intentos . "\n";
        echo "  Intento 4: " . $en4Intentos . "\n";
        echo "  Intento 5: " . $en5Intentos . "\n";
        echo "  Intento 6: " . $en6Intentos . "\n";
        echo "-----------------------------------";
    } else {
        echo "El jugador " . $nombre . " no jugó ninguna partida.\n";
    }
}


/**
 * Funcion para comparar al usar uasort
 * @param array $partidaUno, $partidaDos
 * @return int
 */

function comparar($partidaUno, $partidaDos)
//int $variableRetorno
{
    $variableRetorno = 0;
    if ($partidaUno['jugador'] < $partidaDos['jugador']) {
        $variableRetorno = -1;
    } else if ($partidaUno['jugador'] > $partidaDos['jugador']) {
        $variableRetorno = 1;
    }
    if ($partidaUno['palabraWordix'] < $partidaDos['palabraWordix']) {
        $variableRetorno = -1;
    } else if ($partidaUno['palabraWordix'] > $partidaDos['palabraWordix']) {
        $variableRetorno = 1;
    }
    return $variableRetorno;
}

/**
 * Ordena una coleccion de partidas por nombre de jugador y por palabra
 * @param array $coleccion
 */
function ordenarColeccion($coleccion)
{
    //array $coleccionOrdenada
    uasort($coleccion, "comparar");
    print_r($coleccion);
}

/**
 * Función para verificar si un jugador ya jugó cierta palabra
 * @param 
 * @return bool
 */

function esRepetida($jugador, $numero, $partidas, $palabras)
{
    //bool $repetida
    $i = 0;
    do {
        if (($jugador == $partidas[$i]["jugador"]) && ($palabras[$numero-1] == $partidas[$i]["palabraWordix"])){
            return true;
            }
        $i++;
    } while ($i < count($partidas));
    return false;
}


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

/*
*Declaración de variables
*string $nombreJugador, $palabra
*int $opcion, $numeroPalabra, $partida, $numeroPartida,
*/

//Inicialización de variables:
$coleccionPartidas = cargarPartidas();
$coleccionPalabras = cargarColeccionPalabras();

//Proceso:
do {
    $opcion = seleccionarOpcion();
    switch ($opcion) {
        case 1:
            //Jugar al Wordix con una palabra elegida
            $nombreJugador = nombreEnMinusculas();
            echo "Elegir un número: ";
            $numeroPalabra = solicitarNumeroEntre(1, count($coleccionPalabras));
            $estaRepetida = esRepetida($nombreJugador, $numeroPalabra, $coleccionPartidas, $coleccionPalabras);
            while ($estaRepetida) {
                echo "El jugador " . $nombreJugador . " ya jugó con esa palabra, ingrese otro número: ";
                $numeroPalabra = solicitarNumeroEntre(1, count($coleccionPalabras));
                $estaRepetida = esRepetida($nombreJugador, $numeroPalabra, $coleccionPartidas, $coleccionPalabras);
            }
            $partida = jugarPartida($numeroPalabra, $nombreJugador, $coleccionPalabras);
            array_push($coleccionPartidas, $partida);
            break;
        case 2:
            //Jugar al Wordix con una palabra al azar
            $nombreJugador = nombreEnMinusculas();
            $numeroPalabra = rand(1, count($coleccionPalabras));
            $estaRepetida = esRepetida($nombreJugador, $numeroPalabra, $coleccionPartidas, $coleccionPalabras);
            while ($estaRepetida == true) {
                $numeroPalabra = rand(1, count($coleccionPalabras));
                $estaRepetida = esRepetida($nombreJugador, $numeroPalabra, $coleccionPartidas, $coleccionPalabras);
            }
            $partida = jugarPartida($numeroPalabra, $nombreJugador, $coleccionPalabras);
            array_push($coleccionPartidas, $partida);
            break;
        case 3:
            //Mostrar una partida
            echo "Ingrese un número de partida: ";
            $numeroPartida = trim(fgets(STDIN));
            mostrarPartida($coleccionPartidas, $numeroPartida);
            break;
        case 4:
            //Mostrar la primer partida ganadora
            primerGanadora($coleccionPartidas);
            break;
        case 5:
            //Mostrar el resumen de un jugador
            resumenJ($coleccionPartidas);
            break;
        case 6:
            //Mostrar el listado de partidas ordenadas por jugador y por palabra
            ordenarColeccion($coleccionPartidas);
            break;
        case 7:
            //Agregar una palabra nueva
            $palabra = agregarPalabra($coleccionPalabras);
            array_push($coleccionPalabras, $palabra);
            break;
    }
} while ($opcion != 8);
echo "FIN DEL PROGRAMA\n";
