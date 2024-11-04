<?php
    //  vamos a crear una funcion que reciba la temperatura, la unidad
    //  inicial y la final, y devuelva la temperatura final
    //  hay que completar la función
    function convertirTemperatura(int|float $temperaturaInicial, int|float $unidadInicial, int|float $unidadFinal) : int|float {
        $temperaturaFinal = $temperaturaInicial;

        if($unidadInicial == "C") {
            if($unidadFinal == "K") {
                $temperaturaFinal = $temperaturaInicial + 273.15;
            } elseif($unidadFinal == "F") {
                $temperaturaFinal = ($temperaturaInicial * (9/5)) + 32;
            }
        } elseif($unidadInicial == "K") {
            if($unidadFinal == "C") {
    
            } elseif($unidadFinal == "F") {
    
            }
        } elseif($unidadInicial == "F") {
            if($unidadFinal == "C") {
                
            } elseif($unidadFinal == "K") {
    
            }
        }
        /* echo "<p>$temperaturaFinal</p>"; */
        return $temperaturaFinal;
    }
?>