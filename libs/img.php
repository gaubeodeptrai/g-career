<?php
class Img{
    private static $_Image = false;
    private static $_ImageType = '';
    private static $_Info = null;

    /**
    * リサイズして保存する。
    *
    * @param $OPT["from_dir"]   リサイズ元の画像の保存先のディレクトリ
    * @param $OPT["to_dir"]     リサイズした画像の保存先のディレクトリ
    */
    function resize($OPT = array()){
        $s = "";
        if(
        preg_match("/([^\/]+)$/ui", $_SERVER["REQUEST_URI"], $m)
        ){
            $s = $m[1];
        }
        if (
        preg_match('/^(.+)_([rt]{1,2})([0-9]+)x([0-9]*)(\.jpeg|\.jpg|\.png)$/ui', $s, $m)
        ){
            $f = $OPT["from_dir"] . '/' . $m[1] . $m[5];
            $o = $OPT["to_dir"].    "/". $s;
            //$o = $OPT["output_file"];
            //$f = dirname($OPT["file"]) . '/' . $m[1] . $m[5];
            //$o = dirname($OPT["output"]) . '/' . $s;

            # heigh の設定ない場合は、高さがリサイズされないようにする
            if(
            empty($m[4])
            ){
                $info = getImageSize($f);
                if(
                $m[3] > $info[0]
                ){
                    $m[4] = floor($info[1] * ($m[3] / $info[0]));
                } else{
                    $m[4] = $info[1];
                }
            }

            if (file_exists($f)){
                if(
                Img::load($f)
                ){
                    for($i = 0, $j = strlen($m[2]); $i <= $j; $i++){
                        switch (substr($m[2], $i, 1)){
                        case 'r': Img::resizeToWidthHeight($m[3], $m[4], $o); break;
                        case 't': Img::triming($m[3], $m[4], $o); break;
                        }
                    }
                    Img::save($o);
                }
            }
        }
    }

    public function load($file){
                Img::$_Image = false;
                Img::$_Info = getImageSize($file);
                Img::$_ImageType = Img::$_Info[2];


                if(
                preg_match("/\.png$/ui", $file)
                ){
                        Img::$_Image = imageCreateFromPng($file);
                } elseif( Img::$_ImageType == IMAGETYPE_JPEG ) {
                        Img::$_Image = imageCreateFromJpeg($file);
                } elseif( Img::$_ImageType == IMAGETYPE_GIF ) {
                        Img::$_Image = imageCreateFromGif($file);
                } elseif( Img::$_ImageType == IMAGETYPE_PNG ) {
                        Img::$_Image = imageCreateFromPng($file);
                } elseif( Img::$_ImageType == IMAGETYPE_WBMP ) {
                        Img::$_Image = imageCreateFromWbmp($file);
                } elseif( Img::$_ImageType == IMAGETYPE_JPEG2000 ) {
                } elseif( Img::$_ImageType == IMAGETYPE_PSD ) {
                } elseif( Img::$_ImageType == IMAGETYPE_BMP ) {
                } elseif( Img::$_ImageType == IMAGETYPE_TIFF_II ) {
                } elseif( Img::$_ImageType == IMAGETYPE_TIFF_MM ) {
                } elseif( Img::$_ImageType == IMAGETYPE_TIFF_II ) {
                } elseif( Img::$_ImageType == IMAGETYPE_TIFF_II ) {
                } elseif( Img::$_ImageType == IMAGETYPE_TIFF_II ) {
                }
                return (Img::$_Image !== false);
    }

    /*
     * 画像をファイルに保存
     */
    //public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 100, $permissions = 0666) {
    public function save($file, $image_type = IMAGETYPE_JPEG, $compression = 100, $permissions = 0666) {

        $ret = false;
        if(
        preg_match("/\.png$/ui", $file)
        ){
                        $ret = imagepng(Img::$_Image, $file);
        } elseif( $image_type == IMAGETYPE_JPEG ) {

                       $ret = imageJpeg(Img::$_Image, $file, $compression);
        } elseif( $image_type == IMAGETYPE_GIF ) {
                        $ret = imageGif(Img::$_Image, $file);
        } elseif( $image_type == IMAGETYPE_PNG ) {
                        $ret = imagePng(Img::$_Image, $file);
        }
        if ($ret){
            if( $permissions != null) {
                $ret = chmod($file, $permissions);
            }
        }
        //return $this;
    }


        public function getWidth() {
                return imagesx(Img::$_Image);
        }

        public function getHeight() {
                return imagesy(Img::$_Image);
        }
        public function triming($widthRatio, $heightRatio, $file){
                $width = Img::getWidth();
                $height = Img::getHeight();
                if (($width < 2) || ($height < 2)) return;
                $size = array($width, ($width / $widthRatio * $heightRatio));
                $center = array(0, ($height - $size[1]) / 2);
                if ($size[1] > $height){

                        $size = array(($height / $heightRatio * $widthRatio), $height);
                        $center = array(($width - $size[0]) / 2, 0);
                }
                $new_image = imageCreateTrueColor($size[0], $size[1]);

                // png透過用
                if(
                preg_match("/\.png$/ui", $file)
                ){
                    imagealphablending($new_image, false);
                    imagesavealpha($new_image, true);
                }
                imageCopyReSampled($new_image, Img::$_Image, 0, 0, $center[0], $center[1], $size[0], $size[1], $size[0], $size[1]);
                Img::$_Image = $new_image;
                //return $this;
        }

        //public function resizeToWidth($width) {
        //        $ratio = $width / $this->getWidth();
        //        $height = $this->getheight() * $ratio;
        //        $this->resizeExe($width,$height);
        //        return $this;
        //}
        //public function resizeToHeight($height) {
        //        $ratio = $height / $this->getHeight();
        //        $width = $this->getWidth() * $ratio;
        //        $this->resizeExe($width,$height);
        //        return $this;
        //}

        public function resizeToWidthHeight($width, $height, $file) {
            $wh = Img::getRatioJustSize($width, $height);

            #### 画像サイズが設定値より小さくなる場合は設定値を値とする
            if(
            mb_strlen($height, "utf8")
            ){
                if(
                $wh[1] < $height
                ){
                    $org = Img::getHeight();
                    if(
                    $org > $height
                    ){
                        $wh[1] = $height;
                    }
                }
            }
            //echo $height;
            //print_r($wh);
            //exit;
            ####

            Img::resizeExe($wh[0], $wh[1], $file);
            //return $this;
        }

        public function scale($scale) {
                $width = Img::getWidth() * $scale/100;
                $height = Img::getheight() * $scale/100;
                Img::resizeExe($width,$height);
                //return $this;
        }

        public function resizeExe($width, $height, $file) {
                $new_image = imagecreatetruecolor($width, $height);

                // png透過用
                if(
                preg_match("/\.png$/ui", $file)
                ){
                    imagealphablending($new_image, false);
                    imagesavealpha($new_image, true);
                }

                imagecopyresampled($new_image, Img::$_Image, 0, 0, 0, 0, $width, $height, Img::getWidth(), Img::getHeight());
                Img::$_Image = $new_image;
                //return $this;
        }

        public function getRatioJustSize($baseWidth = 0, $baseHeight = 0){
                $iw = Img::getWidth();
                $ih = Img::getHeight();
                if ($iw > $baseWidth){
                        $ih = $ih * ($baseWidth / $iw);
                        $iw = $baseWidth;
                }
                if ($ih > $baseHeight){
                        $iw = $iw * ($baseHeight / $ih);
                        $ih = $baseHeight;
                }
                return array($iw, $ih);
        }

    /**
    *  @param $OPT["file"]  出力するファイルのパス
    */
    public function output($OPT){

        header('Content-transfer-encoding: binary');

        if(
        preg_match("/\.png$/ui", $OPT["file"])
        ){
            header('Content-type: image/png');
        } elseif(
        preg_match("/\.pdf$/ui", $OPT["file"])
        ){
            header('Content-type: application/pdf');
        } else{
            header('Content-type: image/jpeg');
        }

        readfile($OPT["file"]);
    }
} 
