<?php
/**
 * Theme initialization
 */
namespace CMLS_Base;
if (!defined('ABSPATH')) die('No direct access allowed');

require __DIR__ . '/global.php';
require __DIR__ . '/theme_support.php';
require __DIR__ . '/required.php';
require __DIR__ . '/menus.php';
require __DIR__ . '/media.php';
require __DIR__ . '/backend.php';
require __DIR__ . '/frontend.php';
require __DIR__ . '/cleanup.php';

require __DIR__ . '/customizer/index.php';
require __DIR__ . '/acf/index.php';
