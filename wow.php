<html>
    <head>
        <title>mini wow</title>
        <script type = "text/javascript" src = "jquery.js">
        </script>
        <script>
        var i = true; 
            $(document).ready(function(){
                $(".open_fb").click(function(){
                    $(".bolder").toggle("slow");
                    if(i){
                        $("h3").css("background","black");
                        $("h3").css("color","white");

                        i = false;
                    }
                    else{
                        $("h3").css("background","#c3c3c3");
                        $("h3").css("color","black");
                        i = true;
                    }
                })   
            })

        </script>
        <style type = "text/css">
            div.bolder{
                padding : 7px;
                margin-bottom: 10px;
                border:2px solid #c3c3c3;
                height:150px;
            }
            h3.bg{
            background-color:#c3c3c3;
            }

            div.right{
                float:right;
                font-size:15px;
                color:#c3c3c3;
                
            }
            button.open_fb{
            float:right;
            }
            button.right{
                float:right;
            }
            img.left{
            float:left;
            }
            h1{
                color:red;
            }
            a:visited{color:#c3c3c3}
            a:active{color:red}
            div{
            color:white;
            }
        </style>
    </head>
    <body bgcolor = "black">
            <h1>MINI WOW: <div class = "right">Welcome: <?php session_start(); echo $_SESSION['person'] ?> | 
            <a href = "wow_information.php" target = "_blank">人物信息</a> | <a class = "open_fb" >展开/收缩副本</a></div></h1>
            <?php
            header('Content-Type:text/html;charset = utf8');
            $link = mysql_connect('localhost','root','227227');
            mysql_select_db("wow",$link);
            mysql_query("SET NAMES UTF8");
            $fb_list = mysql_query('SELECT DISTINCT Name ,Instruction FROM `FB`',$link);
            while($row = mysql_fetch_object($fb_list)){
                echo '<h3 class = "bg">',$row->Name,'</h3>';
                echo '<div class = "bolder">';
                echo '<img class = "left" src = "/wow/'.$row->Name.'.jpg" width = "300" height = "150"">';
                echo '副本名称:',$row->Name,'</br>';
                echo '副本介绍:',$row->Instruction,'</br>副本BOSS:'; 
                $boss = mysql_query('SELECT Name FROM `boss` WHERE FB="'.$row->Name.'"',$link);
                while($row_boss = mysql_fetch_object($boss)){
                    echo $row_boss->Name,'  ';
                }
                echo '</br><a href = "wowenter.php?boss='.URLEncode($row->Name).'">点击进入</a>';
                echo '</div>';

           }
            
        ?>
    </body>
<html>
