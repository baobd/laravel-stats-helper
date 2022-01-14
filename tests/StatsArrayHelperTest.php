<?php

namespace Label84\StatsHelper\Tests;

use Label84\StatsHelper\Facades\StatsArrayHelper;

class StatsArrayHelperTest extends TestCase
{
    /** @test */
    public function it_can_get_the_change_in_percentage_for_a_collection_of_values()
    {
        $colection = StatsArrayHelper::create([
            'January' => 10,
            'February' => 50,
            'March' => 75,
            'April' => 200,
            'May' => 100,
        ])
        ->mapWithKeys(fn ($stats, $key) => [$key => $stats->getChangeInPercentage().'%']);

        $this->assertEquals('0%', $colection->get('January'));
        $this->assertEquals('400%', $colection->get('February'));
        $this->assertEquals('50%', $colection->get('March'));
        $this->assertEquals('167%', $colection->get('April'));
        $this->assertEquals('-50%', $colection->get('May'));
    }

    /** @test */
    public function it_can_get_the_change_for_a_collection_of_values()
    {
        $colection = StatsArrayHelper::create([
            'January' => 10,
            'February' => 50,
            'March' => 75,
            'April' => 200,
            'May' => 100,
        ])
        ->mapWithKeys(fn ($stats, $key) => [$key => $stats->getDifference()]);

        $this->assertEquals('0', $colection->get('January'));
        $this->assertEquals('40', $colection->get('February'));
        $this->assertEquals('25', $colection->get('March'));
        $this->assertEquals('125', $colection->get('April'));
        $this->assertEquals('-100', $colection->get('May'));
    }
}
