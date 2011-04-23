<html>
    <head>
        <title>register</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <style type = "text/css">
            body{
                background-color:black;
                text-align:center;        
                color:white;
            }
            div.w{
                
                border-width:1px;
                border-style:solid;
                border-color:white;
                margin-left:25%;
                margin-right:25%;

            }
            div.c{
                text-align:left;
                padding-left:40px;
                padding-right:40px;
            }
            input.c{
                text-align:center;
            }
        </style>
            <script type = "text/javascript" src = "jquery.js"></script>
    </head>
    <body>
        <div class = "w">
        <form action = "register.php" method = "post">
        <div class = "c">
            <p class = "name">帐号:&nbsp &nbsp <input type = "text" maxlength = "20" size = "25" name = "ID"/>(长度在6-20,不包含中文)</p>            
            <p class = "pw">密码:&nbsp &nbsp <input type = "password" maxlength = "20" size = "25" name = "pw"/>(长度在6-20,不包含中文)</p>
            <p class = "rpw">确认密码:<input type = "password" maxlength = "20" size = "25" name = "rpw"/></p>
            <p class = "hero">角色名: &nbsp<input type = "text" maxlength = "20" size = "25" name = "per" />(长度在6-20)</p>
            </div>
            <input class = "c" type = "submit" value = "注册"/>
        </form>
        </div>
            <?php
            if(isset($_POST['ID'])){
            $reg = true;
            $name = $_POST['ID'];
            $pw = $_POST['pw'];
            $rpw = $_POST['rpw'];
            $hero = $_POST['per'];
            echo '<script type = "text/javascript">';
            if(!(strlen($name) >= 6 and strlen($name) <= 20) || !(eregi("^[A-Za-z0-9]+$",$name))){
                echo '$(".name").append("</br> 输入错误 请重新输入");';
                $reg = false;
            }
            if($pw != $rpw || !(strlen($pw) >= 6 and strlen($pw) <= 20) || !(eregi("^[A-Za-z0-9]+$",$pw))){
                echo '$(".rpw").append("</br> 密码不符或格式错误 请重新输入");';
                $reg = false;
            }
            if(!(strlen($hero) >= 6 and strlen($hero) <= 20) ){
                echo '$(".hero").append("</br> 非法输入 请重新输入");';
                $reg = false;
            }
            if($reg){
                 include_once('database.php');
                $h = mysql_query('INSERT INTO `person` VALUES("'.$name.'","'.$pw.'","'.$hero.'",10,1,0,0,0)',$link);
                if($h){
                    echo 'alert("注册成功");';
                    echo 'window.location.href = "wow_enter.php";';
                }
                else
                    echo '$(".name").append("</br> 帐号已存在 请重新输入");';   
            }
            echo '</script>';
            

            }

        ?>
        </form>
    </body>
</html>
