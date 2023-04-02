
<?php
    session_start();
    $sessionClass = $_SESSION["applyClass"];
    $sessionPhone = $_SESSION["applyPhone"];

    // DB에 온라인접수자 정보 삭제
    $con = mysqli_connect("localhost", "yjjobkdt", "itsw8877%", "yjjobkdt");
    $sql = "delete from apply where class = '$sessionClass' and phone = '$sessionPhone'";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo("
	     <script>
	         location.href = 'http://yjjobkdt.or.kr/index.php';
	     </script>
	   ");
?>