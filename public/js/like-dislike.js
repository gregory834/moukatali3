$(document).ready(function () {

    // si l'utilisateur clique sur le bouton J'aime ...
    $('.like-btn').on('click', function () {

        var moukatage_id = $(this).data('id');
        $clicked_btn = $(this);

        if ($clicked_btn.hasClass('far')) {
            action = 'like';
        } else if ($clicked_btn.hasClass('fas')) {
            action = 'unlike';
        }

        $.ajax({
            url: 'moukatages.php',
            type: 'post',
            data: {
                'action': action,
                'moukatage_id': moukatage_id
            },
            success: function (rating) {
                res = JSON.parse(rating);
                console.log(res.likes);
                if (action == "like") {
                    $clicked_btn.removeClass('far');
                    $clicked_btn.addClass('fas');
                } else if (action == "unlike") {
                    $clicked_btn.removeClass('fas');
                    $clicked_btn.addClass('far');
                }
                // afficher le nombre de j'aime et n'aime pas
                $clicked_btn.siblings('div.likes').text(res.likes);
                $clicked_btn.siblings('div.dislikes').text(res.dislikes);

                // modifier le style du bouton de l'autre bouton si l'utilisateur réagit la deuxième fois pour publier
                $clicked_btn.siblings('i.fas').removeClass('fas').addClass('far');
            }
        });

    });

    // si l'utilisateur clique sur le bouton Je n'aime pas ...
    $('.dislike-btn').on('click', function () {
        var moukatage_id = $(this).data('id');
        $clicked_btn = $(this);
        if ($clicked_btn.hasClass('far')) {
            action = 'dislike';
        } else if ($clicked_btn.hasClass('fas')) {
            action = 'undislike';
        }
        $.ajax({
            url: 'moukatages.php',
            type: 'post',
            data: {
                action: action,
                moukatage_id: moukatage_id
            },
            success: function (rating) {
                res = JSON.parse(rating);
                console.log(res.dislikes);
                if (action == "dislike") {
                    $clicked_btn.removeClass('far');
                    $clicked_btn.addClass('fas');
                } else if (action == "undislike") {
                    $clicked_btn.removeClass('fas');
                    $clicked_btn.addClass('far');
                }
                // afficher le nombre de j'aime et n'aime pas
                $clicked_btn.siblings('div.likes').text(res.likes);
                $clicked_btn.siblings('div.dislikes').text(res.dislikes);

                // modifier le style du bouton de l'autre bouton si l'utilisateur réagit la deuxième fois pour publier
                $clicked_btn.siblings('i.fas').removeClass('fas').addClass('far');
            }
        });

    });

});
