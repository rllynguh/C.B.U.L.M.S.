<?php

namespace Orchestra\Html;

use RuntimeException;
use Orchestra\Support\Str;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use Illuminate\Contracts\Container\Container;

abstract class Grid
{
    /**
     * Application instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $app;

    /**
     * Grid attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Key map for column overwriting.
     *
     * @var array
     */
    protected $keyMap = [];

    /**
     * Meta attributes.
     *
     * @var array
     */
    protected $meta = [];

    /**
     * Selected view path for layout.
     *
     * @var string
     */
    protected $view;

    /**
     * List of view data.
     *
     * @var array
     */
    protected $viewData = [];

    /**
     * Grid Definition.
     *
     * @var array
     */
    protected $definition = [
        'name'    => null,
        '__call'  => [],
        '__get'   => [],
        '__set'   => ['attributes'],
        '__isset' => [],
    ];

    /**
     * Create a new Grid instance.
     *
     * @param  \Illuminate\Contracts\Container\Container  $app
     * @param  array  $config
     */
    public function __construct(Container $app, array $config)
    {
        $this->app = $app;

        if (method_exists($this, 'initiate')) {
            $app->call([$this, 'initiate'], ['config' => $config]);
        }
    }

    /**
     * Add or append Grid attributes.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     *
     * @return array|null
     */
    public function attributes($key = null, $value = null)
    {
        if (is_null($key)) {
            return $this->attributes;
        }

        if (is_array($key)) {
            $this->attributes = array_merge($this->attributes, $key);
        } else {
            $this->attributes[$key] = $value;
        }

        return;
    }

    /**
     * Allow column overwriting.
     *
     * @param  string  $name
     * @param  mixed|null  $callback
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     *
     * @return \Illuminate\Support\Fluent
     */
    public function of($name, $callback = null)
    {
        $type = $this->definition['name'];

        if (is_null($type) || ! property_exists($this, $type)) {
            throw new RuntimeException('Not supported.');
        } elseif (! isset($this->keyMap[$name])) {
            throw new InvalidArgumentException("Name [{$name}] is not available.");
        }

        $id = $this->keyMap[$name];

        if (is_callable($callback)) {
            $callback($this->{$type}[$id]);
        }

        return $this->{$type}[$id];
    }

    /**
     * Forget meta value.
     *
     * @param  string  $key
     *
     * @return void
     */
    public function forget($key)
    {
        Arr::forget($this->meta, $key);
    }

    /**
     * Get meta value.
     *
     * @param  string  $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return Arr::get($this->meta, $key, $default);
    }

    /**
     * Set meta value.
     *
     * @param  string  $key
     * @param  mixed   $value
     *
     * @return array
     */
    public function set($key, $value)
    {
        return Arr::set($this->meta, $key, $value);
    }

    /**
     * Find definition that match the given id.
     *
     * @param  string  $name
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    abstract public function find($name);

    /**
     * Build basic name, label and callback option.
     *
     * @param  mixed  $name
     * @param  mixed  $callback
     *
     * @return array
     */
    protected function buildFluentAttributes($name, $callback = null)
    {
        $label = $name;

        if (! is_string($label)) {
            $callback = $label;
            $name     = '';
            $label    = '';
        } elseif (is_string($callback)) {
            $name     = Str::lower($callback);
            $callback = null;
        } else {
            $name  = Str::lower($name);
            $label = Str::humanize($name);
        }

        return [$label, $name, $callback];
    }

    /**
     * Magic Method for calling the methods.
     *
     * @param  string  $method
     * @param  array   $parameters
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function __call($method, array $parameters)
    {
        unset($parameters);

        if (! in_array($method, $this->definition['__call'])) {
            throw new InvalidArgumentException("Unable to use __call for [{$method}].");
        }

        return $this->$method;
    }

    /**
     * Magic Method for handling dynamic data access.
     *
     * @param  string  $key
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (! in_array($key, $this->definition['__get'])) {
            throw new InvalidArgumentException("Unable to use __get for [{$key}].");
        }

        return $this->{$key};
    }

    /**
     * Magic Method for handling the dynamic setting of data.
     *
     * @param  string  $key
     * @param  array   $parameters
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function __set($key, $parameters)
    {
        if (! in_array($key, $this->definition['__set'])) {
            throw new InvalidArgumentException("Unable to use __set for [{$key}].");
        }

        if ($key !== 'attributes') {
            $this->{$key} = $parameters;
            return;
        }

        if (! is_array($parameters)) {
            throw new InvalidArgumentException('Require values to be an array.');
        }

        $this->attributes($parameters, null);
    }

    /**
     * Magic Method for checking dynamically-set data.
     *
     * @param  string  $key
     *
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    public function __isset($key)
    {
        if (! in_array($key, $this->definition['__isset'])) {
            throw new InvalidArgumentException("Unable to use __isset for [{$key}].");
        }

        return isset($this->{$key});
    }
}
