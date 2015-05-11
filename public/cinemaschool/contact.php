<?php $path = "./" ; ?>
<?php $page = "contact"; ?>
<?php include($path . "header.php"); ?>

<div id="content">
    <div class="content_right">
        <div class="advertisement">
            <img src="./img/advertisement.jpg" alt="広告" title="広告">        </div>
    </div>
    <div class="content_left">
        <div class="title">
            <h2>一般の方</h2>
            <hr>
        </div>
        <p class="contact_font"> 一般の方はこちらからご連絡をお願いします。</p>
        <form method="POST" action="index.php" onsubmit="return formCheck(this)"> 
            <div class="form_box">
                <div class="form_left">
                メールアドレス
                </div>
                <div class="form_right">
                    <input type="text" name="name" class="form_address">
                </div>
            </div>
            <div class="form_box">
                <div class="form_left">
                コメント
                </div>
                <div class="form_right">
                    <textarea rows="15" name="contents" cols="56" class="form_text"></textarea>
                    <input type="submit" value="送信する" class="form_submit">
                </div>
            </div>
            <div class="form_right">
            </div>
        </form>
    </div>
    <div class="content_left">
        <div class="title">
            <h2>登録団体の方</h2>
            <hr>
        </div>
        <p> 登録団体の方は以下のリンクよりお願いいたします。</p>
        <a href="http://www.cinema-school.com/login.php"><img src="./img/dantai_link.jpg" alt="登録団体の方" title="登録団体の方" class="dantai_link"></a>
    </div>
    <div class="content_left">
        <div class="title">
            <h2>メールアドレス</h2>
            <hr>
        </div>
        <ul class="sns">
        <li>    <img src="./img/mail_large.png" alt="mail" title="mail" height="26" width="26">aaa@aaa.jp</li>
        </ul>
    </div>
</div>

<?php include($path . "footer.php"); ?>