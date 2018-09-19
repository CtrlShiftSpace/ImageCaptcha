<?php

    //設置定義為圖片
    header("Content-type: image/PNG");

    include('ImageCaptcha.class.php');

    //初始化時會啟動Session
    $imageCaptcha = new ImageCaptcha();
    $_SESSION['check_word'] = ''; //設置存放檢查碼的SESSION
    /*
      imgcode($nums,$width,$high)
      設置產生驗證碼圖示的參數
      $nums 生成驗證碼個數
      $width 圖片寬
      $high 圖片高
    */
    //產生驗證的文字
    $imgCaptchaSetting = array(
                                'nums' => 5,
                                'width' => 120,
                                'height' => 30
                        );

    //驗證文字
    $imgCode = $imageCaptcha->createCode($imgCaptchaSetting['nums']);
    //存入Session
    $_SESSION['check_word'] = $imgCode;
    //產生對應驗證文字的圖片
    $imageCaptcha->createImgByCode($imgCode,$imgCaptchaSetting['nums'],$imgCaptchaSetting['width'],$imgCaptchaSetting['height']);
?>