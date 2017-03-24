<?php
class Token{
    public static $name = "token";

    // トークンの値
    public static function val($_ = array()){

        $name = ( !is_array($_) )?"token/{$_}":(Token::$name);


        //$_SESSION["token"] = md5(uniqid(rand(), true)); // 32byte
        $_SESSION[$name]          = sha1(uniqid(rand(), true)); // 40byte
        $_SESSION["{$name}_time"] = time();

        return $_SESSION[$name];

        // rand() の最大値は、getrandmax() に依存する(PHPのデフォルトは「2147483647」）
        // uniqid() に、rand() を付けることで複雑化している。第2引数にTRUEを設定しているのも同様
    }

    // トークンチェック
    public static function valid($_ = array()){

        if(!is_array($_)) $_ = array("name"=>$_);

        $_["name"] = isset($_["name"])?"token/{$_["name"]}":(Token::$name);
        $_["time"] = isset($_["time"])?$_["time"]          :14400;     // 1h


        if(
            empty($_SESSION[$_["name"]]) or
            empty($_POST["token"]) or
            $_POST["token"] <> $_SESSION[$_["name"]] or
            (time() - $_SESSION["{$_["name"]}_time"]) > $_["time"]
        ){
            return false;
        }
        unset($_SESSION[$_["name"]]); // 1度利用したら削除。
        return true;
    }

    // トークン削除(unset は予約語、clear は空が残る感じがする、clean は全てキレイにする感じする）
    public static function clean($_ = array()){

        $name = ( !is_array($_) )?"token/{$_}":(Token::$name);

        unset($_SESSION[$name]);
        unset($_SESSION["{$name}_time"]);
    }
}
