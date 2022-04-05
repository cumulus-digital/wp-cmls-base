<?php

// scoper-autoload.php @generated by PhpScoper

$loader = require_once __DIR__.'/autoload.php';

// Exposed classes. For more information see:
// https://github.com/humbug/php-scoper/blob/master/docs/configuration.md#exposing-classes
if (!class_exists('TGM_Plugin_Activation', false) && !interface_exists('TGM_Plugin_Activation', false) && !trait_exists('TGM_Plugin_Activation', false)) {
    spl_autoload_call('CMLS_Base\Vendors\TGM_Plugin_Activation');
}
if (!class_exists('TGMPA_List_Table', false) && !interface_exists('TGMPA_List_Table', false) && !trait_exists('TGMPA_List_Table', false)) {
    spl_autoload_call('CMLS_Base\Vendors\TGMPA_List_Table');
}
if (!class_exists('TGM_Bulk_Installer', false) && !interface_exists('TGM_Bulk_Installer', false) && !trait_exists('TGM_Bulk_Installer', false)) {
    spl_autoload_call('CMLS_Base\Vendors\TGM_Bulk_Installer');
}
if (!class_exists('TGM_Bulk_Installer_Skin', false) && !interface_exists('TGM_Bulk_Installer_Skin', false) && !trait_exists('TGM_Bulk_Installer_Skin', false)) {
    spl_autoload_call('CMLS_Base\Vendors\TGM_Bulk_Installer_Skin');
}
if (!class_exists('TGMPA_Bulk_Installer', false) && !interface_exists('TGMPA_Bulk_Installer', false) && !trait_exists('TGMPA_Bulk_Installer', false)) {
    spl_autoload_call('CMLS_Base\Vendors\TGMPA_Bulk_Installer');
}
if (!class_exists('TGMPA_Bulk_Installer_Skin', false) && !interface_exists('TGMPA_Bulk_Installer_Skin', false) && !trait_exists('TGMPA_Bulk_Installer_Skin', false)) {
    spl_autoload_call('CMLS_Base\Vendors\TGMPA_Bulk_Installer_Skin');
}
if (!class_exists('TGMPA_Utils', false) && !interface_exists('TGMPA_Utils', false) && !trait_exists('TGMPA_Utils', false)) {
    spl_autoload_call('CMLS_Base\Vendors\TGMPA_Utils');
}
if (!class_exists('ComposerAutoloaderInit68c41a34ef5606a729efc05054394373', false) && !interface_exists('ComposerAutoloaderInit68c41a34ef5606a729efc05054394373', false) && !trait_exists('ComposerAutoloaderInit68c41a34ef5606a729efc05054394373', false)) {
    spl_autoload_call('CMLS_Base\Vendors\ComposerAutoloaderInit68c41a34ef5606a729efc05054394373');
}

return $loader;
