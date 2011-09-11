$(function(){
    // the do menu
    $("#do_button").click(function(){
        $('#do_button').toggleClass('clicked');
        $('#do_menu').toggleClass('show');
        
        // load the menu
        if($('#do_menu').hasClass('show')){
            $.get("desktop/do_menu", function(data){
                $('#do_menu').html(data);
                
                // do menu launchers
                $("#do_menu a").click(function(event){
                    event.preventDefault();
                    $.getScript("assets/desktop/desklets/"+$(this).attr('alt')+"/execute.js");
                });
            });
        }
    });

});