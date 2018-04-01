<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 20/03/2018
 * Time: 23:58
 */

namespace Core\Table\Decorator\Cell;


use Core\Entity\AbstractEntity;
use Core\Table\Decorator\Exception\InvalidArgumentException;

class Btn extends AbstractCellDecorator
{

    /**
     * Array of variable attribute for link
     * @var array
     */
    protected $vars;

    /**
     * Link url
     * @var string
     */
    protected $url;
    private $options;



    /**
     * Constructor
     *
     * @param array $options
     * @throws InvalidArgumentException
     */
    public function __construct(array $options = array())
    {
        if (!isset($options['url'])) {
            throw new InvalidArgumentException('Url key in options argument required');
        }

        $this->url = $options['url'];
        $this->options = $options;
    }

    /**
     * Rendering decorator
     * @param string $context
     * @return string
     */
    public function render($context,$opt=null)
    {

        $Buttons=[];
        if ($opt) {
           $this->view = new \Core\Table\Template($opt);
        }
         if($this->getCell()->getActualRow() instanceof AbstractEntity){
            $actualRow = $this->getCell()->getActualRow()->toArray();
            foreach ($this->url->getBtn() as $name => $urls) {
                if (isset($urls['status'])) {
                    if ((array_search($actualRow['status'],$urls['status'])) === FALSE){
                        continue;
                    }
                    unset($urls['status']);
                }
                $Buttons[] = $this->view->render(sprintf("table/rows/%s", $name),[
                    'id'=>trim($actualRow[$urls['vars']])
                ]);
            }
        }
        return implode(" | ", $Buttons);
    }


}