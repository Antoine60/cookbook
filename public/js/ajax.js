$(function () {

    var offset = 1;
    var search = '';
    var country = '';
    var repas = '';

    switch (window.location.pathname) {
        case '/recettes':
            customUrl = '/ajax?q=currentUser';
            break;
        case '/top':
            customUrl = '/ajax?q=top';
            break;
        case '/':
            customUrl = '/ajax?q=last';
            break;
    }
    $.ajax({
        url: customUrl
    })
        .done(function (data) {
            $('.content-ajax').append(data);
            $('.loader-spinner').fadeOut(400);
        });

    function debounce(callback, delay) {
        var timer;
        return function () {
            var args = arguments;
            var context = this;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, delay)
        }
    };

    $("#country").change(function () {
        country = $("#country").val();
        $.ajax({
            url: customUrl + '&s=' + search + '&c=' + country + '&r=' + repas,
            success: function (data) {
                var offset = 1;
                $('.content-ajax').html(data);
            },
            error: function (resultat, statut, erreur) {
                $('.content-ajax').html('No results');
            }
        });
    });

    $("#repas").change(function () {
        repas = $("#repas").val();
        $.ajax({
            url: customUrl + '&s=' + search + '&c=' + country + '&r=' + repas,
            success: function (data) {
                var offset = 1;
                $('.content-ajax').html(data);
            },
            error: function (resultat, statut, erreur) {
                $('.content-ajax').html('No results');
            }
        });
    });

    $("#search").bind("keyup focus", debounce(function () {
        search = $("#search").val();
        $.ajax({
            url: customUrl + '&s=' + search + '&c=' + country + '&r=' + repas,
            success: function (data) {
                var offset = 1;
                $('.content-ajax').html(data);
            },
            error: function (resultat, statut, erreur) {
                $('.content-ajax').html('No results');
            }
        });
    }, 500));

    infiniteScroll();

    function infiniteScroll() {

        // on initialise ajaxready à true au premier chargement de la fonction
        $(window).data('ajaxready', true);
        var deviceAgent = navigator.userAgent.toLowerCase();
        var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);

        $(window).scroll(function () {
            // On teste si ajaxready vaut false, auquel cas on stoppe la fonction
            if ($(window).data('ajaxready') == false) return;

            if (($(window).scrollTop() + $(window).height()) == $(document).height()
                || agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height()) {
                $(window).data('ajaxready', false);
                $('.loader-spinner').fadeIn(400);
                $.ajax({
                    url: customUrl + '&page=' + ++offset
                })
                    .done(function (data) {
                        $(window).data('ajaxready', true);
                        $('.content-ajax').append(data);
                        $('.loader-spinner').fadeOut(400);
                    })
                    .fail(function (data) {
                        $('.content-ajax').append('<p>No more results found</p>');
                        $('.loader-spinner').fadeOut(400);
                    });
            }
        });
    };
});