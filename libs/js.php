<?php
class JS{
    function quote($_){
        $_ =  preg_replace("/\n/u", "", preg_replace("/'/u", "\\'", $_));
        $_ =  preg_replace("/\"/u", "\\\"", $_);
        return $_;
    }
}

