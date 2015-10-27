<?php
/**
 * FRAMEWORK
 *
 * Copyright (C) FRAMEWORK
 *
 * @package   brugg-regio-ch
 * @file      SearchResult.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   GNU/LGPL
 * @copyright Copyright 2015 owner
 */


namespace ContaoBlackForest\Modify\Search\Content\Model;


/**
 * Class SearchResult
 *
 * @package ContaoBlackForest\Modify\Search\Content\Model
 */
class SearchResult
{
    /**
     * The result object
     *
     * @var \ArrayObject
     */
    protected $result;

    /**
     * add somethings
     */
    public function __construct()
    {
        $this->result = new \ArrayObject();
    }

    /**
     * Add the result to this result object
     *
     * @param $result
     */
    protected function addResult($result)
    {
        if (!array_key_exists('url', $result)
            && !array_key_exists('checksum', $result)
        ) {
            return;
        }

        $this->result->offsetSet(md5($result['url']), $result);
    }

    public function getItemResultFromUrl($url)
    {
        return $this->result->offsetGet(md5($url));
    }

    /**
     * Add the result from json file object
     *
     * @param \File $file
     */
    public function addJsonFile(\File $file)
    {
        if (substr($file->name, -4, 4) != 'json') {
            return;
        }

        $data = array();
        $data = json_decode($file->getContent(), true);

        if ($data) {
            foreach ($data as $result) {
                $this->addResult($result);
            }
        }
    }
}
