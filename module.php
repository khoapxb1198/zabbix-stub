<?php

// Include necessary Zabbix files
require_once dirname(__FILE__) . '/../../../include/headers.inc.php';
require_once dirname(__FILE__) . '/../../../include/config.inc.php';
require_once dirname(__FILE__) . '/../../../include/db.inc.php';
require_once dirname(__FILE__) . '/../../../include/forms.inc.php';

// Register the custom module in Zabbix
$module = new CAdminModule();
$module->register(
    'mycustommodule',  // Module name
    'My Custom Module',  // Display name in Zabbix
    'module.php',  // PHP script file for the module
    '1.0',  // Module version
    'MyCustomModuleController'  // Optional: Controller class if needed for additional logic
);

// Adding a custom menu item to the Zabbix menu
$menu = new CAdminMenu();
$menu->addSubmenu('My Custom Module', 'mycustommodule.view.php'); // Link to the view page of your custom module

// Make sure the menu is accessible only by authorized users
$menu->setVisibleForUsers(array(USER_TYPE_ADMIN, USER_TYPE_SUPER_ADMIN));

// Display a success message or an error
if ($_REQUEST['action'] == 'install') {
    echo 'Module installed successfully!';
} else {
    echo 'Welcome to My Custom Module!';
}

// You can add more functions if you want more interactivity with the module
