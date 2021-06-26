// admin
var ping = $('#ping');
var notificationsWrapper = $('#notification-header');
var notificationsCountElem = notificationsWrapper.find('label[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = $('#accordion');

// user
var bing = $('#bing');
var notificationsW = $('#notification-head');
var notificationsCountE = notificationsW.find('span[data-count]');
var count = parseInt(notificationsCountE.data('count'));
var notificationsUser = $('#accor');
if (count > 0) {
    bing.addClass('badge label-danger');
} else {
    bing.removeClass('badge label-danger');
}

var pusher = new Pusher('7e9599866486c64c29f0', {
    encrypted: true,
    cluster: "ap1"
});

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('development');
console.log($('#id_user').text());
// Bind a function to a Event (the full Laravel class)
channel.bind('my-event', function (data) {
    data = data['data'];
    if (data.role == "ADM") {
        var existingNotifications = notifications.html();
        var newNotificationHtml;
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
    }
    else {
        if ($.trim(data.role) == $.trim($('#id_user').text())) {
            var existingNotifications = notificationsUser.html();
            var newNotificationHtml = `<li class="waves-effect waves-light">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="notification-user">Bot</h5>
                                                <p class="notification-msg">${data.content}.</p>
                                                <span class="notification-time">${data.created_at}</span>
                                            </div>
                                                <button>del</button>
                                            </div>
                                        </li>`;



            notificationsUser.html(newNotificationHtml + existingNotifications);
            console.log(notificationsUser);
            count += 1;
            notificationsCountE.attr('data-count', count);
            notificationsW.find('#count-notify-user').text(count);
            notificationsW.show();
            if (count > 0) {
                bing.addClass('badge label-danger');
            } else {
                bing.removeClass('badge label-danger');
            }
        }
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
