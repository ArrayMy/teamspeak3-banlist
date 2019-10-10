<?php
/* ConfigParser
 * App\ConfigParser;
 * 
 *  Parse .ini file
 */
class ConfigParser{
    
    public function __construct() {
    }
    
    public function configparse(){
         $config = parse_ini_file("../cfg/config.ini");
         return $config;
    }
}
