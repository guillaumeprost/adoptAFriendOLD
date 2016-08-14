<?php
/**
 * Created by PhpStorm.
 * User: guillaumeprost
 * Date: 14/08/2016
 * Time: 12:03
 */

namespace AppBundle\Form\Model\Search;

/**
 * Class OfferModel
 * @package AppBundle\Form\Model\Search
 */
class OfferModel
{
    /**
     * @var string
     */
    private $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
}
