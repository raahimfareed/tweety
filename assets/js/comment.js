$(function() {
    $(document).on('click', '#postComment', function() {
        var comment = $('#commentField').val();
        var tweetID = $('#commentField').data('tweet');

        if (comment != "") {
            $.post('http://localhost:1111/tweety/core/ajax/comment.php', {comment: comment, tweetID: tweetID}, function(data) {
                $('#comments').html(data);
                $('#commentField').val("");

            });
        }
    });
});