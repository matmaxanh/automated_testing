<?php


namespace App\tests\_support;


use App\tests\fixtures\AbstractFixture;
use App\tests\fixtures\PostFixture;
use App\tests\fixtures\UserFixture;
use Codeception\Module;
use Codeception\TestInterface;

// TODO Autoload these fixtures
require __DIR__ . '/../fixtures/AbstractFixture.php';
require __DIR__ . '/../fixtures/PostFixture.php';
require __DIR__ . '/../fixtures/UserFixture.php';

class FixtureHelper extends Module
{
    public function _before(TestInterface $test)
    {
        $this->loadFixtures();
    }

    private function loadFixtures()
    {
        $globalFixtures = $this->globalFixtures();
        foreach ($globalFixtures as $fixtureClass) {
            /** @var AbstractFixture $fixture */
            $fixture = new $fixtureClass();
            $fixtureData = $fixture->getFixtures();
            $modelClass = $fixture->getModelClass();

            foreach ($fixtureData as $modelData) {
                $record = new $modelClass($modelData);
                $record->save();
            }
        }
    }

    private function globalFixtures()
    {
        return [
            UserFixture::class,
            PostFixture::class
        ];
    }
}