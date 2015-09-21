<?php

namespace AppBundle\Service;

class RandomGeneratorService {

    public function __construct()
    {
        
    }

    public function generateRandomNumber()
    {
        return rand(1, 100);
    }
}