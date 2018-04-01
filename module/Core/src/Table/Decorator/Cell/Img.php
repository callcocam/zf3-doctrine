<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 28/03/2018
 * Time: 10:58
 */

namespace Core\Table\Decorator\Cell;


use Core\Entity\AbstractEntity;
use Core\Table\Decorator\Exception\InvalidArgumentException;

class Img extends AbstractCellDecorator
{

    /**
     * Array of variables
     * @var null | array
     */
    protected $vars;
    protected $w = 100;
    protected $h = 85;
    private $thumbnail = false;

    /**
     * Constructor
     *
     * @param array $options
     * @throws InvalidArgumentException
     */
    public function __construct( array $options = [] )
    {

        if (!isset($options['vars'])) {
            throw new InvalidArgumentException('vars key in options argument required');
        }
        $this->vars = $options['vars'];
        if (!isset($this->vars['id'])) {
            throw new InvalidArgumentException('id key in options argument required');
        }
        if (!isset($this->vars['name'])) {
            throw new InvalidArgumentException('name key in options argument required');
        }

        $this->vars['createdAt'] = isset($this->vars['createdAt']) ? $this->vars['createdAt'] : "createdAt";
        $this->w = isset($options['w']) ? $options['w'] : $this->w;
        $this->h = isset($options['h']) ? $options['h'] : $this->h;
        $this->thumbnail = isset($options['thumbnail']) ? $options['thumbnail'] : $this->thumbnail;

    }

    /**
     * Rendering decorator
     *
     * @param string $context
     * @param null $opt
     * @return string
     */
    public function render( $context, $opt = null )
    {
        if ($opt) {
            $this->view = new \Core\Table\Template($opt);
        }

        if ($context instanceof \DateTime) {
            $context = $context->format("d/m/Y");
        }

        if ($this->getCell()->getActualRow() instanceof AbstractEntity) {
            $actualRow = $this->getCell()->getActualRow()->toArray();
        } else {
            $actualRow = $this->getCell()->getActualRow();
        }

        if ($actualRow[$this->vars['id']] instanceof \DateTime):
            $actualRow[$this->vars['id']] = $actualRow[$this->vars['id']]->format("d/m/Y");
        endif;
        $values = $actualRow[$this->vars['id']];
        return $this->view->render("table/rows/thumbnail", [
            'id' => trim($values[$this->vars['id']]),
            'name' => trim($values[$this->vars['name']]),
            'context' => $context,
            'status' => trim($values["status"]),
            'createdAt' => trim($values["createdAt"]),
            'query' => [
                'name' => $context,
                'w' => $this->w,
                'thumbnail' => $this->thumbnail,
            ],

        ]);

    }

}