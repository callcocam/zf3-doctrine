<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 27/03/2018
 * Time: 20:10
 */

namespace Core\Table\View\Helper;


use Core\Entity\AbstractEntity;
use Core\Table\Decorator\AbstractDecorator;
use Core\Table\Decorator\DecoratorFactory;
use Zend\View\Helper\AbstractHelper;

class Cell extends AbstractHelper
{

    /**
     * Header object
     * @var Header
     */
    protected $header;

    /**
     *
     * @param Header $header
     */
    public function __construct($header)
    {
        $this->header = $header;
    }

    /**
     *
     * @param string $name type
     * @param array $options type
     * @return AbstractDecorator
     */
    public function addDecorator($name, $options = array())
    {
        $decorator = DecoratorFactory::factoryCell($name, $options);
        $decorator->setCell($this);
        $this->attachDecorator($decorator);
        return $decorator;
    }

    /**
     * Get header object
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set header object
     *
     * @param Header $header
     * @return $this
     */
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Get actual row
     *
     * @return array
     */
    public function getActualRow()
    {
        return $this->getTable()->getRow()->getActualRow();
    }

    /**
     * Rendering single cell
     *
     * @return string
     */
    public function render($type = 'html')
    {
        $row = $this->getTable()->getRow()->getActualRow();
        $value = '';
        if (is_array($row) || $row instanceof \ArrayAccess) {
            $value = (isset($row[$this->getHeader()->getName()])) ? $row[$this->getHeader()->getName()] : '';
        } elseif (is_object($row)) {
            $headerName = $this->getHeader()->getName();
            $methodName = 'get' . ucfirst($headerName);
            if (method_exists($row, $methodName)) {
                $value = $row->$methodName();
            } else {
                $value = (property_exists($row, $headerName)) ? $row->$headerName : '';
            }
        }

        foreach ($this->decorators as $decorator) {
            if ($decorator->validConditions()) {
                $value = $decorator->render($value);
            }
        }

        if ($type == 'html') {

            if ($value instanceof \DateTime) {
                $value = $value->format("d/m/Y");
            }
            if ($value instanceof AbstractEntity) {
                $headerName = $this->getHeader()->getName();
                $methodName = 'get' . ucfirst($headerName);
                if (method_exists($row, $methodName)) {
                    $value = $value->$methodName();
                } else {
                    $value = (property_exists($value, $headerName)) ? $value->$headerName : '';
                }
            }
           $ret = $this->view->partial(sprintf("layout/%s/templates/table/cell", LAYOUT), [
                'attr'=>$this->getAttributes(),
                'value'=>$value
            ]);
            $this->clearVar();
            return $ret;

        } else {
            return $value;
        }
    }
}