<?php

// get all pages
$pages = $this->Database->get_pages();
// build the package manager
echo '<button id="new-page" alt="Create a new page">New Page</button>';
echo '<table id="page-manager-table">';
echo '<tr><th width="80%">Page</th><th>Edit</th><th>Delete</th></tr>';
echo '<tbody>';
foreach ($pages as $page) {
    echo '<tr id="page-listing-' . $page['id'] . '"><td>' . $page['title'] . '</td><td><button id="edit-page-' . $page['id'] . '" alt="' . $page['id'] . '">Edit</button></td><td><button id="delete-page-' . $page['id'] . '" alt="' . $page['id'] . '">Delete</button></td></tr>';
}
echo '</tbody>';
echo '</table>';
?>
