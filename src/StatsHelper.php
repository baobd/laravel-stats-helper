<?php

namespace Label84\StatsHelper;

class StatsHelper
{
    protected float $old;

    protected float $new;

    public function init(float $old, float $new): self
    {
        $this->old = $old;
        $this->new = $new;

        return $this;
    }

    public function setOld(float $old): self
    {
        $this->old = $old;

        return $this;
    }

    public function setNew(float $new): self
    {
        $this->new = $new;

        return $this;
    }

    public function setNext(float $next): self
    {
        $this->old = $this->new;
        $this->new = $next;

        return $this;
    }

    public function setPrev(float $prev): self
    {
        $this->new = $this->old;
        $this->old = $prev;

        return $this;
    }

    public function getOld(): float
    {
        return $this->old;
    }

    public function getNew(): float
    {
        return $this->new;
    }

    public function getDifference(): float
    {
        return $this->new - $this->old;
    }

    public function isPositive(): bool
    {
        return $this->getDifference() >= 0;
    }

    public function isNegative(): bool
    {
        return $this->getDifference() < 0;
    }

    public function isUnchanged(): bool
    {
        return $this->getDifference() == 0;
    }

    public function getPercentage(int $decimals = 0, ?string $decimalSeparator = '.', ?string $thousandSeparator = ''): string
    {
        $old = $this->old;

        if ($old == 0) {
            $old = 1;
        }

        $value = ($this->new / $old) * 100;

        return number_format($value, $decimals, $decimalSeparator, $thousandSeparator);
    }

    public function getChangeInPercentage(int $decimals = 0, ?string $decimalSeparator = '.', ?string $thousandSeparator = ''): string
    {
        $old = $this->old;

        if ($old == 0) {
            $old = 1;
        }

        $value = (($this->new - $this->old) / $old) * 100;

        return number_format($value, $decimals, $decimalSeparator, $thousandSeparator);
    }
}
