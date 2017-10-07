<?php

namespace Orchestra\Html\Traits;

use Illuminate\Support\Str;

trait Decorate
{
    /**
     * Build a list of HTML attributes from one or two array.
     *
     * @param  array  $attributes
     * @param  array  $defaults
     *
     * @return array
     */
    public function decorate(array $attributes, array $defaults = [])
    {
        $class = $this->buildClassDecorate($attributes, $defaults);

        $attributes = array_merge($defaults, $attributes);

        if (! empty($class)) {
            $attributes['class'] = $class;
        }

        return $attributes;
    }

    /**
     * Build class attribute from one or two array.
     *
     * @param  array  $attributes
     * @param  array  $defaults
     *
     * @return string
     */
    protected function buildClassDecorate(array $attributes, array $defaults = [])
    {
        // Special consideration to class, where we need to merge both string
        // from $attributes and $defaults, then take union of both.
        $default   = $defaults['class'] ?? '';
        $attribute = $attributes['class'] ?? '';

        $classes   = explode(' ', trim($default.' '.$attribute));
        $current   = array_unique($classes);
        $excludes  = [];

        foreach ($current as $c) {
            if (Str::startsWith($c, '!')) {
                $excludes[] = substr($c, 1);
                $excludes[] = $c;
            }
        }

        return implode(' ', array_diff($current, $excludes));
    }
}
