<?php

namespace Collective\Html\Traits;

use Illuminate\Support\Collection;

trait CheckerTrait
{
    /**
     * Create a checkbox input field.
     *
     * @param  string  $name
     * @param  mixed   $value
     * @param  bool    $checked
     * @param  array   $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function checkbox($name, $value = 1, $checked = null, $options = [])
    {
        return $this->checkable('checkbox', $name, $value, $checked, $options);
    }

    /**
     * Create a radio button input field.
     *
     * @param  string  $name
     * @param  mixed   $value
     * @param  bool    $checked
     * @param  array   $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function radio($name, $value = null, $checked = null, $options = [])
    {
        is_null($value) && $value = $name;

        return $this->checkable('radio', $name, $value, $checked, $options);
    }

    /**
     * Create a checkable input field.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  mixed   $value
     * @param  bool    $checked
     * @param  array   $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function checkable($type, $name, $value, $checked, $options)
    {
        $checked = $this->getCheckedState($type, $name, $value, $checked);

        $checked && $options['checked'] = 'checked';

        return $this->input($type, $name, $value, $options);
    }

    /**
     * Get the check state for a checkable input.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  mixed   $value
     * @param  bool    $checked
     *
     * @return bool
     */
    protected function getCheckedState($type, $name, $value, $checked)
    {
        switch ($type) {
            case 'checkbox':
                return $this->getCheckboxCheckedState($name, $value, $checked);
            case 'radio':
                return $this->getRadioCheckedState($name, $value, $checked);
            default:
                return $this->getValueAttribute($name) == $value;
        }
    }

    /**
     * Get the check state for a checkbox input.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @param  bool  $checked
     *
     * @return bool
     */
    protected function getCheckboxCheckedState($name, $value, $checked)
    {
        if (isset($this->session) && ! $this->oldInputIsEmpty() && is_null($this->old($name))) {
            return false;
        }

        if ($this->missingOldAndModel($name)) {
            return $checked;
        }

        $posted = $this->getValueAttribute($name, $checked);

        if (is_array($posted)) {
            return in_array($value, $posted);
        } elseif ($posted instanceof Collection) {
            return $posted->contains('id', $value);
        }

        return (bool) $posted;
    }

    /**
     * Get the check state for a radio input.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @param  bool  $checked
     *
     * @return bool
     */
    protected function getRadioCheckedState($name, $value, $checked)
    {
        if ($this->missingOldAndModel($name)) {
            return $checked;
        }

        return $this->getValueAttribute($name) == $value;
    }
}
