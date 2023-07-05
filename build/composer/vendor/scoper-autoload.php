<?php

// scoper-autoload.php @generated by PhpScoper

// Backup the autoloaded Composer files
if (isset($GLOBALS['__composer_autoload_files'])) {
    $existingComposerAutoloadFiles = $GLOBALS['__composer_autoload_files'];
}

$loader = require_once __DIR__.'/autoload.php';
// Ensure InstalledVersions is available
$installedVersionsPath = __DIR__.'/composer/InstalledVersions.php';
if (file_exists($installedVersionsPath)) require_once $installedVersionsPath;

// Restore the backup
if (isset($existingComposerAutoloadFiles)) {
    $GLOBALS['__composer_autoload_files'] = $existingComposerAutoloadFiles;
} else {
    unset($GLOBALS['__composer_autoload_files']);
}

// Class aliases. For more information see:
// https://github.com/humbug/php-scoper/blob/master/docs/further-reading.md#class-aliases
if (!function_exists('humbug_phpscoper_expose_class')) {
    function humbug_phpscoper_expose_class(string $exposed, string $prefixed): void {
        if (!class_exists($exposed, false) && !interface_exists($exposed, false) && !trait_exists($exposed, false)) {
            spl_autoload_call($prefixed);
        }
    }
}
humbug_phpscoper_expose_class('TGM_Plugin_Activation', 'CMLS_Base\Vendors\TGM_Plugin_Activation');
humbug_phpscoper_expose_class('TGMPA_List_Table', 'CMLS_Base\Vendors\TGMPA_List_Table');
humbug_phpscoper_expose_class('TGM_Bulk_Installer', 'CMLS_Base\Vendors\TGM_Bulk_Installer');
humbug_phpscoper_expose_class('TGM_Bulk_Installer_Skin', 'CMLS_Base\Vendors\TGM_Bulk_Installer_Skin');
humbug_phpscoper_expose_class('TGMPA_Bulk_Installer', 'CMLS_Base\Vendors\TGMPA_Bulk_Installer');
humbug_phpscoper_expose_class('TGMPA_Bulk_Installer_Skin', 'CMLS_Base\Vendors\TGMPA_Bulk_Installer_Skin');
humbug_phpscoper_expose_class('TGMPA_Utils', 'CMLS_Base\Vendors\TGMPA_Utils');
humbug_phpscoper_expose_class('ComposerAutoloaderInitdeff5945c097eec61340b745e6358072', 'CMLS_Base\Vendors\ComposerAutoloaderInitdeff5945c097eec61340b745e6358072');

// Function aliases. For more information see:
// https://github.com/humbug/php-scoper/blob/master/docs/further-reading.md#function-aliases
if (!function_exists('load_tgm_plugin_activation')) { function load_tgm_plugin_activation() { return \CMLS_Base\Vendors\load_tgm_plugin_activation(...func_get_args()); } }
if (!function_exists('my_theme_register_required_plugins')) { function my_theme_register_required_plugins() { return \CMLS_Base\Vendors\my_theme_register_required_plugins(...func_get_args()); } }
if (!function_exists('tgmpa')) { function tgmpa() { return \CMLS_Base\Vendors\tgmpa(...func_get_args()); } }
if (!function_exists('tgmpa_load_bulk_installer')) { function tgmpa_load_bulk_installer() { return \CMLS_Base\Vendors\tgmpa_load_bulk_installer(...func_get_args()); } }

return $loader;
