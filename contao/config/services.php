<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      services.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */

/**
 * @var Pimple $container
 */
$container['modify.search.content.container'] = $container->share(
    function () {
        $class = new ReflectionClass('\ContaoBlackForest\Modify\Search\Content\Controller\Container');

        return $class->newInstance();
    }
);

$container['modify.search.model.search_result'] = $container->share(
    function () {
        $class = new ReflectionClass('\ContaoBlackForest\Modify\Search\Content\Model\SearchResult');

        return $class->newInstance();
    }
);

$container['modify.search.model.search_able_pages'] = $container->share(
    function ($container) {
        $class = new ReflectionClass('\ContaoBlackForest\Modify\Search\Content\Model\SearchAblePages');

        if ($container->offsetExists('modify.search.model.search_able_pages.arguments')) {
            return $class->newInstanceArgs($container->offsetGet('modify.search.model.search_able_pages.arguments'));
        }

        return $class->newInstance();
    }
);

$container['modify.search.content.container.element'] = function () {
    return new \ContaoBlackForest\Modify\Search\Content\Element\ContainerElement();
};
