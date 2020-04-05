$(function(){
    $(document).on('click', '.like-btn', function(){
        var tweetID = $(this).data('tweet');
        var userID = $(this).data('user');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost:1111/tweety/core/ajax/like.php', {
            like:tweetID,
            userID:userID
        }, function(){
            counter.show();
            button.addClass('unlike-btn');
            button.removeClass('like-btn');
            count++;
            counter.text(count);
            button.find('.fa-heart-o').addClass('fa-heart');
            button.find('.fa-heart').removeClass('fa-heart-o');
        });
    });
    $(document).on('click', '.unlike-btn', function(){
        var tweetID = $(this).data('tweet');
        var userID = $(this).data('user');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost:1111/tweety/core/ajax/like.php', {
            unlike:tweetID,
            userID:userID
        }, function(){
            counter.show();
            button.addClass('like-btn');
            button.removeClass('unlike-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            button.find('.fa-heart').addClass('fa-heart-o');
            button.find('.fa-heart-o').removeClass('fa-heart');
        });
    });
});