$(function(){
    $(document).on('click', '.t-show-popup', function() {
        var tweetID = $(this).data('tweet');
        $.post('http://localhost:1111/tweety/core/ajax/popuptweets.php', {showpopup:tweetID}, function(data) {
            $('.popupTweet').html(data);
            $('.tweet-show-popup-box-cut').click(function(){
                $('.tweet-show-popup-wrap').hide();
            });
        });
    });

    // $(document).on('click', '.imagePopup', function(e) {
    //     e.stopPropagation();
    //     var tweetID = $(this).data('tweet');
    //     $.post("http://localhost:1111/tweety/core/ajax/imagePopup.php", {showImage: tweetID}, function(data) {
    //         $('.popupTweet').html(data);
    //     });
    // });
});