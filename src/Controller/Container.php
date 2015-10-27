<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      Container.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */


namespace ContaoBlackForest\Modify\Search\Content\Controller;


use Contao\Database;
use Contao\File;
use Contao\Files;
use Contao\Folder;
use ContaoBlackForest\Modify\Search\Content\Element\ContainerElement;
use ContaoBlackForest\Modify\Search\Content\Event\FormatValueEvent;
use ContaoBlackForest\Modify\Search\Content\ModifySearchContentEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Container
{
    /**
     * pool of modify search data
     */
    protected $pool;

    // TODO if dispatcher really used
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * add some configurations for this class
     */
    public function __construct()
    {
        $this->eventDispatcher = $GLOBALS['container']['event-dispatcher'];
        $this->pool            = new \ArrayObject();
    }

    /**
     * add the modify data
     *
     * @param ContainerElement $element
     */
    public function addToPool(ContainerElement $element)
    {
        $this->pool->offsetSet(md5($element->getUrl()), $element);
    }

    /**
     * @param $content            string
     * @param $properties               array
     * @param $propertiesSet       array
     */
    public function modifySearchContent($content, $properties, &$propertiesSet)
    {
        $instance = $GLOBALS['container']['modify.search.content.container'];
        /** @var Database $database */
        $database = $GLOBALS['container']['database.connection'];

        /** @var ContainerElement $item */
        $item = $instance->pool->offsetGet(md5($properties['url']));

        if (!$item) {
            return;
        }


        $template = new \FrontendTemplate($item->getTemplate());
        $template->setData(
            array
            (
                'data'   => $item->getData(),
                'module' => $item->getModule(),
                'href'   => $item->getUrl(),
            )
        );

        $alternativeContent = $template->parse();

        $search = $database->prepare("SELECT * FROM tl_search WHERE url=? AND pid=?")
            ->limit(1)
            ->execute($item->getUrl(), $properties['pid']);

        if ($search->numRows
            && $search->alternativeContent != $alternativeContent
        ) {
            $database->prepare("UPDATE tl_search %s WHERE id=?")
                ->set(
                    array
                    (
                        'checksum' => ''
                    )
                )
                ->execute($search->fetchAllAssoc()[0]['id']);

            $propertiesSet['alternativeContent'] = $alternativeContent;
        }

        if (!$search->numRows) {
            $propertiesSet['alternativeContent'] = $alternativeContent;
        }
    }
}
