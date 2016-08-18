$("document").ready(function() {
    $("header .profile").click(function(){
        $("header .profile .profile-dropdown").toggle();
    });
    $(document.body).on('click', function () {
        $("header .profile .profile-dropdown").hide();
    });

    // prevents dropdown from getting closed when clicking on it
    // $("header .profile .profile-dropdown").on('click', function (event) {
    //     event.stopPropagation();
    // });

    $("header .profile").on('click', function (event) {
        event.stopPropagation();
    });
});
