<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> 상담신청 조회 </title>

    <!--jQuery-->
    <script src="./js/jquery-3.6.1.js"></script>

    <!--fontawesome-->
    <script src="https://kit.fontawesome.com/80f658f160.js" crossorigin="anonymous"></script>

    <!--css-->
    <link rel="stylesheet" href="./css/counselReferForm.css">
</head>

<body>
    <?php
        session_start();
        $sessionClass = $_SESSION["counselClass"];
        $sessionPhone = $_SESSION["counselPhone"];

        $con = mysqli_connect("localhost", "yjjobkdt", "itsw8877!", "yjjobkdt");
        $sql = "select * from counsel where class = '$sessionClass' and phone = '$sessionPhone'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $class = $row["class"];
        $name = $row["name"];
        $phone = $row["phone"];
        $start = $row["start"];
        $end = $row["end"];
        $question = $row["question"];

        mysqli_close($con);
    ?>

    <!--상담신청 조회-->
    <section id="conForm">
        <!--제목-->
        <div id="conFormTitle">
            <h1> 상담신청 조회/수정 </h1>
        </div>

        <!-- 폼 박스 -->
        <div id="conFormBox">
            <!-- 상담 신청 -->
            <div id="conCounselForm">
                <form id="counsel" name="counsel" method="post">
                    <!-- 입력폼 내용 -->
                    <div class="formContent">
                        <div>
                            <section>
                                <p> 진행사항 </p>
                                <div> 접수중 </div>
                            </section>
                        </div>

                        <div>
                            <section>
                                <p> 관심 과정 <span> * </span> </p>

                                <div class="classInput">
                                    <select name="counselClass" id="counselClass" onchange="counselClassChange();">
                                        <option disabled="disabled"> 관심 과정을 선택해주세요. </option>
                                        <option value="OpenAPI를 활용한 스마트웹&앱(프론트엔드) 개발자 양성과정"> OpenAPI를 활용한 스마트웹&앱(프론트엔드) 개발자 양성과정 </option>
                                        <option value="빅데이터분석과 UI구현을 위한 자바(JAVA), 파이썬(Python) 개발자"> 빅데이터분석과 UI구현을 위한 자바(JAVA), 파이썬(Python) 개발자 </option>
                                        <option value="VR/AR 기술기반의 실감형콘텐츠 제작전문과정"> VR/AR 기술기반의 실감형콘텐츠 제작전문과정 </option>
                                        <option value="멀티플랫폼 반응형 UIUX 디자인 개발"> 멀티플랫폼 반응형 UIUX 디자인 개발 </option>
                                        <option value="지능형 IoT 임베디드소프트웨어 융합 풀스택개발자 과정"> 지능형 IoT 임베디드소프트웨어 융합 풀스택개발자 과정 </option>
                                    </select>
                                </div>
                            </section>
                        </div>

                        <div class="flex">
                            <section>
                                <p> 이름 <span> * </span> </p>
        
                                <div class="nameInput">
                                    <input type="text" name="counselName" value="<?=$name?>" id="counselName" placeholder="이름을 입력해주세요">
                                </div>
                            </section>

                            <section>
                                <p> 연락처 <span> * </span> </p>

                                <div class="phoneInput">
                                    <input type="text" name="counselPhone" value="<?=$phone?>" id="counselPhone">
                                </div>
                            </section>
                        </div>

                        <div>
                            <section>
                                <p> 연락가능시간 <span> * </span> </p>

                                <div class="timeInput">
                                    <select name="counselStartTime" id="counselStartTime" onchange="counselStartTimeChange();">
                                        <option disabled="disabled"> 시작 </option>
                                        <option value="10:00"> 10:00 </option>
                                        <option value="11:00"> 11:00 </option>
                                        <option value="12:00"> 12:00 </option>
                                        <option value="13:00"> 13:00 </option>
                                        <option value="14:00"> 14:00 </option>
                                        <option value="15:00"> 15:00 </option>
                                        <option value="16:00"> 16:00 </option>
                                        <option value="17:00"> 17:00 </option>
                                    </select>

                                    <span> &#126; </span>

                                    <select name="counselEndTime" id="counselEndTime" onchange="counselEndTimeChange();">
                                        <option disabled="disabled"> 끝 </option>
                                        <option value="11:00"> 11:00 </option>
                                        <option value="12:00"> 12:00 </option>
                                        <option value="13:00"> 13:00 </option>
                                        <option value="14:00"> 14:00 </option>
                                        <option value="15:00"> 15:00 </option>
                                        <option value="16:00"> 16:00 </option>
                                        <option value="17:00"> 17:00 </option>
                                        <option value="18:00"> 18:00 </option>
                                    </select>
                                </div>
                            </section>
                        </div>

                        <div>
                            <section>
                                <p> 문의글 </p>

                                <div class="questionInput">
                                    <textarea name="counselQuestion" value="" id="counselQuestion" placeholder="문의 내용(200자 이내)"></textarea>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- 버튼 -->
                    <div class="formBtn">
                        <section>
                            <button type="button" class="resetBtn" id="counselReset" onclick="counsel_cancel();"> 신청취소 </button>
                        </section>

                        <section>
                            <button type="button" class="submitBtn" id="counselSubmit" onclick="counsel_sendMessage();"> 수정완료 </button>
                        </section>
                    </div>
                </form>

                <div id="link">
                    <p onclick="location.href='./index.php'">
                        온라인접수로 바로가기
                        <i class="fa-solid fa-chevron-right"></i>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/enc-base64-min.js"></script>
    <script src="./js/solapi.js"></script>


    <script>
        function counselClassChange() {
            var counselClass = document.getElementById("counselClass");
            var value = (counselClass.options[counselClass.selectedIndex].value);
        }

        function counselStartTimeChange() {
            var counselStartTime = document.getElementById("counselStartTime");
            var value = (counselStartTime.options[counselStartTime.selectedIndex].value);
        }

        function counselEndTimeChange() {
            var counselEndTime = document.getElementById("counselEndTime");
            var value = (counselEndTime.options[counselEndTime.selectedIndex].value);
        }

        function counsel_cancel() {
            // confirm("상담 신청을 취소하시겠습니까?");

            if(confirm("상담 신청을 취소하시겠습니까?")==true) {
                location.href = './counselCancel.php';
            }
        }

        function counsel_sendMessage() {
            // let counselClass = document.counsel.counselClass.value;
            // let counselName = document.counsel.counselName.value;
            // let counselPhone = document.counsel.counselPhone.value;
            // let counselStartTime = document.counsel.counselStartTime.value;
            // let counselEndTime = document.counsel.counselEndTime.value;
            // document.counsel.submit();

            let counsel = document.getElementById('counsel');

            // 상담과정 미입력시
            if(!counsel.counselClass.value) {
                alert("상담 신청할 과정을 선택해주세요.");
                counsel.counselClass.focus();
                return;
            }

            // 이름 미입력시
            if(!counsel.counselName.value) {
                alert("이름을 입력해주세요.");
                counsel.counselName.focus();
                return;
            }

            // 연락처 미입력시
            if(!counsel.counselPhone.value) {
                alert("연락처를 입력해주세요.");
                counsel.counselPhone.focus();
                return;
            }

            // 연락가능시간 미입력시
            if(!counsel.counselStartTime.value) {
                alert("연락 가능 시간을 선택해주세요.");
                counsel.counselStartTime.focus();
                return;
            }

            if(!counsel.counselEndTime.value) {
                alert("연락 가능 시간을 선택해주세요.");
                counsel.counselEndTime.focus();
                return;
            }

            counsel.action = "./counselModify.php";
            counsel.submit();
        }

        $(document).ready(function() {
            $("#counselClass").val("<?=$class?>").prop("selected", true);
            $("#counselStartTime").val("<?=$start?>").prop("selected", true);
            $("#counselEndTime").val("<?=$end?>").prop("selected", true);
            $("#counselQuestion").val("<?=$question?>");
        });

        // 문의글 글자수 제한(200자)
        $(".questionInput > textarea").keyup(function() {
            var content = $(this).val();
            
            if(content.length > 200) {
                $(this).val(content.substring(0, 200));
            }
        });
    </script>
</body>
</html>