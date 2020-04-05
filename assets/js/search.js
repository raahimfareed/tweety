$(function() {
    $('.search').keyup(function() {
        var search = $(this).val();
        $.post('http://localhost:1111/tweety/core/ajax/search.php', {search:search}, function(data) {
            $('.search-result').html(data);
            
        });
    });
});