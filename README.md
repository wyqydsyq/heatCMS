# heatCMS #

## About
heatCMS is an entirely open-source/public domain CMS based on the CodeIgniter PHP framework.

Installing is as simple as copying the files to your server and filling in a single initial setup form, no database creation is required from the user.

For its front-end, it uses an easy-to-use theming system, the entire visual aspect of a website can be defined from the current
theme, themes can use any CSS, JavaScript or PHP.

The back-end control panel is different from the generic control panel that you see on most CMS's,
It's called the Desktop, and like the name implies, it works just like a desktop interface that you would use
on a home computer. Where you would have pages in the control panel in a normal CMS, you have packages on the heatCMS desktop.
Packages are JavaScript applications that run in the desktop environment as an application would on your computer's desktop.
Through using AJAX they can interact with and modify the heatCMS database or other server-side functions.

## Requirements

### Server
* Server must have PHP 5.2/5.3 or newer installed
* Server must have apache mod_rewrite installed/enabled
* Server must have sqlite 3 or newer installed/enabled (is enabled by default with a standard PHP 5+ installation)

### Browser
* The front-end of the website's requirements are whatever is needed for the selected theme
* The Desktop requires a modern browser with CSS3 and SVG support to work as intended, Firefox 5+ and Chromium/Chrome 13+ have been tested. Webkit based browsers should all work without issue. Internet Explorer is NOT currently supported, desktop will appear distorted when attempting to use internet explorer due to its lack of CSS 3 and SVG support (it's a matter of IE lacking capabilities of modern, standards compliant browsers, not a lack of support for IE).

## Changelog

### 0.5
* page_manager and editor packages implemented with basic functionality (add, edit and delete pages) CMS is now in a usable state.

### 0.2
* Created package_manager package
* Refined desktop UI
* Fixed a bug with logging in when there are multiple users in the database
* Fixed a bug where setup could not create a database due to permission files
* Fixed a bug where setup tried to load the default language from /language/$default_language/$default_language instead of /language/$default_language