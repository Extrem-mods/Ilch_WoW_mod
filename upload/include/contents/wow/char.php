<?php
defined ('main') or die ( 'no direct access' );
/** Gibt eine Meldung aus, das kein entsprechender Char gefunden wurde.
 */

if($menu->get(2) != NULL){    //ein char ausgewählt
if(is_numeric($menu->get(2))){ //cID gegegben   
$char = new Char($menu->get(2)); 
}elseif($menu->get(3)!= NULL){   //realm/name gegeben
$char = new Char($menu->get(3), $menu->get(2));
}else{
//kein Char gefunden
}
}else{
//kein Char gefunden
}
