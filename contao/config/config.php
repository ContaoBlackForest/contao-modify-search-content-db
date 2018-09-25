<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      config.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */

$GLOBALS['TL_HOOKS']['indexPage'][] = array
(
    '\ContaoBlackForest\Modify\Search\Content\Controller\Container',
    'modifySearchContent'
);

$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array
(
    '\ContaoBlackForest\Modify\Search\Content\Controller\InsertTags',
    'replace'
);

$GLOBALS['TL_HOOKS']['getSearchablePages'][] = array
(
    '\ContaoBlackForest\Modify\Search\Content\Controller\GetSearchAblePages',
    'init'
);

$GLOBALS['TL_EXTEND']['Module'][] = array
(
    'namespace'  => 'ContaoBlackForestModifySearchContent',
    'path'       => 'composer/vendor/contaoblackforest/contao-modify-search-content-db/src/Module/Module.php',
    'isAbstract' => true
);


