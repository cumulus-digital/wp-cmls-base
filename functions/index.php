<?php

namespace CMLS_Base;

\defined( 'ABSPATH' ) || exit( 'No direct access allowed.' );

const PREFIX = 'cmls_base';

require __DIR__ . '/helpers.php';

require __DIR__ . '/libs/Composer.php';

require __DIR__ . '/libs/BodyClasses.php';
require __DIR__ . '/libs/CleanMenuWalker.php';

require __DIR__ . '/setup/index.php';
