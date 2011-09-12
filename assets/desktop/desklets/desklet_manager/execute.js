/**
 * execute.js for the 'desklet_manager' desklet
 * 
 * This desklet manages desklets, so far it only can enable/disable them.
 * protip: It's a bad idea to disable desklet manager unless you plan on going
 * into the database and manage desklets yourself!
 */

$(function(){
    // create a wrapper div for the desklet, as well as a UNIX timestamp-based
    // unique identifier for this instance of the desklet
    
    var date = new Date();
    var dt = date.getTime(); // the -d-esklet -t-imestamp
    
    // create the div and then add it to the desklet identifier
    $('#desklet_holder').append('<div id="desklet-desklet_manager-'+dt+'" class="desklet-desklet_manager desklet-window" title="Desklet Manager"></div>');
    var desklet = $('div#desklet-desklet_manager-'+dt);

    // create a jqueryui dialog window from the desklet's unique div
    $('#desklet-desklet_manager-'+dt).dialog({
        autoOpen: true,
	show: "fade",
        hide: "fade",
        minWidth: 510,
        maxHeight: 800,
        resizable: false,
        close: function(event, ui){
            $(this).remove();
        }
    });
    
    // get the desklet_manager table via AJAX
    $.get('desktop/desklet_load/desklet_manager', {file: 'desklets.php'} , function(data){
        $('#desklet-desklet_manager-'+dt).html(data)
        $('#desklet-desklet_manager-'+dt+' button').button();
        $('#desklet-desklet_manager-'+dt+' button').filter('[id*="desklet_manager"]').button({ disabled: true });
        
        // enable/disable buttons
        $('#desklet-desklet_manager-'+dt+' button').filter('[id^="enable"]').click(function(){
            var current_desklet = $(this).attr('alt');
            $.get('desktop/desklet_load/desklet_manager', { file: 'desklet_status.php', action: 'enable', desklet: current_desklet }, function(data){
                if(data == 'true'){
                    $('<div title="Notice" class="desklet-window">The "'+current_desklet+'" desklet has been enabled and will update when the Desklet Manager is restarted.</div>').dialog();
                }else{
                    $('<div title="Error" class="desklet-window">Error enabling "'+current_desklet+'"</div>').dialog();
                }
            });
        });
        $('#desklet-desklet_manager-'+dt+' button').filter('[id^="disable"]').click(function(){
            var current_desklet = $(this).attr('alt');
            $.get('desktop/desklet_load/desklet_manager', { file: 'desklet_status.php', action: 'disable', desklet: current_desklet }, function(data){
                if(data == 'true'){
                    $('<div title="Notice" class="desklet-window">The "'+current_desklet+'" desklet has been disabled and will update when the Desklet Manager is restarted.</div>').dialog();
                }else{
                    $('<div title="Error" class="desklet-window">Error disabling "'+current_desklet+'"</div>').dialog();
                }
            });
        });
    });
    
});