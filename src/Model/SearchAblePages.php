<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      SearchAblePages.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */


namespace ContaoBlackForest\Modify\Search\Content\Model;


class SearchAblePages
{
    protected $pages;

    protected $rootPage;

    protected $isSiteMap;

    protected $removePages;

    public function __construct($pages, $rootPage = 0, $isSiteMap = false)
    {
        $this->pages = new \ArrayObject();
        $this->addPages($pages);

        $this->rootPage  = $rootPage;
        $this->isSiteMap = $isSiteMap;

        $this->removePages = new \ArrayObject();
    }

    public function addPages($pages)
    {
        foreach ($pages as $page) {
            $this->addPage($page);
        }
    }

    public function addPage($page)
    {
        $this->pages->offsetSet(md5($page), $page);
    }

    public function removePages($pages)
    {
        foreach ($pages as $page) {
            $this->removePage($page);
        }
    }

    public function removePage($page)
    {
        $this->removePages->offsetSet(md5($page), $page);
    }

    public function getPages()
    {
        return $this->pages->getArrayCopy();
    }

    public function getRootPage()
    {
        return $this->rootPage;
    }

    public function getIsSiteMap()
    {
        return $this->isSiteMap;
    }

    public function getIntersection()
    {
        $deletes = $this->removePages->getArrayCopy();

        if ($deletes) {
            foreach ($deletes as $delete) {
                $this->pages->offsetUnset(md5($delete));
            }
        }

        // TODO find a better way for reindex array keys
        $pages = array();
        foreach ($this->pages->getArrayCopy() as $page) {
            $pages[] = $page;
        }

        return array_unique($pages);
    }
}
