<?php

namespace Label84\StatsHelper;

use Illuminate\Support\Collection;

class StatsArrayHelper
{
    /** @param Collection|array $items */
    public function create($items): Collection
    {
        if (is_array($items)) {
            $items = new Collection($items);
        }

        $collection = $items->getCachingIterator();

        $skip = 2;

        return $items->mapWithKeys(function ($value, $key) use (&$collection, &$skip) {
            if ($skip > 0) {
                $collection->getInnerIterator()->rewind();

                $skip--;
            }

            $item = [$key => (new StatsHelper())->init($collection->getInnerIterator()->current() ?? $value, $value)];

            $collection->getInnerIterator()->next();

            return $item;
        });
    }
}
