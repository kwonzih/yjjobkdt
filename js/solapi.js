/* 
    보안
    - 사용할 경우 apiKey와 apiSecret의 값만 변경
*/

// api key
const apiKey = 'NCSJTUHVWWQ0EWKT';
// api secret
const apiSecret = 'AU16IKRS7CVUPXXWOWP3ECGMEFBB7VCQ';
// pfId(ChannelID)
const pfId = 'KA01PF22041206411o33TFWW9Sl71Ppp';
// Template ID
const templateId = 'KA01TP2301190235299888HNuMzFI1Xm';

// authoriztion
function getAuthorization() {
    let salt = getSalt(); // 랜덤값(30)
    let date = getDate(); // 오늘 날짜
    let value = date + salt; // 랜덤값(30) + 오늘 날짜
    let signature = getSignature(value, apiSecret);
    let authoriztion = 'HMAC-SHA256 apiKey='+apiKey+', date='+date+', salt='+salt+', signature='+signature;
    
    return authoriztion;
}

// salt: 랜덤한 값 30자 생성
function getSalt() {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    
    for ( var i = 0; i < 30; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    
    return result;
}

// date: 오늘 날짜 가져오기
function getDate() {
    let today = new Date();
    
    return today.toISOString();
}

// signature: 시그니쳐 검증
function getSignature(value, key) {
    // HmacSHA256 : 암호화한 정보
    let signature = CryptoJS.HmacSHA256(value, key);

    return signature;
}

var request;

/*
    보안 구간 끝
*/


// 플러스 친구
function getPlusfriend(pfId) {
    let url = 'https://api.solapi.com/kakao/v1/plus-friends/' + pfId;

    request = new XMLHttpRequest();

    if(!request) {
        alert('request create fail');
        return;
    }

    let authoriztion = getAuthorization();

    request.onreadystatechange = requestResult;
    request.open('GET', url);
    request.setRequestHeader("Content-Type", "application/json");
    request.setRequestHeader("Authorization", authoriztion);
    request.send();
}

// 알림톡 템플릿
function getTemplate(templateId){
    let url = 'https://api.solapi.com/kakao/v1/templates/' + templateId;

    request = new XMLHttpRequest();

    if(!request){
        alert('request create fail');
        return;
    }

    let authoriztion = getAuthorization();

    request.onreadystatechange = requestResult;
    request.open('GET', url);
    request.setRequestHeader("Content-Type", "application/json");
    request.setRequestHeader("Authorization", authoriztion);
    request.send();
}

// 알림톡 보내기
function sendMessage(applyClass, applyName, applyBirth, applyPhone, applyStartTime, applyEndTime) {
    // 메시지를 보내는 url
    let url = 'https://api.solapi.com/messages/v4/send';

    request = new XMLHttpRequest();

    if(!request){
        alert('request create fail');
        return;
    }

    let authoriztion = getAuthorization();

    request.onreadystatechange = requestResult;
    request.open('POST', url);
    request.setRequestHeader("Content-Type", "application/json");
    request.setRequestHeader("Authorization", authoriztion);

    var data = {
        "message": {
            "to": applyPhone,
            "from": "01033528779",
            "type": "ATA",
            "kakaoOptions": {
                "pfId": pfId,
                "templateId": templateId,
                "variables" : {
                    "#{applyName}": applyName,
                    "#{applyClass}": applyClass,
                    "#{applyBirth}": applyBirth,
                    "#{applyPhone}": applyPhone,
                    "#{applyStartTime}": applyStartTime,
                    "#{applyEndTime}": applyEndTime,
                    "#{applyUrl}": "yjjob.or.kr/p/?j=144",
                    "#{applyClassUrl}": "yjjob.or.kr/p/?j=144"
                }
            }
        }
    }
    request.send(JSON.stringify(data));
    return;
}

// 결과 팝업으로 표시
function requestResult() {
    if(request.readyState == XMLHttpRequest.DONE){
        // alert(request.responseText);
    }
}
