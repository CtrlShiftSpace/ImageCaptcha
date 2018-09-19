<?php

    include('ImageCaptcha/ImageCaptcha.class.php');
    //初始化
    $imageCaptcha = new ImageCaptcha();
    //驗證的結果
    if((!empty($_SESSION['check_word']) && (!empty($_POST['checkword'])))){

        $systemCheckWord = $_SESSION['check_word'];
        //驗證的文字
        $checkWord = $_POST['checkword'];
        //輸入的文字
        $checkWordResult = $imageCaptcha->getCheckWordResult($systemCheckWord, $checkWord);
        if($checkWordResult){
            $_SESSION['check_word'] = ''; //比對正確後，清空將check_word值
             
            header('content-Type: text/html; charset=utf-8');
     
            echo '<p> </p><p> </p><a href="./index.php">OK輸入正確，按此可返回</a>';
            //echo '<meta http-equiv="refresh" content="1; url=./captcha_index.php">';
            exit();
        }else{
            echo '<p> </p><p> </p><a href="./index.php">Error輸入錯誤</a>';
        }
    }else{
        //未輸入驗證碼情況
        if(isset($_POST['checkword']) && strlen(trim($_POST['checkword'])) === 0 ){
            echo '<p> </p><p> </p><a href="./index.php">Error請輸入驗證碼</a>';
        }
    }

?>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>php圖形驗證碼</title>
   
    <script>
        function refresh_code(){ 
            document.getElementById("imgcode").src="ImageCaptcha/captcha.php"; 
        } 
    </script>


    <form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
        <p>請輸入下圖字樣：</p><p><img id="imgcode" src="ImageCaptcha/captcha.php" onclick="refresh_code()" /><br />
           點擊圖片可以更換驗證碼
        </p>
        <input type="text" name="checkword" size="10" maxlength="10" />
        <input type="submit" name="Submit" value="送出" />
    </form>