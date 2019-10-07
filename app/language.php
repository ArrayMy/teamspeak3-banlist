<?php
/* Content translation class
 * App\Language;
 * 
 * return $language = array(Content);
 */
namespace Application\Main;

class Language {
    
    
        public function generate_language()
    {
        $config = parse_ini_file("_DIR_ . \"/../../cfg/config.ini");
        if($config['lang'] == 'cz')
        {
            $language = array(
                'Celkem: ',
                'Dominuje: ',
                'Počet dominujíciho: ',
                'Potrestán',
                'Odpuštěno',
                'Seznam hříšníků',
                'ID',
                'Jméno',
                'IP/UID',
                'Trvání',
                'Udělil',
                'Důvod',
                'Status'
            );
        }else
            {
                $language = array(
                    'Total bans: ',
                    'Dominant: ',
                    'Dominant bans: ',
                    'Banned',
                    'Unbanned',
                    'Banlist',
                    'ID',
                    'Nickname',
                    'IP/UID',
                    'Duration',
                    'Admin',
                    'Reason',
                    'Status'
                );

            }
        return $language;
    }
    
}
