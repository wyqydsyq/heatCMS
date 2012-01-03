<?php

// get all the enabled packages
$enabled = $this->Database->get_enabled_packages();

// get all the installed packages
$packages = $this->Heat->get_installed_packages();

// build the package manager
echo '<table id="package-manager-table">';
echo '<tr><th>Package</th><th>Status</th><th>Enable/Disable</th></tr>';
echo '<tbody>';
foreach ($packages as $package) {
    if (array_key_exists($package['name'], $enabled) === false) {
        $package['status'] = 'Disabled';
        $toggle_button = 'Enable';
        $toggle_action = 'enable';
    } else {
        $package['status'] = 'Enabled';
        $toggle_button = 'Disable';
        $toggle_action = 'disable';
    }
    echo '<tr id="package-listing-' . $package['name'] . '"><td>' . $package['title'] . '</td><td>' . $package['status'] . '</td><td><button id="' . $toggle_action . '-package-' . $package['name'] . '" alt="' . $package['name'] . '">' . $toggle_button . '</button></td></tr>';
}
echo '</tbody>';
echo '</table>';
?>
