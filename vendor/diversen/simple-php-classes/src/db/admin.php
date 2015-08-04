<?php

namespace diversen\db;
use diversen\db;
use diversen\conf as conf;
/**
 * File contains comon methods when working in db adin mode. 
 * @package db 
 */

/**
 * dbadmin 
 * @package db
 */
class admin {
    
    /**
     * changes database we are working on
     * @param string $database
     */
    public static function changeDB ($database = null) {
        $db = new db();
        if (!$database) {
            $db_curr = self::getDbInfo(); 
            $database = $db_curr['dbname'];  
        }
        $sql = "USE `$database`";
        $db->rawQuery($sql);
    }
    
    /**
     * gets database info from cinfuguration
     * @return array $ary array ('name' => 'my_db, 'host' => 'localhost')
     */
    public static function getDbInfo($url = null) {
        if (!$url) {
            $url = conf::$vars['coscms_main']['url']; ;
        }
        
        $url = parse_url($url);
        $ary = explode (';', $url['path']);
        foreach ($ary as $val) {
            $a = explode ("=", $val);
            if (isset($a[0], $a[1])) {
                $url[$a[0]] = $a[1];
            }
        }
        return $url;

    }
    
    /**
     * dublicate a table 
     * @param string $source source table name
     * @param string $dest destination table name
     * @param boolean $drop should we drop table if destination exists 
     * @return boolean $res result of query
     */
    public static function dublicateTable ($source, $dest, $drop = true) {
        $db = new db();
        if ($drop) {
            $sql = "DROP TABLE IF EXISTS $dest";
            $res = self::rawQuery($sql);
            if (!$res) {
                return false;
            }
        }
        $sql = "CREATE TABLE $dest LIKE $source; INSERT $dest SELECT * FROM $source";
        return $db->rawQuery($sql);
    }
    
    /**
     * Alter table to include a full text index
     * @param string $table
     * @param string $columns (e.g. firstname, lastname)
     * @return boolean $res result
     */
    public static function generateIndex($table, $columns) {
        $db = new db();
        $sql = "ALTER TABLE $table ENGINE = MyISAM";
        $res =  $db->rawQuery($sql);
        if (!$res) {
            return false;
        }
        
        $cols = implode(',', $columns);
        $sql = "ALTER TABLE $table ADD FULLTEXT($cols)";
        return $db->rawQuery($sql);
    }
    
    /**
     * check if a table with specified name exists
     * @param string $table
     * @return array $rows
     */
    public static function tableExists($table) {
        $db = new db();
        $q = "SHOW TABLES LIKE '$table'";
        $rows = $db->selectQueryOne($q);
        return $rows;
    }
    
    /**
     * get indexes on the table
     * @param string $table the table name
     * @return array $rows
     */
    public static function getKeys ($table) {
        $q = "SHOW KEYS FROM $table";
        $db = new db();
        $rows = $db->selectQuery($q);
        return $rows;
    }
    
    /**
     * check if a specified key exists
     * 
     */
    public static function keyExists ($table, $key) {
        $db = new db();
        $q = "SHOW KEYS FROM $table WHERE Key_name='$key'";
        $rows = $db->selectQueryOne($q);
        return $rows;
    }
    
    /**
     * clone a complete database
     * @param string $database
     * @param string $newDatabase
     * @return boolean $res
     */
    public static function cloneDB($database, $newDatabase){
        $db = new db();
        $rows = $db->selectQuery('show tables');
        $tables = array();
        foreach ($rows as $table) {
            $tables[] = array_pop($table);
        }

        $db->rawQuery("CREATE DATABASE `$newDatabase` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
        foreach($tables as $cTable){
            self::changeDB ( $newDatabase );
            $create     =   $db->rawQuery("CREATE TABLE $cTable LIKE ".$database.".".$cTable);
            if(!$create) {
                $error  =   true;
            }
            $db->rawQuery("INSERT INTO $cTable SELECT * FROM ".$database.".".$cTable);
        }
        return !isset($error) ? true : false;
    }
    
    /**
     * creates a database from config params (url, password, username)
     * @param array $options
     * @return int $res result from exec operation
     */
    public static function createDB ($options = array()) {
        
        $db = self::getDbInfo();
        $command = 
            "mysqladmin -u" . conf::$vars['coscms_main']['username'] .
            " -p" . conf::$vars['coscms_main']['password'] . " -h$db[host] ";

        $command.= "--default-character-set=utf8 ";
        $command.= "CREATE $db[dbname]";
        return $ret = cos_exec($command, $options);
    }
}
