/**
 * execute.js for the 'page_manager' desklet
 * 
 * This desklet manages heat
 */

$(function(){
    // get the desklet config from launcher.json
    $.get('assets/desktop/desklets/page_manager/launcher.json', '', function(data){
        console.log('data: '+data.config.editor);
        launcher = data;
    }, "json");
    console.log('launcher: '+launcher.config.editor);
    
    // create a wrapper div for the desklet, as well as a UNIX timestamp-based
    // unique identifier for this instance of the desklet
    
    var date = new Date();
    var dt = date.getTime(); // the -d-esklet -t-imestamp
    
    // create the div and then add it to the desklet identifier
    $('#desklet_holder').append('<div id="desklet-page_manager-'+dt+'" class="desklet-page_manager desklet-window" title="Desklet Manager"></div>');
    var desklet = $('div#desklet-page_manager-'+dt);

    // create a jqueryui dialog window from the desklet's unique div
    $('#desklet-page_manager-'+dt).dialog({
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
    
    // get the page_manager table via AJAX
    $.get('desktop/desklet_load/page_manager', {file: 'get_pages.php'} , function(data){
        $('#desklet-page_manager-'+dt).html(data)
        $('#desklet-page_manager-'+dt+' button').button();
        $('#desklet-page_manager-'+dt+' button').filter('[id*="delete-page_manager"]').button({ disabled: true });
        
        // edit button
        
    });
    
});