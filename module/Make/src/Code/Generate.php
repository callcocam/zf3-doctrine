<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 21/03/2018
 * Time: 19:58
 */

namespace Make\Code;


use Zend\Config\Config;
use Zend\Config\Writer\PhpArray;
use Zend\Debug\Debug;

class Generate
{

    protected $aFind = [];
    protected $aSub = [];
    protected $Default = [
        "S_Name" => '',
        "S_Demo" => '',
        "S_route" => '',
        "S_controller" => '',
    ];
    private $data;

    public function __construct($data)
    {
        $this->Default = [
            "S_Name" => $this->filteredName($data['controller']),
            "S_Demo" => $this->filteredName($data['alias']),
            "S_route" => $data['route'],
            "S_controller" => $data['controller'],
        ];
        $this->newName = $data['controller'];
        $this->data = $data;
    }

    public function copiar_diretorio($destine, $directory = "./data/Demo", $ver_acao = true)
    {
        $this->aFind = array_keys($this->Default);
        $this->aSub = array_values($this->Default);
        $Cried[] = "Modulo Gerado Com Sucesso";
        if ($destine{strlen($destine) - 1} == '/') {
            $destine = substr($destine, 0, -1);
        }
        if (!is_dir($destine)) {
            if ($ver_acao) {
                $Cried[] = "Criando diretorio {$destine}\n";
            }
            mkdir($destine, 0755);
        }
        $folder = opendir($directory);

        while ($item = readdir($folder)) {

            if ($item == '.' || $item == '..') {
                continue;
            }
            if (is_dir($this->getDirectory($directory, $item))) {
                $this->copiar_diretorio($this->getDestine($destine, $item), $this->getDirectory($directory, $item), $ver_acao);
            } else {
                if (!empty($this->newName)):
                    if (!file_exists($this->getDestine($destine, $item))):
                        if ($ver_acao) {
                            $Cried[] = "Copiando {$item} para {$destine}/{$item}" . "\n";
                        }
                        Debug::dump($this->copyemz($this->getDirectory($directory, $item), $this->getDestine($destine, $item)));
                    endif;
                endif;
            }
        }
        if (file_exists("./module/{$this->filteredName($this->data['alias'])}/config/module.demo.php")) {
            unlink("./module/{$this->filteredName($this->data['alias'])}/config/module.demo.php");
        }

        if (!file_exists("./module/{$this->filteredName($this->data['alias'])}/src/Module.php")) {
            Debug::dump($this->copyemz("./module/{$this->filteredName($this->data['alias'])}/src/_Module.php", "./module/{$this->filteredName($this->data['alias'])}/src/Module.php"));
         }
        if (file_exists("./module/{$this->filteredName($this->data['alias'])}/src/_Module.php")) {
            unlink("./module/{$this->filteredName($this->data['alias'])}/src/_Module.php");
        }
        return implode("", $Cried);
    }

    public function generate_service_controller($Alias)
    {
        $Controller = [];
        $Services = [];
        $Form = [];
        $Filter = [];
        $Table = [];
        if ($this->data['alias'] == 'Admin'):
            $Controller["Admin\Controller\Admin"] = "Admin\Controller\Factory\FactoryController";
        endif;
        if ($this->data['alias'] == 'Home'):
            $Controller["Home\Controller\Start"] = "Home\Controller\Factory\FactoryController";
        endif;
        foreach ($Alias as $alia):
            $Controller[sprintf("%s\Controller\%s", $this->filteredName($alia->getAlias()), $this->filteredName($alia->getController()))] = sprintf("\%s\Controller\Factory\FactoryController", $this->filteredName($alia->getAlias()));
            $Services[sprintf("%s\Service\%sService", $this->filteredName($alia->getAlias()), $this->filteredName($alia->getController()))] = sprintf("\%s\Service\Factory\FactoryService", $this->filteredName($alia->getAlias()));
            $Form[sprintf("%s\Form\%sForm", $this->filteredName($alia->getAlias()), $this->filteredName($alia->getController()))] = sprintf("\%s\Form\Factory\FactoryForm", $this->filteredName($alia->getAlias()));
            $Filter[sprintf("%s\Filter\%sFilter", $this->filteredName($alia->getAlias()), $this->filteredName($alia->getController()))] = sprintf("\%s\Filter\Factory\FactoryFilter", $this->filteredName($alia->getAlias()));
            $Table[sprintf("%s\Table\%sTable", $this->filteredName($alia->getAlias()), $this->filteredName($alia->getController()))] = sprintf("\%s\Table\Factory\FactoryTable", $this->filteredName($alia->getAlias()));
        endforeach;
        $writer = new PhpArray();
        $configController = new Config($Controller);
        $configServices = new Config(['session_manager' => $Services]);
        $configForm = new Config(['session_manager' => $Form]);
        $configFilter = new Config(['session_manager' => $Filter]);
        $configTable = new Config(['session_manager' => $Table]);

        file_put_contents("./module/{$this->data['alias']}/config/controller.service.php", $writer->toString($configController));
        file_put_contents("./config/autoload/filter.global.php", $writer->toString($configFilter));
        file_put_contents("./config/autoload/form.global.php", $writer->toString($configForm));
        file_put_contents("./config/autoload/table.global.php", $writer->toString($configTable));
        file_put_contents("./config/autoload/service.global.php", $writer->toString($configServices));


    }


    private function copyemz($file1, $file2)
    {
        $contentx = str_replace($this->aFind, $this->aSub, @file_get_contents($file1));
        $openedfile = fopen($file2, "w");
        fwrite($openedfile, $contentx);
        fclose($openedfile);
        if ($contentx === FALSE) {
            $status = false;
        } else $status = true;

        return $file2;
    }

    /**
     * @param $directory
     * @param $item
     * @return string
     */
    public function getDirectory($directory, $item)
    {
        return sprintf("%s/%s", $directory, $item);
    }


    /**
     * @param $destine
     * @param $item
     * @return string
     */
    public function getDestine($destine, $item)
    {
        $itemDest = str_replace(["Demo", "demo", "s_name"], [$this->filteredName($this->newName), strtolower($this->data['alias']), strtolower($this->newName)], $item);
        return sprintf("%s/%s", $destine, $itemDest);
    }

    /**
     * Processo de tratamento para o mecanismo MVC
     * @param string $input String que será convertida
     * @return string           String convertida
     */
    public function filteredName(string $input): string
    {
//        $input = explode('?', $input);
//        $input = $input[0];
        $find = [
            '-',
            '_'
        ];
        $replace = [
            ' ',
            ' '
        ];
        return str_replace(' ', '', ucwords(str_replace($find, $replace, $input)));
    }

    public function filteredFileName(string $input): string
    {
        $input = trim($input);
        //Remove " caso exista
        $new = str_replace('&#34;', '', $input);
        $find = [
            '  ',
            '"',
            'á',
            'ã',
            'à',
            'â',
            'ª',
            'é',
            'è',
            'ê',
            'ë',
            'í',
            'ì',
            'î',
            'ï',
            'ó',
            'ò',
            'õ',
            'ô',
            '°',
            'º',
            'ö',
            'ú',
            'ù',
            'û',
            'ü',
            'ç',
            'ñ',
            'Á',
            'Ã',
            'À',
            'Â',
            'É',
            'È',
            'Ê',
            'Ë',
            'Í',
            'Ì',
            'Î',
            'Ï',
            'Ó',
            'Ò',
            'Õ',
            'Ô',
            'Ö',
            'Ú',
            'Ù',
            'Û',
            'Ü',
            'Ç',
            'Ñ',
        ];
        $replace = [
            '',
            '',
            'a',
            'a',
            'a',
            'a',
            'a',
            'e',
            'e',
            'e',
            'e',
            'i',
            'i',
            'i',
            'i',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'u',
            'u',
            'u',
            'u',
            'c',
            'n',
            'A',
            'A',
            'A',
            'A',
            'E',
            'E',
            'E',
            'E',
            'I',
            'I',
            'I',
            'I',
            'O',
            'O',
            'O',
            'O',
            'O',
            'U',
            'U',
            'U',
            'U',
            'C',
            'N',
        ];
        return strtolower(str_replace(' ', '_', str_replace($find, $replace, $new)));
    }

}