$(function() {
    if ($('a[data-tweet-action]').length > 0) {
        $('a[data-tweet-action]').click(function(e) {
            e.preventDefault();
            var _this = this;
            var action = $(this).data('tweet-action');
            var id = $(this).data('tweet-id');
            $.ajax({
                method: 'GET',
                url: AppGlobals.userTweet,
                dataType: 'json',
                data: {
                    action,
                    id,
                },
                success: function(res) {
                    if (res.status === 'success') {
                        var newAction = 'show';
                        var newText = 'Show this tweet';
                        if (action === 'show') {
                            newAction = 'hide';
                            newText = 'Hide this tweet';
                        }
                        $(_this).data('tweet-action', newAction);
                        $(_this).text(newText);
                    }
                }
            });
        });
    }
});
