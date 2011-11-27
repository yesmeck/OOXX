$(function() {
    $('.vote').click(function() {
        var $this = $(this);
        var url = '/question/vote/';
        var data = {};
        if ($this.hasClass('undo')) {
            if ($this.hasClass('up')) {
                data.type =  'unup';
            } else {
                data.type = 'undown';
            }
        } else {
            if ($this.hasClass('up')) {
                data.type = 'up';
            } else {
                data.type = 'down';
            }
        }
        
        data.qid = $this.attr('data-qid');
        
        $.post(url, data, function(response) {
            if (response.error) {
                alert(response.error);
            } else {
                $this.siblings('.vote-count').html(response.voteCount);
                if ($this.hasClass('undo')) {
                    $this.removeClass('undo');
                } else {
                    $this.siblings('a').removeClass('undo');
                    $this.addClass('undo');
                }
            }
        });
    });
});