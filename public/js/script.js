"use strict";
$(document).ready(function () {
    // card js start
    var elementsVocabulary = document.querySelectorAll('.word');
    for (let index = 0; index < elementsVocabulary.length; index++) {
        const element = elementsVocabulary[index];
        if (index == 0) {
            element.style.animation = "erase 2s";
            continue;
        }
        element.style.display = 'none';
    }

    var currentVocabulary = 0;
    $("#next-vocabulary").on('click', function () {
        currentVocabulary++;
        if (currentVocabulary >= elementsVocabulary.length) {
            alert('The next is list question for this lesson');
            $('#next-vocabulary').remove();
            $('#tools-voice').remove();
            $('#container-vocabulary').remove();
            $('#container-questions').toggle();
            $('#done-questions').toggle();
            $('#container-questions').animation = "erase 2s";
        }
        for (let index = 0; index < elementsVocabulary.length; index++) {
            const element = elementsVocabulary[index];
            if (index == currentVocabulary) {
                element.style.display = 'block';
                element.style.animation = "erase 2s";
                continue;
            }
            element.style.display = 'none';
        }
    });

    $(".card-header-right .close-card").on('click', function () {
        var $this = $(this);
        $this.parents('.card').animate({
            'opacity': '0',
            '-webkit-transform': 'scale3d(.3, .3, .3)',
            'transform': 'scale3d(.3, .3, .3)'
        });

        setTimeout(function () {
            $this.parents('.card').remove();
        }, 800);
    });
    $(".card-header-right .reload-card").on('click', function () {
        var $this = $(this);
        $this.parents('.card').addClass("card-load");
        $this.parents('.card').append('<div class="card-loader"><i class="fa fa-spinner rotate-refresh"></div>');
        setTimeout(function () {
            $this.parents('.card').children(".card-loader").remove();
            $this.parents('.card').removeClass("card-load");
        }, 3000);
    });
    $(".card-header-right .card-option .open-card-option").on('click', function () {
        var $this = $(this);
        if ($this.hasClass('fa-times')) {
            $this.parents('.card-option').animate({
                'width': '30px',
            });
            $(this).removeClass("fa-times").fadeIn('slow');
            $(this).addClass("fa-wrench").fadeIn('slow');
        } else {
            $this.parents('.card-option').animate({
                'width': '140px',
            });
            $(this).addClass("fa-times").fadeIn('slow');
            $(this).removeClass("fa-wrench").fadeIn('slow');
        }
    });
    $(".card-header-right .minimize-card").on('click', function () {
        var $this = $(this);
        var port = $($this.parents('.card'));
        var card = $(port).children('.card-block').slideToggle();
        $(this).toggleClass("fa-minus").fadeIn('slow');
        $(this).toggleClass("fa-plus").fadeIn('slow');
    });
    $(".card-header-right .full-card").on('click', function () {
        var $this = $(this);
        var port = $($this.parents('.card'));
        port.toggleClass("full-card");
        $(this).toggleClass("fa-window-restore");
    });

    $(".card-header-right .icofont-spinner-alt-5").on('mouseenter mouseleave', function () {
        $(this).toggleClass("rotate-refresh").fadeIn('slow');
    });
    $("#more-details").on('click', function () {
        $(".more-details").slideToggle(500);
    });
    $(".mobile-options").on('click', function () {
        $(".navbar-container .nav-right").slideToggle('slow');
    });
    $(".search-btn").on('click', function () {
        $(".main-search").addClass('open');
        $('.main-search .form-control').animate({
            'width': '200px',
        });
    });
    $(".search-close").on('click', function () {
        $('.main-search .form-control').animate({
            'width': '0',
        });
        setTimeout(function () {
            $(".main-search").removeClass('open');
        }, 300);
    });
    // $(".header-notification").on('click', function() {
    //     $(this).children('.show-notification').slideToggle(500);
    //     $(this).toggleClass('active');
    //
    // });

    $(document).ready(function () {
        $(".header-notification").click(function () {
            $(this).find(".show-notification").slideToggle(500);
            $(this).toggleClass('active');
        });
    });
    $(document).on("click", function (event) {
        var $trigger = $(".header-notification");
        if ($trigger !== event.target && !$trigger.has(event.target).length) {
            $(".show-notification").slideUp(300);
            $(".header-notification").removeClass('active');
        }
    });

    // card js end
    $.mCustomScrollbar.defaults.axis = "yx";
    $("#styleSelector .style-cont").slimScroll({
        setTop: "1px",
        height: "calc(100vh - 520px)",
    });
    $(".main-menu").mCustomScrollbar({
        setTop: "1px",
        setHeight: "calc(100% - 56px)",
    });
    /*chatbar js start*/
    /*chat box scroll*/
    var a = $(window).height() - 80;
    $(".main-friend-list").slimScroll({
        height: a,
        allowPageScroll: false,
        wheelStep: 5,
        color: '#1b8bf9'
    });

    // search
    $("#search-friends").on("keyup", function () {
        var g = $(this).val().toLowerCase();
        $(".userlist-box .media-body .chat-header").each(function () {
            var s = $(this).text().toLowerCase();
            $(this).closest('.userlist-box')[s.indexOf(g) !== -1 ? 'show' : 'hide']();
        });
    });

    // open chat box
    $('.displayChatbox').on('click', function () {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat').toggle('slide', options, 500);
    });

    //open friend chat
    $('.userlist-box').on('click', function () {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat_inner').toggle('slide', options, 500);
    });
    //back to main chatbar
    $('.back_chatBox').on('click', function () {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.showChat_inner').toggle('slide', options, 500);
        $('.showChat').css('display', 'block');
    });
    $('.back_friendlist').on('click', function () {
        var my_val = $('.pcoded').attr('vertical-placement');
        if (my_val == 'right') {
            var options = {
                direction: 'left'
            };
        } else {
            var options = {
                direction: 'right'
            };
        }
        $('.p-chat-user').toggle('slide', options, 500);
        $('.showChat').css('display', 'block');
    });
    // /*chatbar js end*/

    $('[data-toggle="tooltip"]').tooltip();

    // wave effect js
    Waves.init();
    Waves.attach('.flat-buttons', ['waves-button']);
    Waves.attach('.float-buttons', ['waves-button', 'waves-float']);
    Waves.attach('.float-button-light', ['waves-button', 'waves-float', 'waves-light']);
    Waves.attach('.flat-buttons', ['waves-button', 'waves-float', 'waves-light', 'flat-buttons']);
});
$(document).ready(function () {
    $(".theme-loader").animate({
        opacity: "0"
    }, 1000);
    setTimeout(function () {
        $(".theme-loader").remove();
    }, 800);
});

// toggle full screen
function toggleFullScreen() {
    var a = $(window).height() - 10;

    if (!document.fullscreenElement && // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement) { // current working methods
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
            document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}

$('body').append('' +
    '<div class="fixed-button">' +
    '<a href="https://themeforest.net/item/mega-able-bootstrap-4-and-angular-5-admin-dashboard-template/20790784?ref=phoenixcoded" target="_blank" class="btn btn-md btn-primary">' +
    '<i class="fa fa-shopping-cart" aria-hidden="true"></i> Upgrade To Pro' +
    '</a> ' +
    '</div>' +
    '');
var $window = $(window);
var nav = $('.fixed-button');
$window.scroll(function () {
    if ($window.scrollTop() >= 200) {
        nav.addClass('active');
    } else {
        nav.removeClass('active');
    }
});

var resultAnswer = 0;
function checkAnswer(idQuestion) {
    var answer = $('input[name=options' + idQuestion + ']:checked', '#questions' + idQuestion).val();
    console.log(answer);
    $(document).ready(function () {
        if (!answer) {
            alert('Havent chosen an answer yet');
        }
        else {
            $.ajax({
                url: "http://localhost:8000/api/questions/check",
                method: 'POST',
                data: {
                    id: idQuestion,
                    answer: answer,
                },
                success: function (result) {
                    result = JSON.parse(result);
                    var options = document.querySelectorAll('.option' + idQuestion);
                    if (result['message'] == 'Faile') {
                        options.forEach(option => {
                            if ($.trim(option.textContent) == $.trim(answer)) {
                                option.style.color = 'red';
                            }
                            if ($.trim(option.textContent) == $.trim(result['correct_answer'])) {
                                option.style.color = 'green';
                            }
                        });
                    }
                    else {
                        options.forEach(option => {
                            if ($.trim(option.textContent) == $.trim(result['correct_answer'])) {
                                option.style.color = 'green';
                            }
                        });
                        resultAnswer += 1;
                    }
                    $('#checkAnswer' + result['id']).remove();
                }
            });
        }
    });
}

function saveResult() {
    var btnChecks = document.querySelectorAll('.checks');
    btnChecks.forEach(check => {
        if (check.attributes.display != 'none') {
            check.click();
        }
    });
    setTimeout(function () {
        $(document).ready(function () {
            $.ajax({
                url: "http://localhost:8000/api/user/lesson/result",
                method: 'POST',
                data: {
                    result: resultAnswer,
                    lesson_id: $('#lesson_id').text(),
                    user_id: $('#user_id').text(),
                },
                success: function (e) {
                    window.location.replace("http://localhost:8000/lessons/" + e);
                }
            });
        });
    }, 2000);


}