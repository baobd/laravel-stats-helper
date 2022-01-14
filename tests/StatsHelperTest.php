<?php

namespace Label84\StatsHelper\Tests;

use Label84\StatsHelper\Facades\StatsHelper;

class StatsHelperTest extends TestCase
{
    /** @test */
    public function it_can_initialize_old_and_new_with_init_method()
    {
        $stats = StatsHelper::init(40, 60);

        $this->assertEquals(40, $stats->getOld());
        $this->assertEquals(60, $stats->getNew());
    }

    /** @test */
    public function it_can_initialize_old_and_new_with_their_dedicated_methods()
    {
        $stats = StatsHelper::setOld(40)->setNew(60);

        $this->assertEquals(40, $stats->getOld());
        $this->assertEquals(60, $stats->getNew());
    }

    /** @test */
    public function it_can_calculate_a_positive_difference_with_float_values()
    {
        $stats = StatsHelper::init(0.05, 0.50);

        $this->assertEquals(0.45, $stats->getDifference());
    }

    /** @test */
    public function it_can_calculate_a_positive_difference()
    {
        $stats = StatsHelper::init(40, 60);

        $this->assertEquals(20, $stats->getDifference());
    }

    /** @test */
    public function it_can_calculate_a_negative_difference()
    {
        $stats = StatsHelper::init(40, 30);

        $this->assertEquals(-10, $stats->getDifference());
    }

    /** @test */
    public function it_can_indicate_a_positive_difference()
    {
        $stats = StatsHelper::init(40, 60);

        $this->assertEquals(true, $stats->isPositive());
        $this->assertEquals(false, $stats->isNegative());
        $this->assertEquals(false, $stats->isUnchanged());
    }

    /** @test */
    public function it_can_indicate_a_negative_difference()
    {
        $stats = StatsHelper::init(60, 40);

        $this->assertEquals(false, $stats->isPositive());
        $this->assertEquals(true, $stats->isNegative());
        $this->assertEquals(false, $stats->isUnchanged());
    }

    /** @test */
    public function it_can_indicate_no_difference()
    {
        $stats = StatsHelper::init(60, 60);

        $this->assertEquals(true, $stats->isPositive());
        $this->assertEquals(false, $stats->isNegative());
        $this->assertEquals(true, $stats->isUnchanged());
    }

    /** @test */
    public function it_can_indicate_a_positive_percentage()
    {
        $stats = StatsHelper::init(40, 60);

        $this->assertEquals(150, $stats->getPercentage());
    }

    /** @test */
    public function it_can_indicate_a_negative_percentage()
    {
        $stats = StatsHelper::init(60, 40);

        $this->assertEquals(67, $stats->getPercentage());
    }

    /** @test */
    public function it_can_indicate_zero_change_percentage()
    {
        $stats = StatsHelper::init(60, 60);

        $this->assertEquals(100, $stats->getPercentage());
    }

    /** @test */
    public function it_does_not_throw_a_division_by_zero_exception_for_percentage()
    {
        $stats = StatsHelper::init(0, 0);

        $this->assertEquals(0, $stats->getPercentage());
    }

    /** @test */
    public function it_can_indicate_a_positive_change_percentage()
    {
        $stats = StatsHelper::init(40, 60);

        $this->assertEquals(50, $stats->getChangeInPercentage());
    }

    /** @test */
    public function it_can_indicate_a_negative_change_percentage()
    {
        $stats = StatsHelper::init(60, 40);

        $this->assertEquals(-33, $stats->getChangeInPercentage());
    }

    /** @test */
    public function it_can_indicate_zero_change_in_percentage()
    {
        $stats = StatsHelper::init(60, 60);

        $this->assertEquals(0, $stats->getChangeInPercentage());
    }

    /** @test */
    public function it_does_not_throw_a_division_by_zero_exception_for_percentage_change()
    {
        $stats = StatsHelper::init(0, 0);

        $this->assertEquals(0, $stats->getChangeInPercentage());
    }

    /** @test */
    public function it_can_set_the_new_old_and_new_value_with_next_method()
    {
        $stats = StatsHelper::init(40, 60);

        $this->assertEquals(40, $stats->getOld());
        $this->assertEquals(60, $stats->getNew());

        $stats->setNext(110);

        $this->assertEquals(60, $stats->getOld());
        $this->assertEquals(110, $stats->getNew());
    }

    /** @test */
    public function it_can_set_the_new_old_and_new_value_with_prev_method()
    {
        $stats = StatsHelper::init(110, 60);

        $this->assertEquals(110, $stats->getOld());
        $this->assertEquals(60, $stats->getNew());

        $stats->setPrev(130);

        $this->assertEquals(130, $stats->getOld());
        $this->assertEquals(110, $stats->getNew());
    }
}
