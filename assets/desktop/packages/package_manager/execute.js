/**
 * execute.js for the 'package_manager' package
 * 
 * This package manages packages, so far it only can enable/disable them.
 * protip: It's a bad idea to disable package manager unless you plan on going
 * into the database and manage packages yourself!
 */

$(function(){
	// create a wrapper div for the package, as well as a UNIX timestamp-based
	// unique identifier for this instance of the package
    
	var date = new Date();
	var dt = date.getTime(); // the -d-esklet -t-imestamp
    
	// create the div and then add it to the package identifier
	$('#package_holder').append('<div id="package-package_manager-'+dt+'" class="package-package_manager package-window" title="Package Manager"></div>');
	var package = $('div#package-package_manager-'+dt);

	// create a jqueryui dialog window from the package's unique div
	$('#package-package_manager-'+dt).dialog({
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
    
	function package_manager(data){
		$('#package-package_manager-'+dt).html(data);
		$('#package-package_manager-'+dt+' button').button();
		$('#package-package_manager-'+dt+' button').filter('[id*="package_manager"]').button({
			disabled: true
		});
        
		// enable/disable buttons
		$('#package-package_manager-'+dt+' button').filter('[id^="enable"]').click(function(){
			var current_package = $(this).attr('alt');
			$.get('desktop/package_load/package_manager', {
				file: 'package_status.php', 
				action: 'enable', 
				package: current_package
			}, function(data){
				if(data == 'true'){
					$.get('desktop/package_load/package_manager', {
						file: 'packages.php'
					}, function(data){
						package_manager(data);
					});
				//$('<div title="Notice" class="package-window">The "'+current_package+'" package has been enabled and will update when the Package Manager is restarted.</div>').dialog();
				}else{
					$('<div title="Error" class="package-window">Error enabling "'+current_package+'"</div>').dialog();
				}
			});
		});
		$('#package-package_manager-'+dt+' button').filter('[id^="disable"]').click(function(){
			var current_package = $(this).attr('alt');
			$.get('desktop/package_load/package_manager', {
				file: 'package_status.php', 
				action: 'disable', 
				package: current_package
			}, function(data){
				if(data == 'true'){
					$.get('desktop/package_load/package_manager', {
						file: 'packages.php'
					}, function(data){
						package_manager(data);
					});
				//$('<div title="Notice" class="package-window">The "'+current_package+'" package has been disabled and will update when the Package Manager is restarted.</div>').dialog();
				}else{
					$('<div title="Error" class="package-window">Error disabling "'+current_package+'"</div>').dialog();
				}
			});
		});
	}
	
	// get the package_manager table via AJAX
	$.get('desktop/package_load/package_manager', {
		file: 'packages.php'
	} , function(data){
		package_manager(data);
	});
    
});