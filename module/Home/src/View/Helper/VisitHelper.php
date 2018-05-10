<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Home\View\Helper;


use Home\Service\VisitService;
use Interop\Container\ContainerInterface;
use Zend\Http\Client;
use Zend\Stdlib\Parameters;
use Zend\Uri\Uri;
use Zend\View\Helper\AbstractHelper;

class VisitHelper extends AbstractHelper
{

    /**
     * @var $config
     */
    protected $config;
    /**
     * @var $user_agent
     */
    protected $user_agent;
    /**
     * @var $uri Uri
     */
    protected $uri;
    /**
     * @var $parameter
     */
    protected $parameter;
    /**
     * @var $headers Headers
     */
    protected $headers;
    /**
     * @var $server Parameters
     */
    protected $server;
    /**
     * @var $cookie Cookies
     */
    protected $cookies;
    /**
     * @var $cookie
     */
    protected $cookie;
    /**
     * @var $referer
     */
    protected $referer;
    /**
     * @var SetCookie
     */
    protected $setCookie;

    protected $ip;
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->config = $container->get('config');

        if (!isset($this->config['user_agent'])){
            throw new \InvalidArgumentException("O arquivo user_agent não foi encontrado!");
        }
        $this->server = $container->get('request')->getServer()->toArray();
        //$this->headers = $container->get('request')->getHeaders();
        $this->uri = $container->get('request')->getUri();
        $this->cookie = filter_input(INPUT_COOKIE,md5($this->uri->getPath()),FILTER_DEFAULT);
        $this->user_agent = $this->config['user_agent'];
        $this->ip = $this->get('REMOTE_ADDR');
        if(!$this->cookie){
               $this->setData();
               $this->set_cookie();
        }
    }

    private function set_cookie(){
        \setcookie(md5($this->uri->getPath()),TRUE,(int)(time()+strtotime(date("Y-m-d 23:59:59"))));
    }


    private function setData(){

        $geo = new Client("http://ip-api.com/json/{$this->ip}");
        // $geo = new Client("http://ip-api.com/json/194.153.205.26");
        $GeoLocation = [];
        if($geo->send()->isOk()){
            $GeoLocation = json_decode($geo->send()->getBody(),true);
        }

        $Visit=[
            'empresa'=>$this->container->get('Company')->getId(),
            'page'=>$this->get('REQUEST_URI'),
            'ip'=>$this->ip,
            'city'=>'Desconhecida',
            'country'=>'Desconhecida',
            'region'=>'Desconhecida',
            'zip'=>'Desconhecido',
            'referer'=>$this->getReferer(),
            'browsers'=>$this->getBrowser(),
            'platform'=>$this->getPlatform(),
            'day'=>date('d'),
            'month'=>date('m'),
            'year'=>date('Y')
        ];

        $Data = array_merge($Visit, $GeoLocation);
        $Data['region'] = isset($Data['regionName'])?$Data['regionName']:"Desconhecida";
        $this->container->get(VisitService::class)->save($Data);
    }

    private function get($key){

        if(isset($this->server[$key])){
            return $this->server[$key];
        }

    }

    private function getBrowser(){
        foreach ($this->user_agent['browsers'] as $key => $value){
            if(preg_match('|' . $key . '.*?([0-9\.]+)|i', $this->get('HTTP_USER_AGENT'))){
                return $value;
            }
        }
    }

    private function getPlatform(){
        foreach ($this->user_agent['platforms'] as $key => $value){
            if(preg_match('|' . preg_quote($key) . '|i', $this->get('HTTP_USER_AGENT'))){
                return $value;
            }
        }
    }

    protected function getReferer(){
        $referer = $this->get('HTTP_REFERER');
        $referer_host = parse_url($referer, PHP_URL_HOST);
        $host = $this->get('HTTP_HOST');
        if(!$referer):
            return "Acesso direto";
        elseif ($referer_host == $host):
            return "Navegação interna";
        else:
            return $referer;
        endif;
    }


}