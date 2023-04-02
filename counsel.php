<?php
    require_once("./message.php");

    $counselClass = $_POST["counselClass"];
    $counselName = $_POST["counselName"];
    $counselPhone = $_POST["counselPhone"];
    $counselStartTime = $_POST["counselStartTime"];
    $counselEndTime = $_POST["counselEndTime"];
    $counselQuestion = $_POST["counselQuestion"];


    // DB에 상담신청자 정보 저장
    $con = mysqli_connect("localhost", "yjjobkdt", "itsw8877%", "yjjobkdt");
    $sql = "insert into counsel(class, name, phone, start, end, question) ";
    $sql .= "values('$counselClass', '$counselName', '$counselPhone', '$counselStartTime', '$counselEndTime', '$counselQuestion')";
    mysqli_query($con, $sql);
    mysqli_close($con);


    // 세션에 상담신청자 정보(과정명, 연락처) 저장
    session_start();
    $_SESSION["counselClass"] = $counselClass;
    $_SESSION["counselPhone"] = $counselPhone;


    // 과정소개페이지 URL
    $classUrl = '';
    
    switch($counselClass) {

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
            "to" => $counselPhone,
            "from" => "01033528779",
            "kakaoOptions" => array(
                "pfId" => "KA01PF22041206411o33TFWW9Sl71Ppp",
                "templateId" => "KA01TP2301300341313437oPVnYYdzKu",
                "variables" => array(
                    "#{counselName}" => $counselName,
                    "#{counselClass}" => $counselClass,
                    "#{counselPhone}" => $counselPhone,
                    "#{counselStartTime}" => $counselStartTime,
                    "#{counselEndTime}" => $counselEndTime,
                    "#{counselUrl}" => "yjjobkdt.or.kr/counselReferForm.php",
                    "#{counselClassUrl}" => $classUrl
                ),
                "disableSms" => TRUE
            )
        ),
    );
    // print_r(send_messages($messages));
    send_messages($messages);

    echo "<script>
            location.href = './index.php';
	      </script>";
?>