/*
 * run.js file for heat_default theme
 */

// dashboard shortcut
Hotkeys.bind("alt+d", redir, "~base_url/control_panel");

// control_panel context menu
var context_menu = [
        {name: 'Edit', callback: function(e){redir(e.element().parentNode.getElementsByTagName('a')[0].getAttribute('href'))}},
        {name: 'Delete', callback: function(e){redir(e.element().parentNode.getElementsByTagName('a')[0].getAttribute('href').replace('edit','delete'))}}
]
new Proto.Menu({
        selector: '.add_context_menu', // context menu will be shown when element with class name of "contextmenu" is clicked
        className: 'context_menu', // this is a class which will be attached to menu container (used for css styling)
        menuItems: context_menu // array of menu items
})
