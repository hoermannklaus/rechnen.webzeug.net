$(function() {

    /**
     * On click on the print button, show the print dialog
     */
    $("#print").click(function(e) {
        e.preventDefault();
        window.print();
    });

    /**
     * On click on the reload button, check if there are already some calculations
     * filled out. If so, ask the user if he still wants to regenerate. Otherwise
     * do not ask, and regenerate.
     */
    $("#reload").click(function(e) {
        var ask = false;
        $(".calculation input").each(function() {
            if ($(this).val() != '') {
                ask = true;
                return false;
            }
        })
        if (ask) {
            $.confirm({
                title: langConfirm1,
                content: langConfirm2,
                buttons: {
                    Ja: function() {
                        location.reload();
                    },
                    Nein: function() {
                        console.log("Abbruch");
                    }
                }
            });
        } else {
            location.reload();
        }
    });

    /**
     * Change the progress bar on every change of a input.
     */
    $(".input-result").change(function() {
        var total = $(".input-result").length;
        var filled = 0;
       $(".input-result").each(function(index, item) {
            if ($(item).val() != '') {
                filled++;
            } 
       });
       var percentage = Math.round((100 / total) * filled);
       $("#progressbar")
        .data("valuenow", percentage)
        .attr("aria-valuenow", percentage)
        .text(percentage + "% ausgefüllt")
        .css("width", percentage + "%");
    });

    /**
     * Solve the calculations.
     */
    $(".check").click(function(e) {
        e.preventDefault();
        var correct = 0;
        var incorrect = 0;
        $(".calculation").each(function() {
            if ($(this).find("input").val() == $(this).find("input").data("result")) {
                $(this).find(".fa-check").show();
                $(this).find(".fa-times").hide();
                if ($("#showResult").is(":checked")) {
                    $(this).find("span.result").hide();
                }
                correct++;
            } else {
                $(this).find(".fa-times").show();
                $(this).find(".fa-check").hide();
                if ($("#showResult").is(":checked")) {
                    $(this).find("span.result").show();
                }
                incorrect++;
            }
        });
        $("#resultSummary").text(
            sprintf(langSummary, correct, incorrect)
        );
    });
});