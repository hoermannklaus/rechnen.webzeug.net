$(function() {

    /**
     * On click on the print button, show the print dialog
     */
    $("#print").click(function(e) {
        e.preventDefault();
        window.print();
    });

    /**
     * Reload the current page
     */
    $("#reload").click(function(e) {
        e.preventDefault();
        location.reload();
    });
});