<?php
class CSV{
    public static $err = array();

    //>> 値をCSV形式にする
    static public function encode($_){
        if(
            is_array($_)
        ){
            //>> 配列からCSVの形式にする
            $tmp = array();
            foreach($_ as $k => $v){
                $tmp[$k] = CSV::encode($v);
            }
            $tmp = implode(",", $tmp);
            return $tmp;
        } else{
            $val = $_;
            $val = preg_replace("/\"/u", "\"\"", $val);
            $val = preg_replace("/\r\n/u", "\n", $val);
            $val = preg_replace("/\r/u", "\n", $val);
            $val = "\"{$val}\"";
            return $val;
        }
    }

    function err(){
        return CSV::$err;
    }


    static public function decode($OPT){
        CSV::$err = array();
        //>> CSVの1行を配列にする
        if(
        isset($OPT["line"])
        ){
            $val = $OPT["line"];

            $i = 0;
            $flg=0;
            $tmp = array();

            foreach(explode(",", $val) as $k => $v){
                if(
                    !isset($tmp[$i])
                ){
                    $tmp[$i]=array($v);
                } else{
                    $tmp[$i][] = $v;
                }

                if(
                    (mb_substr_count($v, "\"", "utf8")%2) // 奇数
                ){
                    $flg = empty($flg)?1:0;
                }
                if(
                    empty($flg)
                ){
                    $tmp[$i] = implode(",", $tmp[$i]);
                    $tmp[$i] = preg_replace("/(^\"|\"$)/u", "", $tmp[$i]);
                    $tmp[$i] = preg_replace("/\"\"/u", "\"", $tmp[$i]);
                    $i++;
                }
            }

            // タイトルの指定がある場合は連想配列にする
            if(
            !empty($OPT["title"])
            ){
                $tmp2 = array();
                foreach(explode(",", $OPT["title"]) as $key => $val){
                    $tmp2[$val] = $tmp[$key];
                }
                $tmp = $tmp2;
            }
            return $tmp;

        } elseif(
        isset($OPT["file"])
        ){

            if(
            empty($OPT["file"]) or
            !file_exists($OPT["file"])
            ){
                CSV::$err[] = "ファイルパスが存在しません";
                return array();
            }
            $buf = @file_get_contents($OPT["file"]);

            // デフォルトはSJISをUTF8に変換する
            if(
            empty($OPT["charset"])
            ){
                $buf = mb_convert_encoding($buf, "utf8", "sjis-win");
            }
            $OPT["content"] = $buf;
        }

        if(
        isset($OPT["content"])
        ){
            $content = $OPT["content"];

            // Windows形式
            if(
            preg_match("/\r\n/u", $content)
            ){
                  //$content = preg_split("/\r\n/u", $content);
                  $content = explode("\r\n", $content);

            // MACのExcelもOpenOfficeも、\r\nは含まれず、\n のみで改行コードが形成されている
            } else{
                  $content = preg_replace("/(\"[^\n]*)\n([^\n]*\")/u", "$1\t$2", $content);
                  //$content = preg_split("/\n/u", $content);
                  $content = explode("\n", $content);
                  foreach($content as $k => $v){
                      $content[$k] = preg_replace("/\t/u", "\n", $v);
                  }
            }
//exit;

            $tmp = array();
//$content = array_filter($content);
            foreach($content as $i => $val){
                if(
                !mb_strlen($val, "utf8")
                //preg_match("/^$/u", $val)
                ){
                    continue;
                }
                $tmp[] = CSV::decode(array("line"=>$val));
            }
            return $tmp;
        }
    }
}
