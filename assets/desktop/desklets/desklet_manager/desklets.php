<?php

// get all the enabled desklets
$enabled = $this->Database->get_enabled_desklets();

// get all the installed desklets
$desklets = $this->Heat->get_installed_desklets();

// build the desklet manager
echo '<table id="desklet-manager-table">';
echo '<tr><th>Desklet</th><th>Status</th><th>Enable/Disable</th></tr>';
echo '<tbody>';
foreach ($desklets as $desklet) {
    if (array_key_exists($desklet['name'], $enabled) === false) {
        $desklet['status'] = 'Disabled';
        $toggle_button = 'Enable';
        $toggle_action = 'enable';
    } else {
        $desklet['status'] = 'Enabled';
        $toggle_button = 'Disable';
        $toggle_action = 'disable';
    }
    echo '<tr id="desklet-listing-' . $desklet['name'] . '"><td>' . $desklet['title'] . '</td><td>' . $desklet['status'] . '</td><td><button id="' . $toggle_action . '-desklet-' . $desklet['name'] . '" alt="' . $desklet['name'] . '">' . $toggle_button . '</button></td></tr>';
}
echo '</tbody>';
echo '</table>';
?>
