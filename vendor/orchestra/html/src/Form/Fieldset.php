<?php

namespace Orchestra\Html\Form;

use Closure;
use InvalidArgumentException;
use Orchestra\Html\Grid as BaseGrid;
use Orchestra\Contracts\Html\Form\Template;
use Illuminate\Contracts\Container\Container;
use Orchestra\Contracts\Html\Form\Control as ControlContract;
use Orchestra\Contracts\Html\Form\Fieldset as FieldsetContract;

class Fieldset extends BaseGrid implements FieldsetContract
{
    /**
     * Fieldset name.
     *
     * @var string
     */
    protected $name;

    /**
     * Control group.
     *
     * @var array
     */
    protected $controls = [];

    /**
     * Field control instance.
     *
     * @var \Orchestra\Contracts\Html\Form\Control
     */
    protected $control;

    /**
     * {@inheritdoc}
     */
    protected $definition = [
        'name'    => 'controls',
        '__call'  => ['name', 'controls'],
        '__get'   => ['attributes', 'name', 'controls'],
        '__set'   => ['attributes'],
        '__isset' => ['attributes', 'name', 'controls'],
    ];

    /**
     * Create a new Fieldset instance.
     *
     * @param  \Illuminate\Contracts\Container\Container  $app
     * @param  array  $config
     * @param  string|\Closure  $name
     * @param  \Closure|null  $callback
     */
    public function __construct(Container $app, array $config, $name, Closure $callback = null)
    {
        parent::__construct($app, $config);

        $this->buildBasic($name, $callback);
    }

    /**
     * Load grid configuration.
     *
     * @param  array  $config
     * @param  \Orchestra\Contracts\Html\Form\Control  $control
     * @param  \Orchestra\Contracts\Html\Form\Template  $presenter
     *
     * @return void
     */
    public function initiate(array $config, ControlContract $control, Template $presenter)
    {
        $control->setTemplates($config)->setPresenter($presenter);

        $this->control = $control;
    }

    /**
     * Build basic fieldset.
     *
     * @param  string|\Closure  $name
     * @param  \Closure|null  $callback
     *
     * @return void
     */
    protected function buildBasic($name, Closure $callback = null)
    {
        if ($name instanceof Closure) {
            $callback = $name;
            $name     = null;
        }

        ! empty($name) && $this->legend($name);

        $callback($this);
    }

    /**
     * Append a new control to the form.
     *
     * <code>
     *      // add a new control using just field name
     *      $fieldset->control('input:text', 'username');
     *
     *      // add a new control using a label (header title) and field name
     *      $fieldset->control('input:email', 'E-mail Address', 'email');
     *
     *      // add a new control by using a field name and closure
     *      $fieldset->control('input:text', 'fullname', function ($control)
     *      {
     *          $control->label = 'User Name';
     *
     *          // this would output a read-only output instead of form.
     *          $control->field = function ($row) {
     *              return $row->first_name.' '.$row->last_name;
     *          };
     *      });
     * </code>
     *
     * @param  string  $type
     * @param  mixed   $name
     * @param  mixed   $callback
     *
     * @return \Illuminate\Support\Fluent
     */
    public function control($type, $name, $callback = null)
    {
        list($name, $control) = $this->buildControl($name, $callback);

        if (is_null($control->field)) {
            $control->field = $this->control->generate($type);
        }

        $this->controls[]    = $control;
        $this->keyMap[$name] = count($this->controls) - 1;

        return $control;
    }

    /**
     * Find definition that match the given id.
     *
     * @param  string  $name
     *
     * @throws \InvalidArgumentException
     *
     * @return \Illuminate\Support\Fluent
     */
    public function find($name)
    {
        if (! array_key_exists($name, $this->keyMap)) {
            throw new InvalidArgumentException("Name [{$name}] is not available.");
        }

        return $this->controls[$this->keyMap[$name]];
    }

    /**
     * Build control.
     *
     * @param  mixed  $name
     * @param  mixed  $callback
     *
     * @return array
     */
    protected function buildControl($name, $callback = null)
    {
        list($label, $name, $callback) = $this->buildFluentAttributes($name, $callback);

        $control = new Field([
            'id'         => preg_replace('/(.+)\[\]/', '$1', $name),
            'name'       => $name,
            'value'      => null,
            'label'      => $label,
            'attributes' => [],
            'options'    => [],
            'checked'    => false,
            'field'      => null,
        ]);

        is_callable($callback) && $callback($control);

        return [$name, $control];
    }

    /**
     * Set Fieldset Legend name.
     *
     * <code>
     *     $fieldset->legend('User Information');
     * </code>
     *
     * @param  string  $name
     *
     * @return string
     */
    public function legend($name = null)
    {
        if (! is_null($name)) {
            $this->name = $name;
        }

        return $this->name;
    }

    /**
     * Get fieldset name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
