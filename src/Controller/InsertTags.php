<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      InsertTags.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */


namespace ContaoBlackForest\Modify\Search\Content\Controller;


use ContaoBlackForest\Modify\Search\Content\Model\SearchResult;

/**
 * Class InsertTags
 *
 * @package ContaoBlackForest\Modify\Search\Content\Controller
 */
class InsertTags
{
    /**
     * @param $tag string
     *
     * @return bool|string
     */
    public function replace($tag)
    {
        $chunks = explode('::', $tag);

        if ($chunks[0] === 'add_alternative_content') {
            return $this->replaceAlternativeContent($chunks[1]);
        }

        return false;
    }

    /**
     * @param $index string
     *
     * @return string
     */
    protected function replaceAlternativeContent($index)
    {
        /** @var SearchResult $searchResult */
        $searchResult = $GLOBALS['container']['modify.search.model.search_result'];

        $item = $searchResult->getItemResultFromUrl($index);

        if ($item) {
            return $item['alternativeContent'];
        }

        return false;
    }
}
