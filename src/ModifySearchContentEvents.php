<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      ModifySearchContent.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */


namespace ContaoBlackForest\Modify\Search\Content;


/**
 * Class ModifySearchContent
 *
 * @package ContaoBlackForest\Modify\Search\Content
 */
class ModifySearchContentEvents
{
    /**
     * This event add the data for modify the search content
     *
     * @see \ContaoBlackForest\Modify\Search\Content\Event\AddDataForContentEvent
     */
    const ADD_DATA_FOR_CONTENT = 'modify.search.content.add_data_for_content';

    /**
     * The event add search able pages
     *
     * @see \ContaoBlackForest\Modify\Search\Content\Event\GetSearchAblePagesEvent;
     */
    const GET_SEARCH_ABLE_PAGE = 'modify.search.content.get_search_able_page';
}
