<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title> 온라인 접수 조회 </title>

    <!--jQuery-->
    <script src="./js/jquery-3.6.1.js"></script>

    <!--css-->
    <link rel="stylesheet" href="./css/applyReferForm.css">
</head>

<body>
    <?php
        session_start();
        $sessionClass = $_SESSION["applyClass"];
        $sessionPhone = $_SESSION["applyPhone"];

        $con = mysqli_connect("localhost", "yjjobkdt", "itsw8877%", "yjjobkdt");
        $sql = "select * from apply where class = '$sessionClass' and phone = '$sessionPhone'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $class = $row["class"];
        $name = $row["name"];
        $birth = $row["birth"];
        $gender = $row["gender"];
        $phone = $row["phone"];
        $start = $row["start"];
        $end = $row["end"];
        $school = $row["school"];
        $major = $row["major"];
        $question = $row["question"];

        mysqli_close($con);
    ?>

    <!--온라인접수 조회-->
    <section id="conForm">
        <!--제목-->
        <div id="conFormTitle">
            <h1> 온라인접수 조회/수정 </h1>
        </div>

        <!-- 폼 박스 -->
        <div id="conFormBox">
            <!-- 온라인 접수 -->
            <div id="conApplyForm">
                <form id="apply" name="apply" method="post">
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
                                <p> 접수과정 <span> * </span> </p>

                                <div class="classInput">
                                    <select name="applyClass" id="applyClass" onchange="applyClassChange();">
                                        <option disabled="disabled"> 접수할 과정을 선택해주세요. </option>
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
                                    <input type="text" name="applyName" value="<?=$name?>" id="applyName" placeholder="이름을 입력해주세요">
                                </div>
                            </section>

                            <section>
                                <p> 생년월일 <span> * </span> </p>
        
                                <div class="birthInput">
                                    <input type="date" name="applyBirth" value="<?=$birth?>" id="applyBirth">
                                </div>
                            </section>
                        </div>

                        <div>
                            <section>
                                <p> 성별 <span> * </span> </p>

                                <div class="genderInput">
                                    <div class="radio">
                                        <input type="radio" name="applyGender" value="F" id="applyGenderFemale"
                                                <?php if($gender=="F") { ?> checked="checked" <?php } ?> >
                                        <label for="applyGenderFemale"> 여성 </label>
                                    </div>

                                    <div class="radio">
                                        <input type="radio" name="applyGender" value="M" id="applyGenderMale"
                                                <?php if($gender=="M") { ?> checked="checked" <?php } ?> >
                                        <label for="applyGenderMale"> 남성 </label>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="flex">
                            <section>
                                <p> 연락처 <span> * </span> </p>

                                <div class="phoneInput">
                                    <input type="text" name="applyPhone" value="<?=$phone?>" id="applyPhone" placeholder="예시) 01012345678">
                                </div>
                            </section>

                            <section>
                                <p> 연락가능시간 <span> * </span> </p>

                                <div class="timeInput">
                                    <select name="applyStartTime" id="applyStartTime" onchange="applyStartTimeChange();">
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

                                    <select name="applyEndTime" id="applyEndTime" onchange="applyEndTimeChange();">
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

                        <div class="flex">
                            <section>
                                <p> 최종학교 </p>

                                <div class="schoolInput">
                                    <input type="text" name="applySchool" value="<?=$school?>" id="applySchool" placeholder="최종학교명을 입력해주세요">
                                </div>
                            </section>

                            <section>
                                <p> 학과 </p>

                                <div class="majorInput">
                                    <input type="text" name="applyMajor" value="<?=$major?>" id="applyMajor" placeholder="학과명을 입력해주세요">
                                </div>
                            </section>
                        </div>

                        <div>
                            <section>
                                <p> 문의글 </p>

                                <div class="questionInput">
                                    <textarea name="applyQuestion" value="" id="applyQuestion" placeholder="문의 내용(200자 이내)"></textarea>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- 버튼 -->
                    <div class="formBtn">
                        <section>
                            <button type="button" class="resetBtn" id="applyReset" onclick="apply_cancel();"> 접수취소 </button>
                        </section>

                        <section>
                            <button type="button" class="submitBtn" id="applySubmit" onclick="apply_sendMessage();"> 수정완료 </button>
                        </section>
                    </div>
                </form>
            </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/enc-base64-min.js"></script>
    <script src="./js/solapi.js"></script>

    <script>
        function getPfInfo() {
            let pfId = document.getElementById('pfId').value;
            getPlusfriend(pfId);
        }

        function getTemplateInfo() {
            let templateId = document.getElementById('templateId').value;
            getTemplate(templateId);
        }

        function applyClassChange() {
		    var applyClass = document.getElementById("applyClass");
		    var value = (applyClass.options[applyClass.selectedIndex].value);
	    }

        function applyStartTimeChange() {
		    var applyStartTime = document.getElementById("applyStartTime");
		    var value = (applyStartTime.options[applyStartTime.selectedIndex].value);
	    }

        function applyEndTimeChange() {
		    var applyEndTime = document.getElementById("applyEndTime");
		    var value = (applyEndTime.options[applyEndTime.selectedIndex].value);
	    }

        function apply_cancel() {
            // confirm("온라인 접수를 취소하시겠습니까?");

            if(confirm("온라인 접수를 취소하시겠습니까?")==true) {
                location.href = './applyCancel.php';
            }
        }

        function apply_sendMessage() {
            // let applyClass = document.apply.applyClass.value;
            // let applyName = document.apply.applyName.value;
            // let applyBirth = document.apply.applyBirth.value;
            // let applyPhone = document.apply.applyPhone.value;
            // let applyStartTime = document.apply.applyStartTime.value;
            // let applyEndTime = document.apply.applyEndTime.value;
            // document.apply.submit();

            let apply = document.getElementById('apply');

            // 접수과정 미입력시
            if(!apply.applyClass.value) {
                alert("접수할 과정을 선택해주세요.");
                apply.applyClass.focus();
                return;
            }

            // 이름 미입력시
            if(!apply.applyName.value) {
                alert("이름을 입력해주세요.");
                apply.applyName.focus();
                return;
            }

            // 생일 미입력시
            if(!apply.applyBirth.value) {
                alert("생년월일을 입력해주세요.");
                apply.applyBirth.focus();
                return;
            }

            // 성별 미입력시
            if(!apply.applyGender.value) {
                alert("성별을 선택해주세요.");
                apply.applyGender.focus();
                return;
            }

            // 연락처 미입력시
            if(!apply.applyPhone.value) {
                alert("연락처를 입력해주세요.");
                apply.applyPhone.focus();
                return;
            }

            // 연락가능시간 미입력시
            if(!apply.applyStartTime.value) {
                alert("연락 가능 시간을 선택해주세요.");
                apply.applyStartTime.focus();
                return;
            }
            if(!apply.applyEndTime.value) {
                alert("연락 가능 시간을 선택해주세요.");
                apply.applyEndTime.focus();
                return;
            }

            apply.action = "./applyModify.php";
            apply.submit();
        }

        $(document).ready(function() {
            $("#applyClass").val("<?=$class?>").prop("selected", true);
            $("#applyStartTime").val("<?=$start?>").prop("selected", true);
            $("#applyEndTime").val("<?=$end?>").prop("selected", true);
            $("#applyQuestion").val("<?=$question?>");
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