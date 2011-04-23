<html>
        <head>
        <?session_start()?>
        <title>information</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <style type = "text/css">
          body{
                background-color:black;
                text-align:center;
                color:white;
            }
            div.tf{
                text-align:left;
                margin-left:25%;
                margin-right:25%;
                padding:25px ;
                border:solid 1px;
                border-color:white;
                color:white;
                width:50%;
            }

        </style>
        <script type = "text/javascript" src = "jquery.js"></script>
        <script type = "text/javascript">
            $(document).ready(function(){
                $("button").click(function(){
                    $(this).append(<?php echo good;?>);
                
                });
            });
        </script>

        </head>
        <body>
            <div class = "tf">
            <?php session_start();
                include_once('database.php');
                $person_list = mysql_query('SELECT * FROM `person` WHERE ID="'.$_SESSION['person'].'"',$link);
                while($p = mysql_fetch_object($person_list)){
                    $hero = $p->Heroname;
                    $nb = $p->nb;
                    $jishu = $p->jishu;
                }

            ?>
            <p>人物名称：<?php echo $hero ?></p>
            <p>人物评价：<?php echo $nb ?></p>
            <p>人物级数：<?php echo $jishu ?></p>
            <div>
                        <?php 
                         echo '<div>';
                         $i = 1;
                         $geteq =  mysql_query('SELECT * FROM `p_e` WHERE `hero` = "'.$_SESSION['hero'].'" ORDER BY `NB` desc',$link);
                         while($r = mysql_fetch_object($geteq)){
                             if($i < 4){
                             echo '<p>装备'.$i++.'：'.$r->equ.'</p>';
                             }
                         }
                         echo '<table border = "1"><tr><td>装备名称</td> <td>综合评价</td> </tr>';
                         $i = 0;
                         $geteq =  mysql_query('SELECT * FROM `p_e` WHERE `hero` = "'.$_SESSION['hero'].'" ORDER BY `NB` desc',$link);
                         while($r = mysql_fetch_object($geteq)){
                             if($i < 11){
                             echo '<tr><td>'.$r->equ.'</td><td>'.$r->NB.'</td></tr>';
                             $i++;
                             }
                         }
                        echo '</table>';
                        echo '</div>';

                        ?>
            </div>
            </div>

        </body>

</html>
