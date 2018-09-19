<?php
    class ImageCaptcha{

        //建構式
        public function __construct()
        {
            //啟動session
            self::startSession();
        }

        /**
         *  
         * @return void 啟動Session
         */
        public function startSession()
        {
            if(!isset($_SESSION)){
                session_start();
            }  //判斷session是否已啟動
        }

        //判斷驗證的字串是否符合
        /**
         * @author luke
         * @param  [String] $systemCheckWord 正確驗證碼
         * @param  [String] $checkWord       輸入內容
         * @return [bool]                  TRUE|FALSE
         */
        public function getCheckWordResult($systemCheckWord, $checkWord)
        {
            if((!empty($systemCheckWord) && (!empty($checkWord)))){
            //判斷此兩個變數是否為空
                if(strtolower($systemCheckWord) === strtolower($checkWord)){
                    //比對後相等
                    return true;
                }else{
                    //驗證碼不符
                    return false;
                }
                return false;
            }else{
                return false;
            }
            return false;
        }

        /**
         * 隨機產生驗證碼並返回
         * @author luke
         * @param  [int] $nums 文字數量
         * @return [String]      返回驗證碼,為英數字組合
         */
        public function createCode($nums) {
            //去除了數字0和1 字母小寫O和L，為了避免辨識不清楚
            $str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMOPQRSTUBWXYZ";
            $code = '';
            for ($i = 0; $i < $nums; $i++) {
                $code .= $str[mt_rand(0, strlen($str)-1)];
            }
            return $code;
        }

        /**
         * [createImgByCode description]
         * 將驗證碼轉換成圖片
         * @author luke
         * @param  [String] $code  驗證碼字串
         * @param  [int] $nums  文字數量
         * @param  [int] $width [圖形寬度]
         * @param  [int] $high  [圖形高度]
         * @return [void]
         */
        public function createImgByCode($code,$nums,$width,$high) {

            //建立圖示，設置寬度及高度與顏色等等條件
            $image = imagecreate($width, $high);
            $black = imagecolorallocate($image, mt_rand(0, 200), mt_rand(0, 200), mt_rand(0, 200));
            $border_color = imagecolorallocate($image, 21, 106, 235);
            $background_color = imagecolorallocate($image, 235, 236, 237);

            //建立圖示背景
            imagefilledrectangle($image, 0, 0, $width, $high, $background_color);

            //建立圖示邊框
            imagerectangle($image, 0, 0, $width-1, $high-1, $border_color);

            //在圖示布上隨機產生大量躁點
            for ($i = 0; $i < 80; $i++) {
                imagesetpixel($image, rand(0, $width), rand(0, $high), $black);
            }
           
            $strx = rand(3, 8);
            for ($i = 0; $i < $nums; $i++) {
                $strpos = rand(1, 6);
                imagestring($image, 5, $strx, $strpos, substr($code, $i, 1), $black);
                $strx += rand(10, 30);
            }

            imagepng($image);
            imagedestroy($image);
        }
    }
?>