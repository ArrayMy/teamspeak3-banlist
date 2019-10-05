<?php
class SQLite_core
{

    public $countfilebans;
    public $SQLite3_File_Query_Result;
    public $SQLite3_File;
    public $SQLite3_File_Query_Control_Result;

    public function __construct()
    {
        //$this->positioncontrol = 1;
    }


    public function SQLite3_Delete_Table()
    {
        $this->SQLite3_File_Delete = $this->SQLite3_File->query('DROP TABLE TS3DATA');
    }

    public function SQLite3_Count_ServerClients($data)
    {
        $this->countserverbans = count($data);
    }

    public function SQLite3_Count_FileClients()
    {
        $this->SQLite3_File_Query_Result = $this->SQLite3_File->query('SELECT * FROM TS3DATA');
        $rows = $this->SQLite3_File_Query_Result->fetchAll();
        $this->countfilebans = count($rows);
    }

    public function parse_config()
    {
        $config = parse_ini_file("_DIR_ . \"/../../cfg/config.ini");
        return $config;
    }

    public function SQLite3_Save_Data($data)
    {
        $config = $this->parse_config();
        $this->SQLite3_Count_ServerClients($data);
        $this->SQLite3_Count_FileClients();
        if ($this->countfilebans == 0){
            $this->SQLite3_Delete_Table();
            $this->SQLite3_Create_Table();
            $this->SQLite3_Data_Save_First($data);
        } elseif (time() - filemtime('../app/data/data.sqlite3') > $config['refresh_interval']) {
            $this->Server_Query_Difference($data);
        } else {
            return 0;
        }
    }

    public function Server_Query_Difference($data)
    {
        $this->SQLite3_File_Query_Result = $this->SQLite3_File->query('SELECT * FROM TS3DATA');
        $table2 = array_column($data, 'banid');
        $table = array_column($this->SQLite3_File_Query_Result->fetchAll(), 'banid');
        $x = 0;
        foreach ($table2 as $some => $some2) {
            if ($some2 != Null) {
                $item = (string)$some2;
                $pole[$x] = $item;
            } else {
                $pole[$x] = Null;
            }
            $x++;
        }
        $dif = array_diff_assoc($pole, $table);
        if(!empty($dif))
        {
            foreach ($dif as $diferentid => $diferent){
            }
            $sql = "SELECT COUNT(*) FROM TS3DATA WHERE banid = ?";
            $stmt = $this->SQLite3_File->prepare($sql);
            $stmt->execute([$diferent]);
            $control = $stmt->fetchColumn();
            if($control > 0){}
            else{
                $sql = "INSERT INTO TS3DATA (banid, ip, name, uid, lastnickname, created, duration, invokername, invokercldbid, invokeruid, reason, enforcements) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
                $stmt = $this->SQLite3_File->prepare($sql);
                $update_data = array(
                    $data[$diferent]['banid'],
                    $data[$diferent]['ip'],
                    $data[$diferent]['name'],
                    $data[$diferent]['uid'],
                    $data[$diferent]['lastnickname'],
                    $data[$diferent]['created'],
                    $data[$diferent]['duration'],
                    $data[$diferent]['invokername'],
                    $data[$diferent]['invokercldbid'],
                    $data[$diferent]['invokeruid'],
                    $data[$diferent]['reason'],
                    $data[$diferent]['enforcements'],
                );
                $stmt->execute($update_data);
            }
        }else
            {

            }
    }
    public function SQLite3_Data_Save_First($data)
    {
        $this->insert = "INSERT INTO TS3DATA (banid, ip, name, uid, lastnickname, created, duration, invokername, invokercldbid, invokeruid, reason, enforcements) VALUES (:banid, :ip, :name, :uid, :lastnickname, :created, :duration, :invokername, :invokercldbid, :invokeruid, :reason, :enforcements)";
        $this->prepare = $this->SQLite3_File->prepare($this->insert);
        $this->prepare->bindParam(':banid', $banid);
        $this->prepare->bindParam(':ip', $ip);
        $this->prepare->bindParam(':name', $name);
        $this->prepare->bindParam(':uid', $uid);
        $this->prepare->bindParam(':lastnickname', $lastnickname);
        $this->prepare->bindParam(':created', $created);
        $this->prepare->bindParam(':duration', $duration);
        $this->prepare->bindParam(':invokername', $invokername);
        $this->prepare->bindParam(':invokercldbid', $invokercldbid);
        $this->prepare->bindParam(':invokeruid', $invokeruid);
        $this->prepare->bindParam(':reason', $reason);
        $this->prepare->bindParam(':enforcements', $enforcements);

        foreach ($data as $datainsert) {
            $banid = $datainsert['banid'];
            $ip = $datainsert['ip'];
            $name = $datainsert['name'];
            $uid = $datainsert['uid'];
            $lastnickname = $datainsert['lastnickname'];
            $created = $datainsert['created'];
            $duration = $datainsert['duration'];
            $invokername = $datainsert['invokername'];
            $invokercldbid = $datainsert['invokercldbid'];
            $invokeruid = $datainsert['invokeruid'];
            $reason = $datainsert['reason'];
            $enforcement = $datainsert['enforcements'];
            $this->prepare->execute();
        }
    }
    public function Top_Banner()
    {
        $y = 2;
        $config = $this->parse_config();
        for($x=1;$y!=null;$x++){
            $name = 'name'.$x;
            $alias = 'alias'.$x;
            if(isset($config[$name]) and isset($config[$alias])){
                $names = explode(",", $config[$alias]);
                foreach ($names as $nick) {
                    $sql = 'UPDATE TS3DATA SET invokername=? WHERE invokername=?';
                    $stmt = $this->SQLite3_File->prepare($sql);
                    $stmt->execute([$config[$name], $nick]);
                }
            }else{
                $y=null;
            }
        }
        $o = 2;
        for($z=1;$o!=null;$z++){
            $name = 'name'.$z;
            if(isset($config[$name])){
            $sql = 'SELECT COUNT(*) FROM TS3DATA WHERE invokername=?';
            $stmt = $this->SQLite3_File->prepare($sql);
            $stmt->execute([$config[$name]]);
            $tops[$z] = $stmt->fetch(PDO::FETCH_ASSOC);
              }else{
                  $o = null;
              }
        }
        foreach ($tops as $top => $cosi){
            $raid[] = $cosi["COUNT(*)"];
        }
        $top_banner = max($raid);
        $i = 2;
        for($p=1;$i!=null;$p++){
            if($top_banner==$tops[$p]["COUNT(*)"]){
                $name = 'name'.$p;
                return array($config[$name],max($raid));
            }
        }

    }
    public function SQLite3_View_Data()
    {
        $winner = $this->Top_Banner();
        echo "<div class=numberofbans>Total bans:  " . $this->countfilebans . "<br>Dominant: <span class=\"font-effect-fire-animation\" style=\"font-size:15px; font-family:Sonsie One;\">". $winner[0] ."</span><br>Dominant bans: ". $winner[1] ."</div>";

        $this->SQLite3_File_Query_Result = $this->SQLite3_File->query('SELECT * FROM TS3DATA');

        foreach ($this->SQLite3_File_Query_Result as $dataview) {
            if (empty($dataview['reason'])) {
                $reason = "The reason was not given";
            } else {
                $reason = $dataview['reason'];
            }
            if (empty($dataview['uid']) or $dataview['uid'] == Null) {
                $uid = Null;
            } else {
                $uid = $dataview['uid'];
            }
            if (empty($dataview['ip']) or $dataview['ip'] == Null) {
            } else {
                $ip = $dataview['ip'];
            }
            if ($dataview['lastnickname'] == NULL and $dataview['name'] == NULL) {
                $nickname = "---";
            } elseif ($dataview['name'] != NULL) {
                $nickname = $dataview['name'];
            } else {
                $nickname = $dataview['lastnickname'];
            }
            if ($dataview['duration'] == 0) {
                $expires = "Permanent";
                $stav = "<font color='red'>Banned</font>";
            } else {
                $expires = date('d-m-Y H:i:s', $dataview['created'] + $dataview['duration']);
                if (date('d-m-Y H:i:s') > $expires) {
                    $stav = "<font color='green'>Unbanned</font>";
                } else {
                    $stav = "<font color='red'>Banned</font>";
                }
            }
            echo '<tr id=row>';
            echo '<td>' . $dataview['id'] . '</td>';
            echo '<td>' . $nickname . '</td>';
            if($ip == Null and $uid != Null){
                echo '<td>' . $uid . '</td>';
                $uid = '';
            }elseif($ip != Null and $uid == Null){
                echo '<td>' . $ip . '</td>';
                $ip = '';
            }elseif ($ip == Null and $uid == Null) {
                echo '<td>Neuvedeno</td>';
            }elseif ($ip != Null and $uid != Null)
            {
                echo '<td>' . $uid .'/'. $ip.'</td>';
            }
            echo '<td>' . $expires . '</td>';
            echo '<td>' . $dataview['invokername'] . '</td>';
            echo '<td>' . $reason . '</td>';
            echo '<td>' . $stav . '</td>';
            echo '</tr>';
        }
    }

    public function SQLite3_Create_File()
    {
        $this->SQLite3_File = new PDO('sqlite:../app/data/data.sqlite3');
        $this->SQLite3_File->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function SQLite3_Create_Table()
    {
        $this->SQLite3_File->exec(
            "CREATE TABLE IF NOT EXISTS TS3DATA(
         id INTEGER PRIMARY KEY, 
         banid INTEGER, 
         ip TEXT,
         name TEXT,
         uid TEXT,
         lastnickname TEXT,
         created TEXT,
         duration TEXT,
         invokername TEXT,
         invokercldbid INTEGER,
         invokeruid TEXT,
         reason TEXT,
         enforcements INTEGER)");
    }
}
?>
