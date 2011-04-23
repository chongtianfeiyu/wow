<html>
    <head>
        <title>mini wow</title>
          <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <style type = "text/css">
            body{
                background-color:black;
                text-align:center;
            }
            div.tf{
                margin-left:30%;
                margin-right:30%;
                padding:5px ;
                color:white;
            }

        </script>
        </style>
    </head>
    <body>
        <div>
            <img src = "/wow/wow/wowenter.png"/>
        </div>
        <div class = "tf">
        <form action = "wow_enter.php" method = "post">
            <a>帐号:</a>
            <input type = "text" name = "id"/>
            </br>
            <a>密码:</a>
            <input type = "password" name = "pw"/>
            </br>
            </br>
            <input type = "button" value = "注册" onclick = "window.location = 'register.php'" />
            <input type = "submit" value = "登陆"/>
                <?php
                session_start();
                if(isset($_POST['id'])){
                include_once("database.php");
                $person_list = mysql_query('SELECT * FROM `person`',$link);
                while($row_p = mysql_fetch_object($person_list)){
                    
                    if($row_p->ID == $_POST['id'] && $row_p->Password == $_POST['pw']){
                        $hero = $row_p->Heroname;                       
                        $_SESSION['person'] = $_POST['id'];
                        $_SESSION['hero'] =  $hero;
                        echo '<script type = "text/javascript"> document.location ="wow.php"</script>';                    
                    }
                }
                echo '</br>帐号或密码错误';
                }
              ?>

        </form>
        </div>
    </body>
</html>
