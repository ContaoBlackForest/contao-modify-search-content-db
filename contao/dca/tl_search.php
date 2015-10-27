<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      tl_search.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */


$fields = array
(
    'alternativeContent' => array
    (
      'sql' => 'blob NULL',
    ),
);

$GLOBALS['TL_DCA']['tl_search']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_search']['fields'], $fields);
