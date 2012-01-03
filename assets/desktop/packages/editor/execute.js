/**
* execute.js for the 'editor' package
* 
* This is the default heatCMS wysiwyg editor, it simply loads the requested page
* in a form inside a jqueryui dialog box, and handles saving it.
*/

$(function(){
	var page = editor_ini.page;
	var action = editor_ini.action;
	var initiator = editor_ini.initiator;

	// create a wrapper div for the package, as well as a UNIX timestamp-based
	// unique identifier for this instance of the package

	var date = new Date();
	var dt = date.getTime(); // the -d-esklet -t-imestamp

	// create the div and then add it to the package identifier
	$('#package_holder').append('<div id="package-editor-'+dt+'" class="package-editor package-window" title="Editor"></div>');
	var package = $('#package-editor-'+dt);

	// create a jqueryui dialog window from the package's unique div
	package.dialog({
		autoOpen: true,
		show: "fade",
		hide: "fade",
		autoSave: true,
		resizable: false,
		width: "800",
		close: function(event, ui){
			$(this).remove();
		}
	});

	switch(action){
		case 'create':
			package.html('<h2>Creating new page...</h2>');
			$.get('desktop/package_load/editor', {
				file: 'new_page.php'
			});
			package.dialog('close');
			// reload page manager to show the new page
			$('#package-page_manager-'+initiator).dialog('close');
			$.getScript("assets/desktop/packages/page_manager/execute.js");
			break;

		case 'edit':
			package.dialog({
				height: "450"
			});
			// get the page we're editing via AJAX
			$.get('desktop/package_load/editor', {
				file: 'load_page.php', 
				target_page: page
			} , function(data){

				// set the package title
				package.siblings('.ui-dialog-titlebar').children('.ui-dialog-title').html(data.title+' - Editor');

				// append the edit form
				package.append('<form id="edit-'+page+'-form"><fieldset><input type="text" name="title" id="edit-'+page+'-title" value="'+data.title+'" /><textarea class="wysiwyg" name="content" id="edit-'+page+'-content">'+data.content+'</textarea><button type="submit">Save</button></fieldset></form>');

				// convert wysiywg box
				$('#package-editor-'+dt+' .wysiwyg').wysiwyg({
					css: 'assets/themes/'+data.theme+'/css/print.css'
				});

				// page save functionality
				$('form#edit-'+page+'-form').submit(function(event){
					event.preventDefault();
					var p_title = $(this).find('[name="title"]').val();
					$.post('desktop/package_load/editor', {
						file: 'save_page.php', 
						target_page: page,
						values: {
							title: $(this).find('[name="title"]').val(),
							content: $(this).find('[name="content"]').val()
						}
					}, function(data){
						if(data == true){
							$('<div title="Notice" class="package-window">Changes to "'+p_title+'" have been saved successfully.</div>').dialog();
							$.get('desktop/package_load/page_manager', {
								file: 'get_pages.php'
							} , function(data){
								page_manager(data);
							});
						}else{
							$('<div title="Error" class="package-window">Errors occured saving changes to "'+p_title+'</div>').dialog();
						}
					});
				});
			}, 'json');
			break;

		default:
			alert('Error: the heatCMS editor wasn\'t told whether it\'s supposed to be editing an existing or creating a new page!');
			break;
	}

});