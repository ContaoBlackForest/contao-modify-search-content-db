<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      AddDataForContentEvent.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */


namespace ContaoBlackForest\Modify\Search\Content\Event;


use ContaoBlackForest\Modify\Search\Content\Controller\Container;
use ContaoBlackForest\Modify\Search\Content\Element\ContainerElement;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class AddDataForContentEvent
 *
 * @package ContaoBlackForest\Modify\Search\Content\Event
 */
class AddDataForContentEvent extends Event
{
    protected static $IS_IN_POOL = false;

    /**
     * The content pool die add the data
     *
     * @var Container
     */
    protected $container;

    /**
     * The element who push to the container
     *
     * @var ContainerElement
     */
    protected $containerElement;

    /**
     * AddDataForContentEvent constructor.
     *
     * @param $module
     */
    public function __construct($module)
    {
        $this->container        = $GLOBALS['container']['modify.search.content.container'];
        $this->containerElement = $GLOBALS['container']['modify.search.content.container.element'];
        $this->containerElement->setModule($module);
    }

    protected function setToPool()
    {
        if (!self::$IS_IN_POOL
            && $this->getUrl()
            && $this->getTemplate()
            && $this->getData()
        ) {
            $this->container->addToPool($this->containerElement);

            self::$IS_IN_POOL = true;
        }
    }

    /**
     * Get the template name from container element
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->containerElement->getTemplate();
    }

    /**
     * Set the template name to container element
     *
     * @param $template string
     */
    public function setTemplate($template)
    {
        $this->containerElement->setTemplate($template);
        $this->setToPool();
    }

    /**
     * Get the template data from container element
     *
     * @return array or object
     */
    public function getData()
    {
        return $this->containerElement->getData();
    }

    /**
     * Set the template data to container element
     *
     * @param $data array or object
     */
    public function setData($data)
    {
        $this->containerElement->setData($data);
        $this->setToPool();
    }

    /**
     * Get the page url from container element
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->containerElement->getUrl();
    }

    /**
     * Set the page url to container element
     *
     * @param $url
     */
    public function setUrl($url)
    {
        $this->containerElement->setUrl($url);
        $this->setToPool();
    }

    /**
     * Get the module from container element
     *
     * @return object
     */
    public function getModule()
    {
        return $this->containerElement->getModule();
    }
}
