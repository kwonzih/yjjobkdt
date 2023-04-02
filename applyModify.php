
<?php
    require_once("./message.php");

    session_start();
    $sessionClass = $_SESSION["applyClass"];
    $sessionPhone = $_SESSION["applyPhone"];

    $applyClass = $_POST["applyClass"];
    $applyName = $_POST["applyName"];
    $applyBirth = $_POST["applyBirth"];
    $applyGender = $_POST["applyGender"];
    $applyPhone = $_POST["applyPhone"];
    $applyStartTime = $_POST["applyStartTime"];
    $applyEndTime = $_POST["applyEndTime"];
    $applySchool = $_POST["applySchool"];
    $applyMajor = $_POST["applyMajor"];
    $applyQuestion = $_POST["applyQuestion"];


    // DB에 온라인접수자 정보 수정
    $con = mysqli_connect("localhost", "yjjobkdt", "itsw8877%", "yjjobkdt");
    $sql = "update apply set class='$applyClass', name='$applyName', birth='$applyBirth', gender='$applyGender', phone='$applyPhone',
            start='$applyStartTime', end='$applyEndTime', school='$applySchool', major='$applyMajor', question='$applyQuestion'";
    $sql .= " where class = '$sessionClass' and phone = '$sessionPhone'";
    mysqli_query($con, $sql);
    mysqli_close($con);


    // 세션에 수정된 과정명, 연락처 저장
    $_SESSION["applyClass"] = $applyClass;
    $_SESSION["applyPhone"] = $applyPhone;


    // 과정소개페이지 URL
    $classUrl = '';
    
    switch($applyClass) {

        case 'OpenAPI를 활용한 스마트웹&앱(프론트엔드) 개발자 양성과정' :
            $classUrl = "yjjob.or.kr/p/?j=58&edu_code=VmtaYVUxUnJNVlpPVkU1UlZrUkJPUT09K00=";
            break;

        case '빅데이터분석과 UI구현을 위한 자바(JAVA), 파이썬(Python) 개발자' :
            $classUrl = "yjjob.or.kr/p/?j=58&edu_code=VmtaYVUxUnJNVVpOVlVwUlZrUkJPUT09K00=";
            break;

        case 'VR/AR 기술기반의 실감형콘텐츠 제작전문과정' :
            $classUrl = "yjjob.or.kr/p/?j=58&edu_code=VmtaYVUxUnJNVlpOVkU1UlZrUkJPUT09K00=";
            break;

        case '멀티플랫폼 반응형 UIUX 디자인 개발' :
            $classUrl = "yjjob.or.kr/p/?j=58&edu_code=VmtaYVUxUnJNWEpOVkU1UlZrUkJPUT09K00=";
            break;

        case '지능형 IoT 임베디드소프트웨어 융합 풀스택개발자 과정' :
            $classUrl = "yjjob.or.kr/p/?j=58&edu_code=VmtaYVUxUnJNWEpPVmtwUlZrUkJPUT09K00=";
            break;
    }


    // 알림톡 발송
    $messages = array(
        array(
            "to" => $applyPhone,
            "from" => "01033528779",
            "kakaoOptions" => array(
                "pfId" => "KA01PF22041206411o33TFWW9Sl71Ppp",
                "templateId" => "KA01TP230130033841289sSHAvn0WWyW",
                "variables" => array(
                    "#{applyName}" => $applyName,
                    "#{applyClass}" => $applyClass,
                    "#{applyBirth}" => $applyBirth,
                    "#{applyPhone}" => $applyPhone,
                    "#{applyStartTime}" => $applyStartTime,
                    "#{applyEndTime}" => $applyEndTime,
                    "#{applyUrl}" => "yjjobkdt.or.kr/applyReferForm.php",
                    "#{applyClassUrl}" => $classUrl
                ),
                "disableSms" => TRUE
            )
        ),
    );
    // print_r(send_messages($messages));
    send_messages($messages);

    echo "<script>
            location.href = './applyReferForm.php';
	      </script>";
?>