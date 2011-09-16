/**
 * execute.js for the 'editor' desklet
 * 
 * This is the default heatCMS wysiwyg editor, it simply loads the requested page
 * in a form inside a jqueryui dialog box, and handles saving it.
 */

$(function(){
    var page = editor_ini.page;
    var action = editor_ini.action;
    
    // create a wrapper div for the desklet, as well as a UNIX timestamp-based
    // unique identifier for this instance of the desklet
    
    var date = new Date();
    var dt = date.getTime(); // the -d-esklet -t-imestamp
    
    // create the div and then add it to the desklet identifier
    $('#desklet_holder').append('<div id="desklet-editor-'+dt+'" class="desklet-editor desklet-window" title="Editor"></div>');
    var desklet = $('#desklet-editor-'+dt);
    
    // create a jqueryui dialog window from the desklet's unique div
    desklet.dialog({
        autoOpen: true,
	show: "fade",
        hide: "fade",
        close: function(event, ui){
            $(this).remove();
        }
    });
    
    switch(action){
        case 'edit':
            // get the page we're editing via AJAX
            $.get('desktop/desklet_load/editor', {file: 'load_page.php', target_page: page} , function(data){
                
                // set the desklet title
                desklet.siblings('.ui-dialog-titlebar').children('.ui-dialog-title').html(data.title+' - Editor');
                
                // append the edit form
                desklet.append('<form id="edit-'+page+'-form"><fieldset><input type="text" name="edit-'+page+'-name" id="edit-'+page+'-name" value="'+data.title+'" /><textarea class="wysiwyg" name="edit-'+page+'-content" id="edit-'+page+'-content">'+data.content+'</textarea><button type="submit">Save</button></fieldset></form>');
                
                // convert wysiywg box
                $('#desklet-editor-'+dt+' .wysiwyg').wysiwyg();
                
                // page save functionality
                $('form#edit-'+page+'-form').submit(function(event){
                    event.preventDefault();
                    var values;
                    values.title = $('form#edit-'+page+'-form').filter('[name')
                    
                    $.get('desktop/desklet_load/editor', {file: 'save_page.php', target_page: page})
                });
            }, 'json');
        break;
        
        case 'create':
            // @todo: do the page create function
        break;
        
        default:
            alert('Error: the heatCMS editor wasn\'t told whether it\'s supposed to be editing an existing or creating a new page!');
        break;
    }
    
});