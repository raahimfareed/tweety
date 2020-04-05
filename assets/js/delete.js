$(function(){
    $(document).on('click', '.deleteTweet', function(){
        var tweetID = $(this).data('tweet');
        $.post('http://localhost:1111/tweety/core/ajax/deleteTweet.php', {showPopup: tweetID}, function(data){
            $('.popupTweet').html(data);
            $('.close-retweet-popup, .cancel-it').click(function(){
                $('.retweet-popup').hide();
            });
            $(document).on('click', '.delete-it', function() {
                $.post('http://localhost:1111/tweety/core/ajax/deleteTweet.php', {deleteTweet: tweetID}, function(){
                    $('.retweet-popup').hide();
                    location.reload();
                });
            });
        });
    });
    $(document).on('click', '.deleteComment', function(){
        var commentID = $(this).data('comment');
        var tweetID = $(this).data('tweet');

        $.post('http://localhost:1111/tweety/core/ajax/deleteComment.php', {deleteComment: commentID}, function(){
            $.post('http://localhost:1111/tweety/core/ajax/popuptweets.php', {showpopup:tweetID}, function(data) {
                $('.popupTweet').html(data);
                $('.tweet-show-popup-box-cut').click(function(){
                    $('.tweet-show-popup-wrap').hide();
                });
            });
        });
    });
});