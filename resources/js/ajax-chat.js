let sender_id = document.querySelector('.current-user').dataset.id;
let receiver_id = "";
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    Echo.private(`chat-channel.${sender_id}`)
    .listen('MessageEvent', (event) => {
        let fromId = event.message.from_id;
        let pending = $('#' + fromId).find('.pending');
        if (!pending.length) {
            $('#' + fromId).append('<span class="pending"></span>')
        }
        $(`#${fromId} .last-message-user`).html(`<span class="unread-message">${event.message.content}</span>`);
        let html = `<div class="receive-container"><div class="message receive"><div class="message-content"><span>${event.message.content}</span></div><div class="message-time"><span>${event.message.created_at}</span></div></div></div>`;
        $('.content-chat-message').append(html);
        scrollToBottom();

    });

    $('.user-item-chat').click(function() {
        $('.mentor-container').addClass('d-none');
        $('.mentor-container.chat-content').removeClass('d-none');
        $('.user-item-chat').removeClass('active-chat');
        $(this).addClass('active-chat');
        let userName = $(this).data('name');
        receiver_id = $(this).attr('id');
        $(`#${receiver_id} span`).removeClass('unread-message');
        $(`#${receiver_id} .pending`).remove();
        $.ajax({
            type: "get",
            url: "/message/" + receiver_id,
            data: receiver_id,
            cache: false,
            success: function(data) {
                $('#text-chat').html(data);
                $('.header-chat .name-mentor').text(userName);
                scrollToBottom();
                $('.cross').click(function() {
                    $('.mentor-container').removeClass('d-none');
                    $('.mentor-container.chat-content').addClass('d-none');
                    $('.user-item-chat').removeClass('active-chat');
                });
            }
        });
    });
    $(document).on('keyup', '.send-action input', function(event) {
        let message = $(this).val();
        if (event.keyCode == 13 && message != '' && receiver_id != ''){
            $(this).val('');
            let dataMessage = "receiver_id=" + receiver_id + "&message=" + message;
            let urlPostMessage = $('.url-chat.d-none').data('url');
            $.ajax({
                type: "POST",
                url: urlPostMessage,
                data: dataMessage,
                cache: false,
                success: function (data) {
                    let html = `<div class="sender-container"><div class="message sender"><div class="message-content"><span>${data.content}</span></div><div class="message-time"><span>${data.created_at}</span></div></div></div>`;
                    $('.content-chat-message').append(html);
                    scrollToBottom();
                },
                error: function (jgXHR, status, err) {
                    alert(err);
                },
                complete: function() {
                    
                }
            })
        }
    });

    function scrollToBottom() {
        $('.content-chat-message').animate({
            scrollTop: $('.content-chat-message').get(0).scrollHeight
        }, 0);
    }
})
