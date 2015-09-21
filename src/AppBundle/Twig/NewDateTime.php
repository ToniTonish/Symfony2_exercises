<?php
// src/AppBundle/Twig/NewDateTime.php

namespace AppBundle\Twig;

class NewDateTime extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('stampaOra', array($this, 'dateTimeFilter')),
        );
    }

    public function dateTimeFilter()
    {
        $new_date_format = date('d/m/Y H:i:s a'); 

        return $new_date_format;
    }

    public function getName()
    {
        return 'new_date_time';
    }
}