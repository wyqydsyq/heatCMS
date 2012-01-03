/**
 * execute.js for the 'dashboard' package
 * 
 * A basic package that retrieves statistics from the database and displays them
 * to the user, it's a fairly simple package that shows some of the capibilities
 * of interacting with the heatCMS database from a package.
 */

$(function(){
    // create a wrapper div for the package, as well as a UNIX timestamp-based
    // unique identifier for this instance of the package
    
    var date = new Date();
    var dt = date.getTime(); // the -d-esklet -t-imestamp
    
    // create the div and then add it to the package identifier
    $('#package_holder').append('<div id="package-dashboard-'+dt+'" class="package-dashboard package-window" title="Dashboard"></div>');
    var package = $('div#package-dashboard-'+dt);

    // create a jqueryui dialog window from the package's unique div
    $('#package-dashboard-'+dt).dialog({
        autoOpen: true,
	show: "fade",
        hide: "fade",
        close: function(event, ui){
            $(this).remove();
        }
    });
    
    // get the dashboard statistics via AJAX
    $.get('desktop/package_load/dashboard', { file: 'dashboard.php' } , function(data){
        $('#package-dashboard-'+dt).html(data)
    });
    
});