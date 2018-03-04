$(function() {
    $('.iblock-vote .rating-enabled span').hover(function() {

        var self = $(this),
            all = self.siblings('span').add(self);

        all.each(function() {
            var it = $(this);
            it.data('state', it.attr('class'));
        });

        all.toggleClass('glyphicon glyphicon-star fa fa-star', false).toggleClass('glyphicon glyphicon-star-empty fa fa-star-o', true);
        self.prevAll('span').add(self).toggleClass('glyphicon glyphicon-star fa fa-star', true);

    }, function() {

        var self = $(this),
            all = self.siblings('span').add(self);

        all.toggleClass('glyphicon glyphicon-star fa fa-star', false).toggleClass('glyphicon glyphicon-star-empty fa fa-star-o', true);

        all.each(function() {
            var it = $(this);
            it.attr('class', it.data('state'));
        });

    }).click(function() {
        var self = $(this),
            id = parseInt( self.data('id') ),
            val = self.data('rating');

        if (id === 0 || typeof val === 'undefined')
            return;

        var params = $('#vote-params-' + id);
        if (params.length === 0) {
            return;
        } else {
            params = $.parseJSON( params.val().replace(/'/g, '"') );
            params.AJAX_CALL = 'Y';
            params.vote = 'Y';
            params.vote_id = id;
            params.rating = val;
        }

        $.post('/bitrix/components/bitrix/iblock.vote/component.php', params,
            function( response ) {
                var data = $.parseJSON(response);

                var vote = $('#vote-' + data.id);

                if (vote.length === 0)
                    return;

                vote.find('span').unbind('mouseenter').unbind('mouseleave').each(function(index) {
                    var it = $(this);

                    if (index <= data.value) {
                        it.toggleClass('glyphicon glyphicon-star-empty fa fa-star-o', false).toggleClass('glyphicon glyphicon-star fa fa-star', true);
                    } else {
                        it.toggleClass('glyphicon glyphicon-star fa fa-star', false).toggleClass('glyphicon glyphicon-star-empty fa fa-star-o', true);
                    }
                    it.data('state', it.attr('class'));
                });

                vote.find('.rating-enabled').toggleClass('rating-enabled', false);
            }
        );
    });
});

