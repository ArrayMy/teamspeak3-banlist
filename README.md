# TeamSpeak3_Banlist
Teamspeak3 Banlist with Administration in TeamSpeak 3 PHP Framework.

Graphically Designed by [DAWE Graphics](https://github.com/DV2013DAWE).

### Tutorial
* Install SQLite3 

Debian/Ubuntu:
`apt-get install php-sqlite3`

Fedora:
`dnf install php-sqlite3`

ArchLinux:
`pacman -S php-sqlite3`

Windows:
[How To Download & Install ](http://www.sqlitetutorial.net/download-install-sqlite)

* Edit the data in */cfg/config.ini*
* Import files with folders into your web server's storage
* Folder *cfg* , *app* and *lib* must be placed under the folder in which the banlist. For example, the site (www/) will be in */var/www/banlist/* so the contents of the cfg must be in the */var/www/cfg/* (Safety reasons!)
* Grant permissions
`chgrp www-data app/data`
`chmod g+w app/data`
***
### Next release
* Banlist administration
* Delete/Add bans
* More information for each record
* I recommend using a newer version! [All Version](https://github.com/ArrayMy/TeamSpeak3_Banlist/releases)
***

### Display
![alt text](https://ts3banlist.zevl-team.tk/banlist.png "TS3-BANLIST")

