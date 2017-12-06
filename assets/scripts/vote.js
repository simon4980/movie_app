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
                $('#votes_count').html(data.vote_count);

                for(var loop = 0; loop < 5; loop++) {
                    if (loop < data.vote_avg) {
                        $_this.vote_links.eq(loop).find('span').addClass('glyphicon-star').removeClass('glyphicon-star-empty');
                    } else {
                        $_this.vote_links.eq(loop).find('span').addClass('glyphicon-star-empty').removeClass('glyphicon-star');
                    }

                    $_this.vote_links.eq(loop).addClass('disabled');

                }

            }
        });
    }
}

objVoteApi = new voteApi()
