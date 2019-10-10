<?php
/* Controller
 * App\Controller;
 * 
 * Control for calling core sets in layout
 */
require 'core.php';

class TeamSpeak3_Controller{

    public static $Languages;
    public $TeamSpeak3_Core;
    
    public function __construct()
    {
        $this->TeamSpeak3_Core = new TeamSpeak3_Core();
        self::$Languages = $this->TeamSpeak3_Core->TeamSpeak3_Core_Language();
    }


    
    public function TeamSpeak3_Banlist_Controller(){
        $this->TeamSpeak3_Core->TeamSpeak3_Core_Banlist();
    }

}

?>