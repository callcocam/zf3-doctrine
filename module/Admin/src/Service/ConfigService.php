<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Admin\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Config\Config;
use Zend\Config\Writer\PhpArray;

class ConfigService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity = "Admin\Entity\ConfigEntity";
        parent::__construct($em);
    }

    public function save(Array $data = [])
    {
        $result = parent::save($data);
        $this->setConfig();
        return $result;
    }

    public function setConfig()
    {
        $confs = $this->em->getRepository($this->entity)->findBy(['status' => '1']);

        if ($confs):
            foreach ($confs as $conf):
                $DotEnv[$conf->getConfName()] = $conf->getConfVAlue();
                $DotEnvString[] = sprintf("%s='%s'",$conf->getConfName(),$conf->getConfVAlue());
            endforeach;
            // Create the object-oriented wrapper using the configuration data
            $config = new Config($DotEnv, true);
            $writer = new PhpArray();
            file_put_contents(sprintf("%s/.env",dirname(__DIR__,4)),implode(PHP_EOL,$DotEnvString));
            file_put_contents("./config/autoload/dotenv.global.php",$writer->toString($config));
        endif;

    }
}