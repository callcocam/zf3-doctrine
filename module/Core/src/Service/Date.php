<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 20/03/2018
 * Time: 16:08
 */

namespace Core\Service;


class Date
{
    private $created;

    private $timezone;

    /**
     * @var bool
     */
    private $localized = false;

    public function __construct(\DateTime $createDate)
    {
        // Within your view
        $this->plugin("dateFormat")->setTimezone("America/New_York")->setLocale("en_US");
    }


    public function SHORT($data){
        return $this->view->dateFormat(new \DateTime($data), \IntlDateFormatter::SHORT);
    }

    public function FULL($data){
        return $this->view->dateFormat(new \DateTime($data), \IntlDateFormatter::FULL);
    }

    public function LONG($data){
        return $this->view->dateFormat(new \DateTime($data), \IntlDateFormatter::LONG);
    }
}