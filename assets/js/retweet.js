$(function() {
    $(document).on('click', '.retweet', function() {
        $tweetID = $(this).data('tweet');
        $userID  = $(this).data('user');
        $counter = $(this).find('.retweetsCount');
        $count   = $counter.text();
        $button  = $(this);

        $.post('http://localhost:1111/tweety/core/ajax/retweet.php', {showPopup: $tweetID, userID: $userID}, function(data) {
            $('.popupTweet').html(data);
            $('.close-retweet-popup').click(function(){
                $('.retweet.popup').hide();
            });
        });
    });

    $(document).on('click', '.retweet-it', function(){
        var comment = $('.retweetMsg').val();
        $.post('http://localhost:1111/tweety/core/ajax/retweet.php', {retweet: $tweetID, userID: $userID, comment: comment}, function(){
            $('.retweet-popup').hide();
            $count++;
            $counter.text($count);
            $button.removeClass('retweet').addClass('retweeted');
        });
    });
});