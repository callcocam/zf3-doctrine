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
use Zend\Debug\Debug;

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
    /**
     * @var array
     */
    private $params = [];
    private $options;
    private $ico="";
    private $action;
    private $status;

    protected $class = [
        '1'=>'green',
        '2'=>'yellow',
        '3'=>'red',
    ];


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
        if (isset($options['params'])) {
            $this->params = $options['params'];
        }
        $this->options = $options;
    }

    /**
     * Rendering decorator
     * @param string $context
     * @return string
     */
    public function render($context)
    {

        $Buttons=[];
        $actualRow = [];
         if($this->getCell()->getActualRow() instanceof AbstractEntity){
            $actualRow = $this->getCell()->getActualRow()->toArray();
            foreach ($this->url->getBtn() as $urls) {
                if (isset($urls['status'])) {
                    if ((array_search($actualRow['status'],$urls['status'])) === FALSE){
                        continue;
                    }
                    unset($urls['status']);
                }

                if (isset($urls['date'])) {

                    if ($urls['date'] !== $actualRow['created_at']){
                        continue;
                    }
                    unset($urls['date']);
                }
                if (isset($urls['vars'])) {
                    $this->vars = is_array($urls['vars']) ? $urls['vars'] : array($urls['vars']);
                    unset($urls['vars']);
                }
                if (isset($urls['status'])) {
                    $this->status = $urls['status'];
                    unset($urls['status']);
                }

                $attrs = $this->getAttrs($urls,$actualRow);
                if (count($this->vars)) {
                    foreach ($this->vars as $key => $var) {
                        $values[] = trim($actualRow[$var]);
                    }
                }
                $url = vsprintf($this->action, $values);
                $Buttons[] = sprintf('<a %s  href="%s">%s</a>', $attrs, str_replace(" ", "", $url), $this->ico);
            }
        }





        return implode(" | ", $Buttons);
    }

    /**
     * @param $urls
     * @return string
     */
    private function getAttrs($urls,$actualRow){
        $BtnAttrs=[];

        foreach ($urls as  $attrs) {
            if(is_array($attrs)):
                if(isset($attrs['data-state'])):
                    $attrs['data-state'] = $actualRow['id'];
                endif;
                foreach ($attrs as $key => $attr) {
                    //var_dump($attr);
                    $BtnAttrs[] =sprintf('%s="%s"', $key,  $attr);
                }
                if(isset($urls['ico'])):
                    $this->ico =sprintf('<i class="%s"> </i>', $urls['ico']);
                endif;
                if(isset($urls['href'])):
                    $this->action = $urls['href'];
                endif;
            endif;
        }

        return  implode(" ", $BtnAttrs);
    }
}