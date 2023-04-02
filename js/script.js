//로딩
// $(document).ready(function () {
    
//     $('.preloader').delay('3000').fadeOut();
//     $('#container').css('display',"block");

// })


// header 스크롤 내릴 때 사라지고, 스크롤 올릴 때 나타남
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementsByTagName("header")[0].style.top = "0";
    } else {
        document.getElementsByTagName("header")[0].style.top = "-100px";
    }
    prevScrollpos = currentScrollPos;
}

//스크롤 위치 따라 메뉴 배경색과 글씨색 변경
$(document).ready(function() {
    var headerOffset = $('header').offset();
    var Offset = $('#gradation').offset();
    $(window).scroll(function() {
        if($(document).scrollTop() > headerOffset.top) {
            $("header a").addClass('white');
            $("header").css('background-color', 'white');
            $("#headerLogo a").css('color', 'black');
            $("#gnb a").css('color', 'black');
        } 
   
    });
})


// #conMain .conMainTitle 타이핑 애니메이션                 
document.addEventListener("DOMContentLoaded", function() {
    new TypeIt(".conMainTitle", {
        speed: 64,
        waitUntilVisible: true,
        afterComplete: function (instance) {
            instance.destroy();
        } //커서 없애기
    })
    
        .type("<span>비전공자도 개발자들의 길로 이어준다!</span>")
        .pause(300)
        .break({ delay: 300 }) //한줄띄우기
        .type("미래를 잇는 ", { delay: 200 })
        .move(-2) //두칸 다시 돌아가기
        .type("(IT)")
        .move(null, { to: "END" }) //타이핑 했던 곳으로 다시 돌아가기
        .type("영진직업전문학교")
        .break({ delay: 300 })
        .type("<span>&nbsp;&nbsp;K-디지털 트레이닝&nbsp;&nbsp;</span>")
        .go() //타이핑 시작
});

// #conCareer 취업률
$(function(){
    //스크롤 -> 이벤트 한번만 실행
    var executed = false; 

    // 윈도우에 스크롤이 생기면 숫자 애니메이션
    $(window).scroll(function(){
        
        
        var scrollHeight = $(window).scrollTop();
        var threshold = $('#conCareer').offset().top;

        
            if(!executed){ //if(executed == false) 
            if( scrollHeight > threshold - 600){
                // animate 클래스의 속성값 data-rate
                // animate progress 사용자 속성 값 percent ->>> 89.3%
                var progressRate = $('.animate').attr('data-rate');
                

                // percent 아무런 뜻이 없는 사용자 속성 값
                $({percent:0}).animate({percent:progressRate},{
                    //옵션 여러개 나열 중괄호
                    duration: 1500,
                    progress: function(){
                        var now = this.percent;
                        // console.log(now);
                        $('.animate').text(now.toFixed(1)+'%'); 

                        // 윈도우에 스크롤이 생기면 막대 애니메이션

                        $(".grp_1").animate({ height: "80%" }, {
                    
                            duration: 750
                        }
                        );
                        $(".grp_2").animate({ height: "85%" }, {
                            
                            duration: 800
                        }
                        );
                        $(".grp_3").animate({ height: "87%" }, {
                            
                            duration: 850
                        }
                        );
                        $(".grp_4").animate({ height: "89.3%" }, {
                            
                            duration: 1000
                        }
                        );
                    } 
                }); // 숫자 애니메이션
                executed = true; //실행됐다 -> 이벤트 더이상 실행 되지 않음
            }//if 조건문
        } // executed if문
    });
});

//it과정소개 tab 클릭시 내용 변경

$(document).ready(function() {
    $("#conClassTab > div").click(function() {
        let index = $(this).index();
        $("#conClassTab > div").removeClass("on");
        $("#conClassTab > div").eq(index).addClass("on");
        $("#conClassItem > div").hide();
        $("#conClassItem > div").eq(index).show();
    })
});

//it과정소개 tab_fixed 클릭시 내용 변경
$(document).ready(function() {
    $(".conClassTab_sticky > ul > li").click(function() {
        let index = $(this).index();
        $(".conClassTab_sticky > ul > li").removeClass("on");
        $(".conClassTab_sticky > ul > li").eq(index).addClass("on");
        $("#conClassItem > div").hide();
        $("#conClassItem > div").eq(index).show();
    })
});



  // 모바일 버전 슬라이더 ( it 과정 세부내용 
$(document).ready(function () {
      
    var swiper = new Swiper(".tab_swiper", {
        spaceBetween: 24,
        slidesPerView: 1,
        loop: true,
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            
            1024: {
                slidesPerView: 5,
                spaceBetween: 50,
                autoplay: false
            },
        } // 반응형 
    }); //탭 슬라이더

    // 클릭시 초기화...메소드 오류 안 나는데 기능은 x
    // $(".tab_swiper").each(function(elem, target){
    //     var swp = target.swiper;
    //     $('#conClassTab > div').click(function() {
    //         swp.init();
    //         swp.autoplay.start();

    //     }) //클릭
    // });
})




//리뷰 슬라이더
$(document).ready(function(){
  
     const swiper = new Swiper('.vertical_swiper', {
  
        slidesPerView: 1,
        direction: "vertical",
        loop: true,
        observer: true,
        observeParents: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        }
  
  });

  $(".vertical_swiper").each(function(elem, target){
    var swp = target.swiper;
    $(this).hover(function() {
        swp.autoplay.stop();
    }, function() {
        swp.autoplay.start();
    });
    //클릭시 초기화...메소드 오류 안 나는데 기능은 x
    $(".vertical_swiper").each(function(elem, target){
        var swp = target.swiper;
        $("#conClassTab > div").each(function(elem, target) {
            $(this).click(function() {
            swp.init();
            swp.autoplay.start();
            console.log("click!");
        }) //클릭
    });

});
  

});
})

//포트폴리오 슬라이더
$(document).ready(function(){
    
    var swiper = new Swiper(".swiper_PF", {
        spaceBetween: 24,
        slidesPerView: 1,
        loop: true,
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        breakpoints: {
            320: {
                slidesPerView: 2,
            },
            600: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 2,
            },
            1900: {
                slidesPerView: 3,
            },
        } // 반응형 
    }); //탭 슬라이더

    $(".swiper_PF").each(function(elem, target){
        var swp = target.swiper;
        $(this).hover(function() {
            swp.autoplay.stop();
        }, function() {
            swp.autoplay.start();
        });
    });
        
})

// 접수과정 절차
$(document).ready(function () {
      
    var swiper = new Swiper(".process_swiper", {
        spaceBetween: 24,
        slidesPerView: 1,
        autoplay: {
            delay: 1500,
            disableOnInteraction: false,
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        }, 
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            
            1024: {
                slidesPerView: 4,
                spaceBetween: 20,

            },
        } // 반응형 
    }); //탭 슬라이더
     
}) //document 준비완



// 온라인접수 & 상담문의 폼 탭 메뉴
$(document).ready(function() {
    $("#tap2_text li").click(function() {
        var idx = $(this).index();
        $("#tap2_text li").removeClass("on");
        $("#tap2_text li").eq(idx).addClass("on");
        $("#tap2_img img").hide();
        $("#tap2_img img").eq(idx).show();
    })
})
