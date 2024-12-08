<?php
// 설정

//1층 가로 세로를 설정해주세요.
$floor1Width = "5";
$floor1Height = "5";

//2층 가로 세로를 설정해주세요.
$floor2Width = "8";
$floor2Height = "6";

// 설정 끝
if(!isset($_GET['floor'])){
    die("
    <head>
        <title>YDHS Seat Reservation System</title>
        <meta name='theme-color' content='white'>
        <meta name='mobile-web-app-capable' content='yes'>
        <meta name='apple-mobile-web-app-capable' content='yes'>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

    </head>
    <h1 align='center'>Please select floor</h1>
    <h2 align='center'><a href='?floor=1'>2F</a> | <a href='?floor=2'>3F</a></h2>
    ");
}
?>

<html>
    <head>
    <title>YDHS Seat Reservation System - <?php echo $_GET['floor']; ?>F</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="http://gbnam.dothome.co.kr/GBNam/01_YDHS/00_Cafeteria/logo.png">
    <link rel="stylesheet" href="style.css">
</head>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
    <input type="checkbox" id="menuicon">
    <header>
        <div>
            <h1>YDHS Seat Reservation System - <?php echo $_GET['floor']+1; ?>F <? if($_GET['device'] == "enter") { echo "Enter LCD"; } else if($_GET['device'] == "exit") { echo "Exit LCD"; } ?></h1>
            <label for="menuicon" class="menubtn">
               <span></span>
               <span></span>
               <span></span>    
           </label>
        </div>
      </header>
      <div class="container"> 
        <div class="sidebar">
            <?php
            if(!isset($_GET['device'])){
                echo "<h3><a href='?'>Floor Select</a> <br>────────────<br>    
                <a href='?device=enter&floor=".$_GET['floor']."'>Enter LCD</a> <br>────────────<br> 
                <a href='?device=exit&floor=".$_GET['floor']."'>Exit LCD</a> <br>────────────<br>";
                if($_GET['floor'] == "1"){
                    echo "<a href='jsoncreator.php?w=$floor1Width&h=$floor1Height&floor=".$_GET['floor']."'>Reset</a></h3>";
                }
                if($_GET['floor'] == "2"){
                    echo "<a href='jsoncreator.php?w=$floor2Width&h=$floor2Height&floor=".$_GET['floor']."'>Reset</a></h3>";
                }
            }
            if($_GET['device'] == "enter"){
                echo "<h3><a href='?floor=".$_GET['floor']."'>Back</a> <br></h3>";            
            } else if($_GET['device'] == "exit"){
                echo "<h3><a href='?floor=".$_GET['floor']."'>Back</a> <br></h3>";
            }
            ?>
        </div>
   </div>
<br>
<div id="load">
</div>
<div id="hidden" style="display: none;">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script type="text/javascript">
<?php
if($_GET['result'] == "true"){
    echo "
    history.pushState(null, null, './?device=".$_GET['device']."&floor=".$_GET['floor']."')
    Swal.fire({
        icon: 'success',
        title: '정상적으로 입실 처리되었습니다.반드시 해당자리에 앉아주세요!',
        showConfirmButton: false,
        timer: 1000
      })";
} else if ($_GET['result'] == "false"){
    echo "
    history.pushState(null, null, './?device=".$_GET['device']."&floor=".$_GET['floor']."')
    Swal.fire({
        icon: 'success',
        title: '정상적으로 퇴실 처리되었습니다.',
        showConfirmButton: false,
        timer: 1500
      })";
}
?>

$(document).ready(function () {
      $("#load").load("api.php?device=<?php echo $_GET['device'];?>&floor=<?php echo $_GET['floor']; ?>");
      setInterval(function() {
        $("#load").load("api.php?device=<?php echo $_GET['device'];?>&floor=<?php echo $_GET['floor']; ?>");
      },<?php if(!isset($_GET['device'])) { echo "5000"; } else { echo "1000"; }?>);
});

    
  </script>
</body>
</html>