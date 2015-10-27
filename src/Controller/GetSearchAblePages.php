<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      GetSearchAblePages.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */


namespace ContaoBlackForest\Modify\Search\Content\Controller;


use ContaoBlackForest\Modify\Search\Content\Event\GetSearchAblePagesEvent;
use ContaoBlackForest\Modify\Search\Content\ModifySearchContentEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class GetSearchAblePages
{
    public function init($pages, $rootPage = 0, $isSiteMap = false)
    {
        $GLOBALS['container']['modify.search.model.search_able_pages.arguments'] = func_get_args();

        $model = $GLOBALS['container']['modify.search.model.search_able_pages'];

        /** @var EventDispatcherInterface $eventDispatcher */
        $eventDispatcher = $GLOBALS['container']['event-dispatcher'];

        $event = new GetSearchAblePagesEvent($model);
        $eventDispatcher->dispatch(ModifySearchContentEvents::GET_SEARCH_ABLE_PAGE, $event);

        return $model->getIntersection();
    }
}
