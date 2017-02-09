<?php


namespace App\tests\fixtures;


abstract class AbstractFixture
{
    abstract function getModelClass();

    abstract function getFixtures();
}