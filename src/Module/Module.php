<?php

/**
 * DESCRIPTION
 *
 * Copyright (C) ORGANISE
 *
 * @package   PACKAGE NAME
 * @file      Module.php
 * @author    AUTHOR
 * @license   GNU/LGPL
 * @copyright Copyright 2015 ORGANISE
 */


namespace ContaoBlackForestModifySearchContentContaoblackforest;

use ContaoBlackForest\Modify\Search\Content\Event\AddDataForContentEvent;
use ContaoBlackForest\Modify\Search\Content\Model\SearchResult;
use ContaoBlackForest\Modify\Search\Content\ModifySearchContentEvents;
use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class Module extends \ContaoBlackForestModifySearchContentContaoblackforestBridge\Module
{
    public function generate()
    {
        $buffer = parent::generate();

        $this->addDataForSearchContent();
        $this->addSearchResult();

        return $buffer;
    }

    protected function addDataForSearchContent()
    {
        /** @var $eventDispatcher EventDispatcher */
        $eventDispatcher = $GLOBALS['container']['event-dispatcher'];

        $event = new AddDataForContentEvent($this);
        $eventDispatcher->dispatch(ModifySearchContentEvents::ADD_DATA_FOR_CONTENT, $event);
    }

    protected function addSearchResult()
    {
        if ($this instanceof \ModuleSearch) {
            global $objPage;

            $queryType = $this->queryType;
            if (\Input::get('query_type')) {
                $queryType = \Input::get('query_type');
            }

            $fileName = md5(\Input::get('keywords') . $queryType . $objPage->rootId . $this->fuzzy) . '.json';
            $fileDirectory = 'system' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'search';
            $file = new \File($fileDirectory . DIRECTORY_SEPARATOR . $fileName, true);

            if ($file->exists()) {
                /** @var SearchResult $searchResult */
                $searchResult = $GLOBALS['container']['modify.search.model.search_result'];

                $searchResult->addJsonFile($file);
            }
        }
    }
}
