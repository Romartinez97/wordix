<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/


/*Lagos, Fernando. Legajo FAI-2579. Tecnicatura Universitaria en Desarrollo Web. Mail: fernando.lagos@est.fi.uncoma.edu.ar. Github: FernandoLagos05
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
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "ACERO", "BALDE", "TAZAS", "JAULA", "ZORRO"
    ];

    return ($coleccionPalabras);
}


/* ... COMPLETAR ... */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:

$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
