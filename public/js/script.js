"use strict";
$(document).ready(function () {
    $("#txtserach").change(function () {
        var value = $("#txtserach").val();
        $.ajax({
            url: "http://" + window.location.host + "/api/words/search/" + value,
            method: 'GET',
            success: function (e) {
                var dataWords = e['data'];
                console.log(dataWords);
                $('#wordElements').empty();
                var flag = false;
                for (let index = 0; index < dataWords.length; index++) {
                    const element = dataWords[index];
                    var el = `<div class="col-xl-6 col-md-6 mb-3"><div class="card mb-1"><div class="card-block"><div class="row align-items-center"><div class="col-12"><span class="float-right">${(index + 1)} </span><h4 class="text-c-purple">${element['vocabulary']}<span class="font-italic category"> (${element['category_name']})</span></h4><h6 class="text-muted m-b-0">${element['translate']}</h6></div></div></div></div></div>`;
                    $('#wordElements').append(el);
                    flag = true;
                }

                if (!flag) {
                    var el = '<span> Nothing... </span>';
                    $('#wordElements').append(el);
                }
            }
        });
    }).change();
    
    $("#filter").change(function () {
        var valueFilter = $("#filter option:selected").val();
        $.ajax({
            url: "http://" + window.location.host + "/api/words/" + valueFilter,
            method: 'GET',
            success: function (e) {
                $('#wordElements').empty();
                let data = e['data'];
                var index = 1;
                let elementOld;
                if (data.length) {
                    for (let element of data) {
                        if (index > 1 && valueFilter == 2 && element['category_id'] != elementOld['category_id']) {
                            $('#wordElements').append('<hr class="between">');
                        }
                        let el = `<div class="col-xl-6 col-md-6 mb-3"><div class="card mb-1"><div class="card-block"><div class="row align-items-center"><div class="col-12"><span class="float-right">${index}</span><h4 class="text-c-purple">${element['vocabulary']}<span class="font-italic category"> (${element['category_name']})</span></h4><h6 class="text-muted m-b-0">${element['translate']}</h6></div></div></div></div></div>`;
                        $('#wordElements').append(el);
                        elementOld = element;
                        index++;
                    };
                }
                else {
                    $('#wordElements').append('<span>Nothing...</span>');
                }
            }
        });
    }).change();

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

    $('#changePass').click(function () {
        if ($(this).prop("checked") == true) {
            $('#container_password').show();
            $('.pass').prop('required', true);
        } else {
            $('#container_password').hide();
            $('.pass').prop('required', false);
        }
    });
    $('#edit').click(function () {
        if ($(this).prop("checked") == true) {
            $('#form-edit-user').show();
        } else {
            $('#form-edit-user').hide();
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
var resultAccepts = [];
function checkAnswer(idQuestion) {
    var answer = $('input[name=options' + idQuestion + ']:checked', '#questions' + idQuestion).val();
    $(document).ready(function () {
        if (!answer) {
            alert('Havent chosen an answer yet');
        }
        else {
            $.ajax({
                url: "http://" + window.location.host + "/api/questions/check",
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
                        resultAccepts.push(result['vocabulary']);
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
                url: "http://" + window.location.host + "/api/user/lesson/result",
                method: 'POST',
                data: {
                    result: resultAnswer,
                    lesson_id: $('#lesson_id').text(),
                    user_id: $('#user_id').text(),
                    resultAccepts, resultAccepts,
                },
                success: function (e) {
                    window.location.replace("http://" + window.location.host + "/lessons/" + e);
                }
            });
        });
    }, 2000);
}

var ping = $('#ping');
var notificationsWrapper = $('#notification-header');
var notificationsCountElem = notificationsWrapper.find('label[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = $('#accordion');

var pusher = new Pusher('7e9599866486c64c29f0', {
    encrypted: true,
    cluster: "ap1"
});

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('development');

// Bind a function to a Event (the full Laravel class)
channel.bind('my-event', function (data) {
    data = data['data'];
    var existingNotifications = notifications.html();
    var newNotificationHtml;
    if (data.type == 0) {
        newNotificationHtml = `<div id="notification-show" class="accordion-panel">
                                    <div class="accordion-heading row" role="tab" id="heading${data.id}">
                                        <h3 class="card-title accordion-title col-8">`;
        if (data.is_read == 0) {

            newNotificationHtml = newNotificationHtml.concat(`<a id="title${data.id}" onclick='showContentNotify("${data.id}")' class="accordion-msg waves-effect waves-dark" data-toggle="collapse" data-parent="#accordion" href="#collapseOne${data.id}" aria-expanded="true" aria-controls="collapseOne${data.id}">
                        ${data.content.substring(0, 40)}...</a>`);
        } else {

            newNotificationHtml = newNotificationHtml.concat(`<a id="title${data.id}" class="waves-effect waves-dark nomal" data-toggle="collapse" data-parent="#accordion" href="#collapseOne${data.id}" aria-expanded="true" aria-controls="collapseOne${data.id}">
                        ${data.content.substring(0, 40)}...</a>`);
        }
    } else {
        newNotificationHtml = `<div id="notification-show" class="accordion-panel">
                                    <div class="accordion-heading row" role="tab" id="heading${data.id}">
                                        <h3 class="card-title accordion-title col-8">`;
        if (data.is_read == 0) {

            newNotificationHtml = newNotificationHtml.concat(`<a id="title${data.id}" onclick='showContentNotify("${data.id}")' class="accordion-msg waves-effect waves-dark" data-toggle="collapse" data-parent="#accordion" href="#collapseOne${data.id}" aria-expanded="true" aria-controls="collapseOne${data.id}">
                        ${data.content.substring(0, 40)}...</a>`);
        } else {

            newNotificationHtml = newNotificationHtml.concat(`<a id="title${data.id}" class="waves-effect waves-dark nomal" data-toggle="collapse" data-parent="#accordion" href="#collapseOne${data.id}" aria-expanded="true" aria-controls="collapseOne${data.id}">
                        ${data.content.substring(0, 40)}...</a>`);
        }
    }

    newNotificationHtml = newNotificationHtml.concat(`</h3>
                                                        <span class="float-right txt-time col-4">${data.created_at}</span>
                                                            </div>
                                                                <div id="collapseOne${data.id}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading${data.id}">
                                                                    <div class="accordion-content accordion-desc">
                                                                        <p>
                                                                            ${data.content}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>`);

    notifications.html(newNotificationHtml + existingNotifications);

    notificationsCount += 1;
    notificationsCountElem.attr('data-count', notificationsCount);
    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
    if (notificationsCount > 0) {
        ping.addClass('badge label-danger');
    } else {
        ping.removeClass('badge label-danger');
    }
});

function showContentNotify(id) {

    if ($('#title' + id).css('font-weight') != 100) {
        $('#title' + id).css("font-weight", "100");
        $.ajax({
            url: "http://" + window.location.host + "/api/notification/update/" + id,
            method: 'PUT',
            data: {
                id: id
            },
            success: function (e) {
                if (e['message'] == 'success') {
                    notificationsCount -= 1;
                    notificationsCountElem.attr('data-count', notificationsCount);
                    notificationsWrapper.find('.notif-count').text(notificationsCount);
                    notificationsWrapper.show();
                    if (notificationsCount > 0) {
                        ping.addClass('badge label-danger');
                    } else {
                        ping.removeClass('badge label-danger');
                    }
                }
            }
        });
    }
}

var today = new Date();
var date = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();
document.getElementById('time').innerHTML = date;
var monOfYear = [
    'January', 'February', 'March',
    'April', 'May', 'June',
    'July', 'August', 'September',
    'October', 'November', 'December'
];
google.charts.load('current', {
    'packages': ['line', 'corechart', 'bar']
});

function getDataChartByTopicMonth(month = today.getMonth() + 1, year = today.getFullYear()) {
    $.ajax({
        url: "http://" + window.location.host + "/api/chart/topic-of-month/" + month + "/" + year,
        method: 'GET',
        success: function (e) {
            google.charts.setOnLoadCallback(drawDonutChart)
            function drawDonutChart() {
                var arr = [['Name Topic', 'Number Selected'],];
                for (let element of e) {
                    arr.push([element.name, element.count]);
                }

                var data = google.visualization.arrayToDataTable(arr);
                var options = {
                    title: 'Statistics of likes by topic of ' + monOfYear[month[1] - 1],
                    pieHole: 0.4,
                    width: 500,
                    height: 400,
                    backgroundColor: {
                        fill: '#eff5f7',
                    },
                };

                var chart = new google.visualization.PieChart(document.getElementById('donut-topic-month'));
                chart.draw(data, options);
            }
        }
    });
}

function getDataChartByTopicYear(year = today.getFullYear()) {
    $.ajax({
        url: "http://" + window.location.host + "/api/chart/topic-of-year/" + year,
        method: 'GET',
        success: function (e) {
            google.charts.setOnLoadCallback(drawDonutChart)
            function drawDonutChart() {
                var arr = [['Name Topic', 'Number Selected'],];
                for (let element of e) {
                    arr.push([element.name, element.count]);
                }

                var data = google.visualization.arrayToDataTable(arr);
                var options = {
                    title: 'Statistics of likes by topic of ' + year,
                    pieHole: 0.4,
                    width: 500,
                    height: 400,
                    backgroundColor: {
                        fill: '#eff5f7'
                    },
                };

                var chart = new google.visualization.PieChart(document.getElementById('donut-topic-year'));
                chart.draw(data, options);
            }
        }
    });
}
function getDataUserRegisterByYear(year = today.getFullYear()) {
    $.ajax({
        url: "http://" + window.location.host + "/api/chart/user-register/" + year,
        method: 'GET',
        success: function (e) {
            google.charts.setOnLoadCallback(drawLineChart)
            function drawLineChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Month');
                data.addColumn('number', 'Number Of User Registed');
                var arr = [];
                var i = 1;
                monOfYear.forEach(element => {
                    arr.push([element, e[i]]);
                    i++;
                });
                data.addRows(arr);

                var options = {
                    chart: {
                        title: 'Statistics of account registrations by month in ' + year,
                    },
                    vAxis: {
                        title: 'Total Register',
                    },
                    width: 1000,
                    height: 400,
                    backgroundColor: {
                        fill: '#eff5f7'
                    },
                    chartArea: {
                        backgroundColor: '#eff5f7'
                    }
                };
                var chart = new google.charts.Line(document.getElementById('linechart'));

                chart.draw(data, google.charts.Line.convertOptions(options));
            }
        }
    });
}

function getDataChartByCourseByRegister(month = today.getMonth() + 1, year = today.getFullYear()) {
    $.ajax({
        url: "http://" + window.location.host + "/api/chart/course-regiser/" + month + "/" + year,
        method: 'GET',
        success: function (e) {
            google.charts.setOnLoadCallback(drawChar);
            function drawChar() {
                var arr = [['Course', 'Number of user registed'],];
                for (let element of e) {
                    arr.push([element.name, element.count]);
                }

                var data = google.visualization.arrayToDataTable(arr);

                var options = {
                    title: 'Statistics of course registrations by month in ' + year,
                    chartArea: { width: '50%' },
                    isStacked: true,
                    hAxis: {
                        title: 'Total Register',
                        minValue: 0,
                        format: '#',
                    },
                    vAxis: {
                        title: 'Course'
                    },
                    backgroundColor: {
                        fill: '#eff5f7'
                    },
                };
                var chart = new google.visualization.BarChart(document.getElementById('bar-course-month'));
                chart.draw(data, options);
            }
        }
    });
}


$(document).ready(function () {
    getDataChartByTopicMonth();
    getDataChartByTopicYear();
    getDataUserRegisterByYear();
    getDataChartByCourseByRegister();

    $("#select-topic-month").change(function () {
        var value = $(this).val().split('-');
        getDataChartByTopicYear(value[0]);
        getDataChartByTopicMonth(value[1], value[0]);
        getDataUserRegisterByYear(value[0]);
        getDataChartByCourseByRegister(value[1], value[0]);
    }).change();
});
