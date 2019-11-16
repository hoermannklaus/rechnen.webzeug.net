$(function(){

    $('.delete-cookie').tooltip();

    /**
     * PREFILL FROM COOKIE
     * 
     * Get all forms on this page.
     * Go through all of them, and see if they have a data attribute "cookiename".
     * If so, read the cookie value, and set the appropriate fields in the according
     * predefined form are filled with the ones from the cookie.
     */
    var forms = $("form");
    $.each(forms, function(key, form) {
        var cookieName = $(form).data("cookiename");
        if (cookieName) {
            var cookieValue = Cookies.get(cookieName);
            if (cookieValue) {
                var form = $("form." + cookieName);
                $.each(JSON.parse(cookieValue), function(key, setting) {
                    $(form).find("#" + setting.key).val(setting.value);
                });
                $("." + cookieName + " .card-footer").show();
            }
        }
    });

    /**
     * ON CHANGE READ VALUES AND WRITE COOKIE
     * 
     * On change of any input element in a form
     * - Get all input elements of type "integer" on the parent form element of the changed element
     */
    $("form input").change(function() {
        var form = $(this).closest("form");
        var cookieName = $(form).data("cookiename");
        var fields = form.find("input[type=number");
        var settings = new Array();
        $.each(fields, function(key, elem) {
            var entry = {};
            entry.key = $(elem).attr("name");
            entry.value = $(elem).val();
            settings.push(entry);
        });
        var cookieValue = JSON.stringify(settings);
        Cookies.set(cookieName, cookieValue);
        $("." + cookieName + " .card-footer").show();
    });

    /**
     * DELETE COOKIE AND RESET VALUES
     * 
     * On click on a "delete-cookie" link the closes forms is being searched.
     * This form holds a data attribute with the cookie name. 
     * Then the according cookie for this "delete-cookie" button is deleted.
     * Also the "card-footer" of the current card is hidden. There the "delete-cookie"
     * link is placed. It gets hidden, when no cookie is given.
     */
    $(".delete-cookie").click(function(e) {
        e.preventDefault();
        var form = $(this).closest("form");
        var cookieName = $(form).data("cookiename");
        Cookies.remove(cookieName);
        $("." + cookieName + " .card-footer").hide();
        $(form).trigger("reset");
    });
});