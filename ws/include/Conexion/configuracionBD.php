<?php
/*
 * Variables conexion a BD
 */

if (! DEVELOPER) {
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "aquamundoacapulc");
    define("BD_PASS", "Hola2022+");
    define("BD_DB", "aquamund_acayat2022");
    define("BD_CHARSET", "utf8");
} else {
    
    /* variables de la BD */
    define("BD_HOST", "localhost");
    define("BD_USER", "root");
    define("BD_PASS", "");
    define("BD_DB", "aquamundo");
    define("BD_CHARSET", "utf8");
}


?>