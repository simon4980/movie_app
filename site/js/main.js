function voteApi() {
    this.movie_id;
    this.vote_value = 0;
    this.vote_links = $('#rating a');
    this.init();
}

voteApi.prototype.init = function() {
    this.attachClick();
}

voteApi.prototype.attachClick = function() {
    var $_this = this;
    this.vote_links.click(function(e){
        e.preventDefault();
        $_this.movie_id = $(this).attr('data-movie_id');
        $_this.vote_value = $_this.vote_links.index(this) + 1
        $_this.submit();
    });
}

voteApi.prototype.submit = function() {
    var $_this = this;
    if (this.vote_value > 0 && this.movie_id > 0) {
        $.ajax({
            url: '/voteapi',
            method: 'POST',
            data: {
                'csrf_test_name': csrfHash,
                'movie_id': this.movie_id,
                'rate': this.vote_value
            },
            success:function(data) {
                if (data.success) {
                    $('#votes_count').html(data.vote_count);

                    for (var loop = 0; loop < 5; loop++) {
                        if (loop < data.vote_avg) {
                            $_this.vote_links.eq(loop).find('span').addClass('glyphicon-star').removeClass('glyphicon-star-empty');
                        } else {
                            $_this.vote_links.eq(loop).find('span').addClass('glyphicon-star-empty').removeClass('glyphicon-star');
                        }

                        $_this.vote_links.eq(loop).addClass('disabled');

                    }
                } else {
                    alert('Error: please refresh and try again.');
                }

            }
        });
    }
}

objVoteApi = new voteApi()


$(document).ready(function() {
    $(".animsition").animsition({
        inClass: 'fade-in-up',
        outClass: 'fade-out-up',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
        loading: true,
        loadingParentElement: 'body', //animsition wrapper element
        loadingClass: 'animsition-loading',
        loadingInner: '', // e.g '<img src="loading.svg" />'
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'body',
        transition: function(url){ window.location.href = url; }
    });
});
