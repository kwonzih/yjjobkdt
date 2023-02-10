
<?php
    session_start();
    $sessionClass = $_SESSION["counselClass"];
    $sessionPhone = $_SESSION["counselPhone"];

    // DB에 상담신청자 정보 삭제
    $con = mysqli_connect("localhost", "yjjobkdt", "itsw8877!", "yjjobkdt");
    $sql = "delete from counsel where class = '$sessionClass' and phone = '$sessionPhone'";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo("
	     <script>
	         location.href = './index.php';
	     </script>
	   ");
?>