/**
 * execute.js for the 'page_manager' desklet
 * 
 * This desklet manages heat
 */

$(function(){
    var launcher;
    // get the desklet config from launcher.json
    $.get('assets/desktop/desklets/page_manager/launcher.json', '', function(data){
        launcher = data;
    }, "json"); 
    
    
    // create a wrapper div for the desklet, as well as a UNIX timestamp-based
    // unique identifier for this instance of the desklet
    
    var date = new Date();
    var dt = date.getTime(); // the -d-esklet -t-imestamp
    
    // create the div and then add it to the desklet identifier
    $('#desklet_holder').append('<div id="desklet-page_manager-'+dt+'" class="desklet-page_manager desklet-window" title="Page Manager"></div>');
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
        $('#desklet-page_manager-'+dt+' button').filter('[id*="delete-page-home"]').button({ disabled: true });
        
        // edit button, load the external editor with the selected page,
        // this is a pretty good example of a desklet launching another desklet.
        $('#desklet-page_manager-'+dt+' button').filter('[id^="edit"]').click(function(){
            var current_page = $(this).attr('alt');
            // editor ini
            window.editor_ini = { page: current_page, action: 'edit' };
            // load the editor
            $.getScript('assets/desktop/desklets/'+launcher.config.editor+'/execute.js', function(){});
        });
        
        // new page button, same as edit except it doesn't have to pass anything to the editor other than action: 'create'
        $('#desklet-page_manager-'+dt+' button').filter('[id^="new-page"]').click(function(){
            // editor ini
            window.editor_ini = { action: 'create' };
            // load the editor
            $.getScript('assets/desktop/desklets/'+launcher.config.editor+'/execute.js', function(){});
        });
        
        // delete button
        $('#desklet-page_manager-'+dt+' button').filter('[id^="delete"]').click(function(){
            var current_page = $(this).attr('alt');
            $.get('desktop/desklet_load/page_manager', { file: 'delete_page.php', page: current_page }, function(data){
                if(data == 'true'){
                    $('<div title="Notice" class="desklet-window">The page "'+current_page+'" has been deleted.</div>').dialog();
                }else{
                    $('<div title="Error" class="desklet-window">Errors occured delting "'+current_page+', check logs for more information"</div>').dialog();
                }
            });
        });
        
    });
    
});