<?php
/* Controller
 * App\Controller;
 * 
 * Control for calling core sets in layout
 */
namespace Application\Main;
use Application\Main\TeamSpeak3_Core;

class TeamSpeak3_Controller{

    public $Language;
    public $TeamSpeak3_Core;
    public function __construct()
    {
    }

    public function TeamSpeak3_Banlist_Controller(){
        $this->TeamSpeak3_Core = new TeamSpeak3_Core();
        $this->TeamSpeak3_Core->TeamSpeak3_Core_Banlist();
        $this->Language = $this->TeamSpeak3_Core->TeamSpeak3_Core_Language();
    }

}

?>