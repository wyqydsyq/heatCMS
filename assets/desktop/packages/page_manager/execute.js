/**
 * execute.js for the 'page_manager' package
 * 
 * This package manages heat
 */

$(function(){
	var launcher;
	// get the package config from launcher.json
	$.get('assets/desktop/packages/page_manager/launcher.json', '', function(data){
		launcher = data;
	}, "json"); 
    
    
	// create a wrapper div for the package, as well as a UNIX timestamp-based
	// unique identifier for this instance of the package
    
	var date = new Date();
	var dt = date.getTime(); // the -d-esklet -t-imestamp
    
	// create the div and then add it to the package identifier
	$('#package_holder').append('<div id="package-page_manager-'+dt+'" class="package-page_manager package-window" title="Page Manager"></div>');
	var package = $('div#package-page_manager-'+dt);
    
	// create a jqueryui dialog window from the package's unique div
	$('#package-page_manager-'+dt).dialog({
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
	
	function page_manager(data){
		$('#package-page_manager-'+dt).html(data)
		$('#package-page_manager-'+dt+' button').button();
		$('#package-page_manager-'+dt+' button').filter('[id*="delete-page-home"]').button({
			disabled: true
		});
        
		// edit button, load the external editor with the selected page,
		// this is a pretty good example of a package launching another package.
		$('#package-page_manager-'+dt+' button').filter('[id^="edit"]').click(function(){
			var current_page = $(this).attr('alt');
			// editor ini
			window.editor_ini = {
				page: current_page,
				initiator: dt,
				action: 'edit'
			};
			// load the editor
			$.getScript('assets/desktop/packages/'+launcher.config.editor+'/execute.js', function(){});
		});
        
		// new page button, same as edit except it doesn't have to pass anything to the editor other than action: 'create'
		$('#package-page_manager-'+dt+' button').filter('[id^="new-page"]').click(function(){
			// editor ini
			window.editor_ini = {
				action: 'create',
				initiator: dt
			};
			// load the editor
			$.getScript('assets/desktop/packages/'+launcher.config.editor+'/execute.js', function(){});
		});
        
		// delete button
		$('#package-page_manager-'+dt+' button').filter('[id^="delete"]').click(function(){
			var current_page = $(this).attr('alt');
			$.get('desktop/package_load/page_manager', {
				file: 'delete_page.php', 
				page: current_page
			}, function(data){
				if(data == 'true'){
					$.get('desktop/package_load/page_manager', {
						file: 'get_pages.php'
					} , function(data){
						page_manager(data);
					});
				}else{
					$('<div title="Error" class="package-window">Errors occured delting "'+current_page+', check logs for more information"</div>').dialog();
				}
			});
		});
	}
    
	// get the page_manager table via AJAX
	$.get('desktop/package_load/page_manager', {
		file: 'get_pages.php'
	} , function(data){
		page_manager(data);
	});
    
});