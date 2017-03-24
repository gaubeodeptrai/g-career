<?php

class DB{
    static public $dbname   = "g-career";
    static public $username = "root";
    static public $passwd   = "123456";
    static public $host     = "localhost";
    static public $port     = "3306";
    static public $charset  = "utf8";
    static public $cn  = 0;
    static public $res = 0;
    static public $err = array();

    function connect(){
        $opt = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.DB::$charset,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY  => false,    // バッファしない命令。バッファしない分、速くなる。バッファしないので使い回しできなくなる。
        PDO::ATTR_EMULATE_PREPARES  => true,             // これやらないとシングルクウォートでのエスケープがうまく動かない。なので必要
        );
        DB::$cn = new PDO('mysql:host='.DB::$host.';dbname='. DB::$dbname.";port=".DB::$port, DB::$username, DB::$passwd, $opt);
    }
    function query($sql){
        DB::$res = DB::$cn->query($sql);
        return !(DB::errExist()); // エラーが無ければOK.
    }

    // ERRをセットする
    function errExist(){
        DB::$err = DB::$cn->errorInfo();
        if(
        !empty(DB::$err[2])
        ){
            //header("Location: /error.html");
            //exit;
            //print_r(DB::$err);
            return 1;
        }
        DB::$err = array();
        return 0;
    }
    function fetch(){
        return DB::$res->fetch(PDO::FETCH_ASSOC);
    }
    function fetchAll(){
        $li = DB::$res->fetchAll(PDO::FETCH_ASSOC);
        return isset($li[0])?$li[0]:array();
    }
    function quote($str){
        //return "'{$str}'";
        return DB::$cn->quote($str);
    }
    //function quote2($str){
    //    return DB::$cn->quote($str);
    //}
    function insertId(){
        return DB::$cn->lastInsertId();
    }
    function transaction(){
        return DB::$cn->beginTransaction();
    }
    function commit(){
        return DB::$cn->commit();
    }
    function rollback(){
        return DB::$cn->rollback();
    }
    function fetchClose(){
        // バッファをOFFにしている場合は、fetch()を空にせず次のSQLを実行するとエラーがでる。その場合は、closeCursor()する。
        DB::$res->closeCursor();
    }
    
}

