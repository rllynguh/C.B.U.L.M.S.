<?php

namespace Orchestra\Html\Form;

use Illuminate\Support\Fluent;
use Orchestra\Html\Traits\Decorate;
use Illuminate\Contracts\Support\Renderable;
use Orchestra\Contracts\Html\Form\Field as FieldContract;

class Field extends Fluent implements FieldContract
{
    use Decorate;

    /**
     * Get value of column.
     *
     * @param  mixed  $row
     * @param  array  $templates
     *
     * @return string
     */
    public function getField($row, array $templates = [])
    {
        $value = $this->attributes['field']($row, $this, $templates);

        if ($value instanceof Renderable) {
            return $value->render();
        }

        return $value;
    }

    /**
     * Setup attributes via decorate.
     *
     * @param  array  $value
     *
     * @return $this
     */
    public function attributes(array $value = [])
    {
        $this->attributes['attributes'] = $this->decorate(
            $value,
            $this->attributes['attributes']
        );

        return $this;
    }
}
