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


namespace ContaoBlackForest\Modify\Search\Content\Element;


/**
 * Class ContainerElement
 *
 * @package ContaoBlackForest\Modify\Search\Content\Element
 */
class ContainerElement
{
    /**
     * The template data used in the template
     *
     * @var array or object
     */
    protected $data;

    /**
     * The template to render the search content
     *
     * @var string
     */
    protected $template;

    /**
     * The page url from the page
     *
     * @var string
     */
    protected $url;

    /**
     * The module to get settings
     * (e.g. to get render setting for pictures)
     *
     * @var object
     */
    protected $module;

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return object
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param object $module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }

    /**
     * @return array
     */
    public function getJson()
    {
        return array
        (
            'data'     => $this->getData(),
            'template' => $this->getTemplate(),
            'url'      => $this->getUrl(),
            'module'   => $this->getModule()->getModel()->row(),
        );
    }
}
