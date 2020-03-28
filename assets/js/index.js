$(function(){

    $('.delete-localStorage').tooltip();

    /**
     * On change of an input read the values and write it to the localStorage.
     */
    $("form input").change(function(e) {
        localStorage.setItem($(this).attr("name"), $(this).val());
        $(this).closest("form").find(".card-footer").show();
    });

    /**
     * Try to prefill the inputs with values from the localStorage
     */
    $("form input").each(function(key, elem) {
        if (localStorage.hasOwnProperty($(this).attr("name"))) {
            $(this).val(localStorage.getItem($(this).attr("name")));
            $(this).closest("form").find(".card-footer").show();
        }
    });
    
    /**
     * Reset values and localStorage
     */
    $(".delete-localStorage").click(function(e) {
        e.preventDefault();
        $(this).closest("form").find("input").each(function(key, elem) {
            localStorage.removeItem(elem.name);
        });
        $(this).closest("form").find(".card-footer").hide();
        $(this).closest("form").trigger("reset");
    });
});