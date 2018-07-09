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

        $('.table').addClass("table-sm")

        $('.btn').addClass("btn-sm");

        // $("table").on("select", function(e){
        //     e.preventDefault();
        // });

        $("#seletor").on("change", function(){
            
            if($(this).val() == "1")
            {
                $("#btn-ts").removeAttr("value").attr("value", "FAZER SAQUE").removeClass("btn-success").addClass("btn-warning");
            }
            else
            {
                $("#btn-ts").removeAttr("value").attr("value", "FAZER DEPÓSITO").removeClass("btn-warning").addClass("btn-success");
            }
        });

        
    })

})