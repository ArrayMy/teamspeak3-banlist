<?php

class ConfigParser{
    
    public function __construct() {
        $this->config_parse();
    }
    
    private function config_parse(){
         $config = parse_ini_file("../../cfg/config.ini");
         return $config;
    }
}
