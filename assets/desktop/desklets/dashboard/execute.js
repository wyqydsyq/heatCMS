/**
 * execute.js for the 'dashboard' desklet
 * 
 * A basic desklet that retrieves statistics from the database and displays them
 * to the user, it's a fairly simple desklet that shows some of the capibilities
 * of interacting with the heatCMS database from a desklet.
 */

$(function(){
    // create a wrapper div for the desklet, as well as a UNIX timestamp-based
    // unique identifier for this instance of the desklet
    
    var date = new Date();
    var dt = date.getTime(); // the -d-esklet -t-imestamp
    
    // create the div and then add it to the desklet identifier
    $('#desklet_holder').append('<div id="desklet-dashboard-'+dt+'" class="desklet-dashboard desklet-window" title="Dashboard"></div>');
    var desklet = $('div#desklet-dashboard-'+dt);

    // create a jqueryui dialog window from the desklet's unique div
    $('#desklet-dashboard-'+dt).dialog({
        autoOpen: true,
	show: "fade",
        hide: "fade",
        close: function(event, ui){
            $(this).remove();
        }
    });
    
    // get the dashboard statistics via AJAX
    $.get('desktop/desklet_load/dashboard', { file: 'dashboard.php' } , function(data){
        $('#desklet-dashboard-'+dt).html(data)
    });
    
});