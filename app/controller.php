<?php
/**
 * Created by PhpStorm.
 * User: zdene
 * Date: 23.02.2018
 * Time: 12:00
 */
require_once ("core.php");

class TeamSpeak3_Controller{

    public $TeamSpeak3_Core;
    public function __construct()
    {
    }

    public function TeamSpeak3_Banlist_Controller(){
        $this->TeamSpeak3_Core = new TeamSpeak3_Core();
        $this->TeamSpeak3_Core->TeamSpeak3_Core_Banlist();

    }

}

?>