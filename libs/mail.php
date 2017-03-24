<?php // ver.00.8
class Mail{
    static public $to, $from, $subj, $body;
    static public $sys_subj  = "";
    static public $sys_to    = "";
    static public $sys_from  = "";
    static public $send_type = ""; // php is mail(), pear is pear, default sendmail

    static public $host_bcc  = ""; // sendSys()以外のメールにBCCを指定したいとき

    static public $sendmail  = "/usr/sbin/sendmail";

    static public $return_path_is_from = "1"; // 1: リターンパスに値が無い場合にFROMをリターンパスにする


    //>> メール送信
    public static function send($OPT = array()){
        if(
        Mail::$send_type == "php"
        ){
            return Mail::sendPHP($OPT);
        }

        if(
        empty($OPT["to"])
        ){
            return false;
        }

        foreach(array(
        "to",
        "from",
        "from_name",
        "to_name",
        "bcc",
        "subj",
        "body",
        "return_path",
        "reply_to",
        "reply_to_name",
        "type",
        ) as $k){
            ${$k} = isset($OPT[$k])?$OPT[$k]:'';
        }


        if(
        empty($type) and
        !empty(Mail::$host_bcc)
        ){
            $bcc .= empty($bcc)?"":",";
            $bcc .= Mail::$host_bcc;
        }


        if(
        !empty($from_name)
        ){
            $from_name = mb_convert_encoding($from_name, "ISO-2022-JP", "utf8");

            //$from_name = mb_encode_mimeheader($from_name, "ISO-2022-JP");
            // 改行いれたくない場合（QMAILとか改行入ると問題発生するケースがある）
            $from_name     = base64_encode($from_name);
            $from_name = "=?ISO-2022-JP?B?{$from_name}?=";
        }

        if(
        !empty($reply_to_name)
        ){
            $reply_to_name = mb_convert_encoding($reply_to_name, "ISO-2022-JP", "utf8");

            // 改行いれたくない場合（QMAILとか改行入ると問題発生するケースがある）
            $reply_to_name = base64_encode($reply_to_name);
            $reply_to_name = "=?ISO-2022-JP?B?{$reply_to_name}?=";
        }


        //>> 件名を処理
        //>> JISコード(iso-2022-jp)だと半角カナが文字化けるので全角にしちゃう
        $subj = mb_convert_kana($subj, "KV", "utf8");
        $subj     = mb_convert_encoding($subj, "ISO-2022-JP", "utf8");
        //>> 改行しないようにエンコードしてる(QMAILで改行が認識しない問題あったため)
        $subj     = base64_encode($subj);
        $subj = "=?ISO-2022-JP?B?{$subj}?=";


        //>> 本文
        //>> JISコード(iso-2022-jp)だと半角カナが文字化けるので全角にしちゃう
        $body = mb_convert_kana($body, "KV", "utf8");

        //>> 1行1000Byte超えると文字化けるのでその対応
        $body = preg_replace("/\r\n/u", "\n", $body);
        $body = preg_replace("/\r/u",   "\n", $body);
        $body = preg_split("/\n/u", $body);
        $tmp = array();
        foreach($body as $val){
            //echo mb_strlen($val, "utf8"). "\n";
            if(
            mb_strlen($val, "utf8") > 450 // 500にすると文字化けたので余裕もたす
            ){
                $max = mb_strlen($val, "utf8") / 450;
                if(
                $max > floor($max)
                ){
                    $max = floor($max)+1;
                }
                $tmp2 = array();
                for($i=0;$i<$max;$i++){
                    $tmp2[] = mb_substr($val, ($i*450), 450, "utf8");
                }
                //print_r($tmp2);
                $val = implode("\n", $tmp2);
            }
            $tmp[] = $val;
        }
        //print_r($tmp);
        $body = implode("\n", $tmp);
        $body     = mb_convert_encoding($body, "ISO-2022-JP", "utf8");


        // -t を設定している場合で、ここでTOを設定する場合に、２通メールが送信されたサーバがあったのでコメントアウト
        //$mp = popen(Mail::$sendmail. " -i -t -f {$return_path} {$to}", "w");


        // デフォルトのReturn-Pathを利用した方がスパム扱いされないケースもあるので、Return-Pathを任意に設定できるようにする
        // Return-Pathを設定した方がスパム扱いされないケースもある。
        if(
        empty($return_path) and
        !empty(Mail::$return_path_is_from)
        ){
            $return_path = $from;
        }
        if(
        empty($return_path)
        ){
            $mp = popen(Mail::$sendmail. " -i -t", "w");
        } else{
            $mp = popen(Mail::$sendmail. " -i -t -f {$return_path}", "w");
        }
        //(-i .だけでも本文とみなさないようにする)
        //(-t これないとCC, BCCが認識されない)

        fputs($mp, "MIME-Version: 1.0\n");
        fputs($mp, "To: {$to}\n");
        if(
        empty($from_name)
        ){
            fputs($mp, "From: {$from}\n");
        } else{
            fputs($mp, "From: {$from_name}<{$from}>\n");
        }
        if(
        !empty($reply_to)
        ){
            if(
            empty($reply_to_name)
            ){
                fputs($mp, "Reply-To: {$reply_to}\n");
            } else{
                fputs($mp, "Reply-To: {$reply_to_name}<{$reply_to}>\n");
            }
        }
        if(
        !empty($bcc)
        ){
            fputs($mp, "Bcc: {$bcc}\n");
        }
        fputs($mp, "Subject: {$subj}\n");
        fputs($mp, "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n");
        fputs($mp, "\n");
        fputs($mp, "{$body}\n");

        //return pclose($mp); // error is -1
        //pclose($mp); // error is -1
        return pclose($mp); // error is -1
    }


    // システム担当者向けのメール
    public static function sendSys($OPT = array()){
        foreach(array(
        "to",
        "from",
        "subj",
        "body",
        "host",
        "type",
        "file",
        ) as $k){
            ${$k} = empty($OPT[$k])?'':$OPT[$k];
        }

        $host = (empty($host) and isset($_SERVER["HTTP_HOST"]))?$_SERVER["HTTP_HOST"]:$host;

        $type = !empty($type)?strtoupper($type):'';

        $subj = !empty($subj)?$subj:(strtoupper($host). ": ". (empty($type)?"SYS":$type));
        $from = !empty($from)?$from:Mail::$sys_from;
        $to   = !empty($to)  ?$to  :Mail::$sys_to;


//print_r($body);
        if(
        is_array($body)
        ){
            $body = stripslashes(var_export($body, true));
        }
//echo $body;
//exit;
        $body .= "\n\n";
        $body .= "(HOST)". (!empty($host)?$host:'取得できず'). "\n";
        $body .= "(REMOTE ADDR)". (isset($_SERVER["REMOTE_ADDR"])?$_SERVER["REMOTE_ADDR"]:'取得できず'). "\n";
        $body .= "(USER AGENT)". (isset($_SERVER["HTTP_USER_AGENT"])?$_SERVER["HTTP_USER_AGENT"]:'取得できず'). "\n";
        $body .= "(REQUEST URI)". (isset($_SERVER["REQUEST_URI"])?$_SERVER["REQUEST_URI"]:'取得できず'). "\n";
        $body .= "(REFERER)". (isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:'取得できず'). "\n";
        $body .= "(DATE)".date("Y-m-d H:i:s")."\n";
        $body .= "(FILE AND LINE)".((!empty($file) and class_exists("Log"))?Log::fileAndLine($OPT):'')."\n";

        $opt = array();
        $opt["to"]   = $to;
        $opt["from"] = $from;
        $opt["body"] = $body;
        $opt["subj"] = $subj;
        $opt["type"] = "sys";
        return Mail::send($opt);
    }


    // 改行いれたくない場合（QMAILとか改行入ると問題発生するケースがある）
    public static function headerEncode($val){
        $val     = base64_encode($val);
        $val = "=?ISO-2022-JP?B?{$val}?=";
        return $val;
    }

    function sendPHP($em){
        if(
        empty($em["to"])
        ){
            return false;
        }

        $field = array(
        "to",
        "from",
        "from_name",
        "bcc",
        "subj",
        "body",
        "return_path",
        );
        foreach($field as $key){
            if(
            isset($em[$key])
            ){
                ${$key} = $em[$key];
                continue;
            }
            ${$key} = "";
        }

        if(
        !empty(Mail::$host_bcc)
        ){
            $bcc .= ",". Mail::$host_bcc;
            $bcc = trim($bcc, ",");
        }


        // JISコード(iso-2022-jp)だと半角カナが文字化けるので全角にしちゃう
        $subj = mb_convert_kana($subj, "KV", "utf8");
        $body = mb_convert_kana($body, "KV", "utf8");

        $header = array();
        $header[] = "Content-Type: text/plain;charset=iso-2022-jp";
        if(
        $from_name
        ){
            $from_name = mb_convert_encoding($from_name, "ISO-2022-JP", "utf8");

            //$from_name = mb_encode_mimeheader($from_name, "ISO-2022-JP");
            // 改行いれたくない場合（QMAILとか改行入ると問題発生するケースがある）
            $from_name     = base64_encode($from_name);
            $from_name = "=?ISO-2022-JP?B?{$from_name}?=";

            $header[] = "From:{$from_name}<{$from}>";
        } else{
            $header[] = "From:{$from}";
        }
        $header[] = "Bcc:{$bcc}";
        $header   = implode("\n", $header); // RFCに準じるならCRLFがいいかも。テストしてみる価値はある。
        $subj     = mb_convert_encoding($subj, "ISO-2022-JP", "utf8");
        mb_internal_encoding("ISO-2022-JP"); // これしないと件名が2行になる場合に文字化ける

        //$subj     = mb_encode_mimeheader($subj, "ISO-2022-JP");
        // 改行いれたくない場合（QMAILとか改行入ると問題発生するケースがある）
        $subj     = base64_encode($subj);
        $subj = "=?ISO-2022-JP?B?{$subj}?=";


        mb_internal_encoding("utf8");
        //$subj = preg_replace("/\r\n/u","\n", $subj); // これ必要かなあ。メールサーバによってはCRを改行として扱うケースあるみたい。


        // 1行1000Byte超えると文字化けるのでその対応
        $body = preg_replace("/\r\n/u", "\n", $body);
        $body = preg_replace("/\r/u",   "\n", $body);
        $body = preg_split("/\n/u", $body);
        $tmp = array();
        foreach($body as $val){
            //echo mb_strlen($val, "utf8"). "\n";
            if(
            mb_strlen($val, "utf8") > 490 // 500にすると文字化けたので余裕もたす
            ){
                $max = mb_strlen($val, "utf8") / 490;
                if(
                $max > floor($max)
                ){
                    $max = floor($max)+1;
                }
                $tmp2 = array();
                for($i=0;$i<$max;$i++){
                    $tmp2[] = mb_substr($val, ($i*490), 490, "utf8");
                }
                //print_r($tmp2);
                $val = implode("\n", $tmp2);
            }
            $tmp[] = $val;
        }
        //print_r($tmp);
        $body = implode("\n", $tmp); // RFCに準じるならCRLFがいいかも。テストしてみる価値はある。
        $body     = mb_convert_encoding($body, "ISO-2022-JP", "utf8");

    
        if(
        empty($return_path) and
        empty(Mail::$return_path_is_from)
        ){
            $return_path = $from;
        }
        if(
        !empty($return_path)
        ){
            return mail($to, $subj, $body, $header, "-f{$return_path}");
        }
        return mail($to, $subj, $body, $header);
    }
}
