$('.vote-up-btn').on('click', function () {
    var _this = $(this);
    var counter = $(this).find('.voted-up-count');
    var btn = $(this).find('.btn.vote-up');

    var subVote = $(this).parent().find('.vote-down-btn');
    var subCounter = $(subVote).find('.voted-down-count');
    var subBtn =$(subVote).find('.btn.vote-down');

    $.ajax({
        url: '?r=answer/vote',
        dataType: 'json',
        data: {
            position: 1,
            answer_id: $(this).data('id')
        }
    }).done(function (res) {
        if (typeof res.code != 'undefined') {
            if (res.code == 200) {
                if (res.position == 0) {
                    $(btn).removeClass('active');
                    $(counter).text(($(counter).text() * 1) - 1);
                }
                if (res.position == 1) {
                    $(btn).addClass('active');
                    $(subBtn).removeClass('active');
                    $(subCounter).text(($(subCounter).text() * 1) - 1);
                    $(counter).text(($(counter).text() * 1) + 1);
                }
                if (res.position == 2) {
                    $(btn).addClass('active');
                    $(counter).text(($(counter).text() * 1) + 1);
                }

            }
        }
    });

});
$('.vote-down-btn').on('click', function () {
    var _this = $(this);
    var counter = $(this).find('.voted-down-count');
    var btn = $(this).find('.btn.vote-down');

    var subVote = $(this).parent().find('.vote-up-btn');
    var subCounter = $(subVote).find('.voted-up-count');
    var subBtn =$(subVote).find('.btn.vote-up');


    $.ajax({
        url: '?r=answer/vote',
        dataType: 'json',
        data: {
            position: 2,
            answer_id: $(this).data('id')
        }
    }).done(function (res) {
        if (typeof res.code != 'undefined') {
            if (res.code == 200) {
                if (res.position == 0) {
                    $(btn).removeClass('active');
                    $(counter).text(($(counter).text() * 1) - 1);
                }
                if (res.position == 1) {
                    $(btn).addClass('active');
                    $(subBtn).removeClass('active');
                    $(subCounter).text(($(subCounter).text() * 1) - 1);
                    $(counter).text(($(counter).text() * 1) + 1);
                }
                if (res.position == 2) {
                    $(btn).addClass('active');
                    $(counter).text(($(counter).text() * 1) + 1);
                }

            }
        }
    });
});