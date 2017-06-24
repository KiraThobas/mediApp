<?php

// library for using escaped sql
class DB {

    protected static $db;

    static function getDB() {
        return self::$db;
    }

    // choose database
    static function init($databaseName) {
        //insert MySQL server, user, password
        self/* or DB */::$db = mysqli_connect("mysqlServer", "user", "password");

        if (self::$db == false) {
            throw new Exception("Pripojeni k databazi se nezdarilo. " . mysqli_connect_error());
        }

        mysqli_set_charset(self::$db, "utf8");
        mysqli_select_db(self::$db, $databaseName);
    }

    // do sql request, if it's not valid - throw exception
    // if SELECT - return array of rows
    static function doSql($sql) {
        $result = mysqli_query(self::$db, $sql);

        // wrong sql - false
        if ($result === false) {
            throw new Exception("Spatny sql: (" . $sql . ") Err: " . mysqli_error(self::$db));
        }
        // sql ok, but we don't need any return value (UPDATE, INSERT etc.)
        elseif ($result === true) {
            
        } else {
            // SELECT - return array of rows
            $rows = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    // convert value to sql request
    static function toSql($value, $notnumeric=FALSE) {
        // NULL to 'NULL'
        if (is_null($value)) {
            return "NULL";
        }
        // number to string
        elseif (is_numeric($value) && !$notnumeric) {
            return $value;
        }
        // escape text and add apostrophes
        elseif (is_string($value)) {
            $escape = mysqli_real_escape_string(self::$db, $value);
            return "'$escape'";
        } else {
            throw new Exception("Neznamy datovy typ pro prevod do SQL.");
        }
    }

}
