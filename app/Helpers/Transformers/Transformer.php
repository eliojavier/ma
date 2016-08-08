<?php namespace App\Helpers\Transformers;

abstract class Transformer {
    /**
     * Transform query.
     * @param $items array
     * @return array
     */
    public function transformCollection($items)
    {
        return array_map([$this, 'transform'],$items);
    }

    public abstract function transform($item);

}