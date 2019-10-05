<?php
/**
 * Created by PhpStorm.
 * User: zdene
 * Date: 23.02.2018
 * Time: 11:59
 */
require_once ("_DIR_ . \"/../../vendor/planetteamspeak/ts3-php-framework/libraries/TeamSpeak3/TeamSpeak3.php");

class ServerQuery
{
    public static $ServerQuery_Login;
    public $ServerQuery_BanList_data=array();

    public function __construct()
    {
        $config = parse_ini_file("_DIR_ . \"/../../cfg/config.ini");
        $this->serverquery_username = $config['serverquery_username'];
        $this->serverquery_password = $config['serverquery_password'];
        $this->teamspeak_ip = $config['teamspeak_ip'];
        $this->teamspeak_port = $config['teamspeak_port'];
        $this->teamspeak_server_port = $config['teamspeak_server_port'];
        /*$this->teamspeak_mysql = $config['teamspeak_mysql'];*/
        $this->data = array();
    }

    public function ServerQuery_Connect(){
        self::$ServerQuery_Login = TeamSpeak3::factory("serverquery://$this->serverquery_username:$this->serverquery_password@$this->teamspeak_ip:$this->teamspeak_port/?server_port=$this->teamspeak_server_port");
    }

    public function ServerQuery_Banlist(){
        $this->data = self::$ServerQuery_Login->banList();
    }

}
?>