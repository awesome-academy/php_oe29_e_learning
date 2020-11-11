document.addEventListener("DOMContentLoaded", function () {
    let buttonProfile = document.querySelectorAll('.mentor-profile-button');
    buttonProfile.forEach( function(item) {
        item.addEventListener('click', function(event) {
            let blackId = '#black-' + this.dataset.id;
            let contentId = '#content-' + this.dataset.id;
            let closeId = '#close-' + this.dataset.id;
            let black = document.querySelector(blackId);
            let content = document.querySelector(contentId);
            let close = document.querySelector(closeId);
            let overflow = document.querySelector('body');

            black.classList.add('show');
            content.classList.add('move-to-left');
            overflow.classList.add('remove-scroll');

            close.onclick = function() {
                black.classList.remove('show');
                content.classList.remove('move-to-left');
                overflow.classList.remove('remove-scroll');
            }
        })
    });
}, false);
