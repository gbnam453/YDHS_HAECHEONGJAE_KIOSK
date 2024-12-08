<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style type="text/css">
            html{width: 100%; height: 100%; font-family: arial;}
            body{width: 100%; height: 100%; margin: 0;}
            .hidden{display: none;}
            table{border-spacing: 8px; width: 320px; margin: auto;}
            td.cell{width: 100px; height: 100px; background-color: #888888; border-radius: 10px;}
            label.cell{ display: block; width: 100px; height: 100px; line-height: 2.5em; margin: 0; padding: 0; color: #ffffff; border-radius: 10px; text-align : center;}
            /* 52 */
            input[type=radio]+label.cell{background-color: #888888;}
            input[type=radio]:checked+label.cell{background-color: #666666; color: #ffffff;}
            #stageTable{display:flex; align-items:center}
        </style>   
    </head>
    <body>
        <div id="stageTable">
            <table>
                <?php
                    $getdb = file_get_contents("./floor".$_GET['floor'].".json");

                    $json = json_decode($getdb, true);

                    $count = 1;
                    $count2 = 1;

                    foreach($json as $putf) {
                        echo "<tr>";
                        foreach($putf as $chair){
                            if($chair == "false") {
                                $changetype = "true";
                                if($_GET['device'] == "enter"){
                                    $script = "location.replace('update.php?table=".$count."&floor=".$_GET['floor']."&chair=".$count2."&value=".$changetype."');";
                                } else if ($_GET['device'] == "exit") {
                                    $script = "Swal.fire('오류','이 기기에서는 퇴장만 할 수 있습니다','error');";
                                }
                                echo "<td class='cell'><input type='radio' class='hidden''/><label style='cursor:pointer;' class='cell' onclick=\"$script\">$count-$count2</label></td>";
                            } else {
                                $changetype = "false";
                                if($_GET['device'] == "enter"){
                                    $script = "Swal.fire('오류','이 기기에서는 입장만 할 수 있습니다','error');";
                                } else if ($_GET['device'] == "exit") {
                                    $script = "location.replace('update.php?table=".$count."&floor=".$_GET['floor']."&chair=".$count2."&value=".$changetype."');";
                                }
                                echo "<td class='cell'><input type='radio' class='hidden''/><label style='cursor:pointer;background-color: #666666';' class='cell' onclick=\"$script\">$count-$count2</label></td>";
                            }
                            $styletag = "";
                            $count2++;
                            //echo $count."번째 자리 값 : ".$putf." | <button onclick=\"$('#hidden').load('update.php?table=".$count."&value=".$changetype."');$('#load').load('api.php');\">상태 변경 클릭</button><br>";
                        }
                        $count++;
                        $count2 = 1;
                        echo "</tr>";
                    }
                    
                ?>
            </table>
        </div>
    </body>
</html>