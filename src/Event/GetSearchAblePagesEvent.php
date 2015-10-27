<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      GetSearchAblePagesEvent.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */


namespace ContaoBlackForest\Modify\Search\Content\Event;


use ContaoBlackForest\Modify\Search\Content\Model\SearchAblePages;
use Symfony\Component\EventDispatcher\Event;

class GetSearchAblePagesEvent extends Event
{
    /**
     * @var SearchAblePages
     */
    protected $model;

    public function __construct(SearchAblePages $model)
    {
        $this->model = $model;
    }

    public function addPages($pages)
    {
        $this->model->addPages($pages);
    }

    public function addPage($page)
    {
        $this->model->addPage($page);
    }

    public function removePages($pages)
    {
        $this->model->removePages($pages);
    }

    public function removePage($page)
    {
        $this->model->removePage($page);
    }

    public function getPages()
    {
        return $this->model->getPages();
    }

    public function getRootPage()
    {
        return $this->model->getRootPage();
    }

    public function getIsSiteMap()
    {
        return $this->model->getIsSiteMap();
    }
}
