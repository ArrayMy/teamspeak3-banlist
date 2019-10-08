<?php
/* Core
 * App\Core;
 *  
 * Different sets of banlist operations
 */
require 'serverquery.php';
require 'sqlite.php';
require_once ("_DIR_ . \"/../../vendor/planetteamspeak/ts3-php-framework/libraries/TeamSpeak3/TeamSpeak3.php");


class TeamSpeak3_Core
{

    public $TeamSpeak3_ServerQuery;
    public $ServerQuery_BanList_data;
    public $data;
    public $Language;
    
    public function __construct(){}

    public function TeamSpeak3_Core_Language(){
       $this->Language = new SQLite_core();
       $this->Language = $this->language->generate_language();
       return $this->Language;
    }
    
    public function TeamSpeak3_Core_Save(){
        $Sqlite = new SQLite_core();
        $Sqlite->SQLite3_Create_File();
        $Sqlite->SQLite3_Create_Table();
        $Sqlite->SQLite3_Save_Data();
    }

    public function TeamSpeak3_Core_Banlist(){
	$TeamSpeak3_ServerQuery_check = new ServerQuery();
        $TeamSpeak3_ServerQuery_check->ServerQuery_Connect();
        $TeamSpeak3_ServerQuery_check->ServerQuery_Banlist();
        $Sqlite = new SQLite_core();
        $Sqlite->SQLite3_Create_File();
        $Sqlite->SQLite3_Create_Table();
        $Sqlite->SQLite3_Save_Data($TeamSpeak3_ServerQuery_check->data);
        $Sqlite->SQLite3_View_Data();
		}
}
?>