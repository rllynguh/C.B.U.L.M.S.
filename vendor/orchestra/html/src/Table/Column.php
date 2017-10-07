<?php

namespace Orchestra\Html\Table;

use Illuminate\Support\Fluent;
use Illuminate\Contracts\Support\Renderable;
use Orchestra\Contracts\Html\Table\Column as ColumnContract;

class Column extends Fluent implements ColumnContract
{
    /**
     * Get value of column.
     *
     * @param  mixed  $row
     *
     * @return string
     */
    public function getValue($row)
    {
        $escape = $this->get('escape', false);
        $value  = $this->attributes['value']($row);

        if ($value instanceof Renderable) {
            return $value->render();
        }

        return ($escape === true ? e($value) : $value);
    }
}
