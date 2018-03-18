<?php
class SQLite_core{

    public function __construct()
    {
         $this->positioncontrol = 1;
    }

    public function SQLite3_Create_File(){
        $this->SQLite3_File = new PDO('sqlite:../app/data/data.sqlite3');
		$this->SQLite3_File->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
    }

    public function SQLite3_Create_Table(){
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
	
	public function  SQLite3_Delete_Table(){
	$this->SQLite3_File_Delete = $this->SQLite3_File->query('DROP TABLE TS3DATA');
	}
	
	public function SQLite3_Count_ServerClients($data){
	$this->countserverbans = cout($data);	
	}
	
	public function SQLite3_Count_FileClients(){
	$this->SQLite3_File_Query_Result = $this->SQLite3_File->query('SELECT * FROM TS3DATA');	
	$rows = $this->SQLite3_File_Query_Result->fetchAll();
	$this->countfilebans = count($rows);	
	}
	
	public function SQLite3_Save_New_Client($data){
    $this->SQLite3_File_Query_Control_Result = $this->SQLite3_File->query('SELECT banid FROM TS3DATA');	
    $FILEDATA=$this->SQLite3_File_Query_Control_Result->fetchAll();
	$SERVERDATA=$data;
	$this->SQLite3_Count_ServerClients($data);
		/*for($x=0;$x!=$this->countserverbans;$x++){
			if($FILEDATA[$x][0]){
				
			}else{
				Přidáme nový záznam
			}
		}*/
		
	}

    public function SQLite3_Save_Data($data){
		$this->SQLite3_Count_FileClients();
	    if(!$this->countfilebans == 0){
		     }else{
                 $this->SQLite3_Delete_Table();
                 $this->SQLite3_Create_Table();
			     $this->SQLite3_Data_Save_First($data);
       }
    }
	

	public function SQLite3_Data_Save_First($data){
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

	public function SQLite3_View_Data(){
		echo "<font class=numberofbans><center>Bans: ".$this->countfilebans."</center></font><br>";

        $this->SQLite3_File_Query_Result = $this->SQLite3_File->query('SELECT * FROM TS3DATA');

		foreach ($this->SQLite3_File_Query_Result as $dataview){

			 if (empty($dataview['reason'])) {
                $reason = "The reason was not given";
            } else {
                $reason = $dataview['reason'];
            }
            if (empty($dataview['uid'])) {
            } else {
                $uid = $dataview['uid'];
            }
            if (empty($dataview['ip'])) {
            } else {
                $ip = $dataview['ip'];
            }
            if ($dataview['lastnickname']==":null") {
                $nickname = "Asshole";
            } else {
                $nickname = $dataview['lastnickname'];
            }
            if ($dataview['duration'] == 0) {
                $expires = "Permanent";
                $stav = "<font color='red'>Banned</font>";
            } else {
                $expires = date('d-m-Y H:i:s', $dataview['created'] + $dataview['duration']);
                if(date('d-m-Y H:i:s') > $expires){
                    $stav = "<font color='green'>Unbanned</font>";
                }else{
                    $stav = "<font color='red'>Banned</font>";
                }
            }
			echo '<tr id=row>';
	        echo '<td>' . $dataview['banid'] . '</td>';
            echo '<td>' . $dataview['lastnickname'] . '</td>';
            if(empty($ip)){
                echo '<td>'  . $uid . '</td>';
            }else{
                echo '<td>' . $ip . '/' . $uid . '</td>';
            }
            echo '<td>' . $expires . '</td>';
            echo '<td>' . $dataview['invokername'] . '</td>';
            echo '<td>' . $reason . '</td>';
            echo '<td>' . $stav . '</td>';
            echo '</tr>';
       }
    }
}


?>
