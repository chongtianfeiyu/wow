<html>
    <head>
        <title>FB:<?php echo $_GET[boss] ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <script type = "text/javascript" src = "jquery.js">
        </script>
            <script type = "text/javascript">
            $(document).ready(function(){
                $("button").click(function(){
                    var t = this.className;
                    $(this).remove();
                     $.post("get_equ.php" , {boss:t} , function(data){
                        $("div ."+t).after(data);
                    });  
            })
            });
        </script>
        <style type = "text/css">
            body{
            background-color:black;
            color:white;
            }
            h2.red{
                color:red;
            }
            div.be{
                border: 8px solid #c3c3c3:
                border-width:10px;
                padding:10px;
                margin:5px;
                height :330px;
                color:white;
            }
            div.bo{
                padding : 7px;
                margin-bottom: 10px;
                border:1px solid #c3c3c3;
                height:300px;
                color:white;
                font-size:16px;
            }
            img.left{
            float:left;
            margin-right:10px;
            }
            a.right{
                float:right;
                font-size:15px;
            }
            a:visited{color:#c3c3c3}
            a:active{color:red}

        </style>
    </head>
    <body>
        <?php 
         session_start();
            include_once('database.php');
         $boss_list = mysql_query('SELECT * FROM `boss` WHERE FB="'.$_GET[boss].'"',$link);
         echo '<h2>YourName:',$_SESSION['hero'],'<a class = "right" href = "wow.php">返回副本列表</a></h2>';

         while($row_boss = mysql_fetch_object($boss_list)){
             echo '<div class = "bo">';
             echo '<img class = "left"src = "/wow/wow/'.$row_boss->Name.'.png" width = "200" height = "300">';
             echo 'Name: ',$row_boss->Name."</br>";
             echo 'HP: ',$row_boss->HP,'<br>';
             echo 'MP: ',$row_boss->MP,'</br>';
             echo 'Point: ',$row_boss->Point,'<br>';
             echo 'difficulty:';
             $diff = $row_boss->nb;
             if($diff > 30)
                 echo '噩梦';
             else if($diff > 20)
                 echo '困难';
             else if ($diff > 10)
                 echo '中等';
             else
                 echo '简单';
             $c = 1;
             echo '</br>';
             //echo '<div class = "'.$row_boss->Name.'">';
             echo '<div>';
             $equ_list = mysql_query('SELECT * FROM `Equipment` WHERE Boss_name = "'.$row_boss->Name.'"',$link);
             while($row_equ = mysql_fetch_object($equ_list)){
                 echo $row_equ->Name,' ';
             }

             echo '</br><button class = "'.$row_boss->Name.'"'.$row_boss->Name.'">击杀</button>';
             echo '<div class = "'.$row_boss->Name.'"'.$row_boss->Name.'"> </div>';
             echo '</div>';
             echo '</div>';


         }

    ?>
    </body>
</html>
