$(function(){

    $(document).ready(function(){
        $(".form-control").each(function(){
            $(this).attr("autocomplete", "off");
        });

        $("table").addClass("text-center");
        $("thead").addClass("thead-dark");

        $(".tipo").each(function(){
            if($(this).html() == 0)
            {
                $(this).html("DEPÓSITO").parent().addClass("text-success"); 
            }
            else
            {
                $(this).html("SAQUE").parent().addClass("text-danger");
            }
        });

        // $("table").on("select", function(e){
        //     e.preventDefault();
        // });
    })

})