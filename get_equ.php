<?php 
    session_start();
    $hero = $_SESSION['hero'];
    $boss = $_POST['boss'];
    include_once('database.php');
    $heronb = mysql_query('SELECT `nb`, `jishu` FROM `person` WHERE `ID` = "'.$_SESSION['person'].'"',$link);
    while($row_nb = mysql_fetch_object($heronb)){
        $hnb = $row_nb->nb;
        $jishu = $row_nb->jishu;
    }

    $bossnb = mysql_query('SELECT `nb` FROM `boss` WHERE `Name` = "'.$boss.'"',$link);
    while($row_nb = mysql_fetch_object($bossnb))
        $bnb = $row_nb->nb;
    $hero = $_SESSION['hero'];
    if($hnb < $bnb){
        echo '<h2 class = "red">You die.......Please choose another boss</h2>';
    }
    else{
        echo '<p class = "red">You kill the boss and get::</p>';
        echo '<div>';
        echo '<table border = "1"><tr><td>装备名称</td> <td>力量</td> <td>敏捷</td> <td>智力</td> <td>综合评价</td> </tr>';
        $gl =  mysql_query('SELECT * FROM `Equipment` WHERE `Boss_name` = "'.$boss.'"',$link);
        while($equ = mysql_fetch_object($gl)){
            $i = rand(1,1000)/10;
            if($i < $equ->Drop_probability){
                echo '<tr><td>'.$equ->Name,'</td> <td>',$equ->Force,' </td> <td>',$equ->Agile,' </td> <td>',$equ->Intelligence,' </td> <td>',$equ->nb,'</td></tr>';
                mysql_query('INSERT INTO `p_e` VALUES("'.$hero.'","'.$equ->Name.'",'.$equ->nb.')',$link);
            }
        }
       $i = 1;
       $geteq =  mysql_query('SELECT * FROM `p_e` WHERE `hero` = "'.$_SESSION['hero'].'" ORDER BY `NB` desc',$link);
       while($r = mysql_fetch_object($geteq)){
       if($i++ < 4){
       mysql_query('UPDATE `person` SET `w'.($i-1).'` = '.$r->NB ,$link);
       }
       }

        $jishu += 0.1;
        mysql_query('UPDATE `person` SET jishu = '.$jishu.' WHERE `ID` = "'.$_SESSION['person'].'"',$link);
        mysql_query('UPDATE `person` SET nb = 9.5 + jishu+w1+w2+w3 WHERE `ID` = "'.$_SESSION['person'].'"',$link);
        echo '</table>';
        echo '</div>';

    }




?>
