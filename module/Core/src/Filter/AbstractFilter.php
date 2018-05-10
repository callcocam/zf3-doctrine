<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 18/03/2018
 * Time: 16:35
 */

namespace Core\Filter;


use Core\Validate\NoObjectExists;
use DoctrineModule\Validator\ObjectExists;
use Interop\Container\ContainerInterface;
use Zend\Filter\File\RenameUpload;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\FileInput;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Db\NoRecordExists;
use Zend\Validator\Db\RecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\File\MimeType;
use Zend\Validator\File\Size;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

abstract class AbstractFilter implements FilterInterface
{
    const FILE = 'file';


    /**
     * @var InputFilter
     */
    protected $inputFilter;
    /**
     * @var ContainerInterface
     */
    protected $container;
    protected $basePath;
    protected $ds = DIRECTORY_SEPARATOR;
    protected $send;
    protected $data =[];
    protected $result;

    public function setData($data){
        $this->data = $data;
    }
    public function getInputFilter(){
        ########################### status ####################
        $this->inputFilter->add([
            'name'=>'status',
            'required'=>false,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->StringLength('Status')
            ]
        ]);
        ########################### id ####################
        $this->inputFilter->add([
            'name'=>'id',
            'required'=>false,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->StringLength('Id')
            ]
        ]);
        ########################### id ####################
        $this->inputFilter->add([
            'name'=>'empresa',
            'required'=>false,
            'filters'=>$this->filters(),
            'validators'=>[
                $this->StringLength('Empresa'),
            ]
        ]);

        $this->inputFilter->setData($this->data);
        return $this->inputFilter;
    }

    protected function filters(){

        return [

            [
                'name'=>StringTrim::class,
            ],
            [
                'name'=>StripTags::class
            ]

        ];
    }

    public function StringLength($name, $max=255,$min=1){
        return[
            'name' => StringLength::class,
            'options' => [
                'max' => $max,
                'min' => $min,
                'messages' => [
                    StringLength::TOO_SHORT => "Campo [{$name}] Muito Curto",
                    StringLength::TOO_LONG => "Campo [{$name}] Muito Longo",
                ],
            ],
        ];
    }

    protected function NotEmpty($name){
        return [
            'name' => NotEmpty::class,
            'options' => [
                'messages' => [NotEmpty::IS_EMPTY => "Campo [{$name}] Obrigatorio"],
            ],
        ];
    }
    protected function EmailValitator($name){
        return [
            'name' => EmailAddress::class,
            'options' => [
                'messages' => [
                    EmailAddress::INVALID => "Campo [{$name}] E invalido",
                    EmailAddress::INVALID_FORMAT => "Campo [{$name}] Esta num formato invalido",
                    EmailAddress::INVALID_HOSTNAME => "Campo [{$name}] o host name e invalido",
                ],
            ],
        ];
    }

    public function getInputFilterSpecification($Entity,$field,$campo="Email")
    {
        $entityManager = $this->container->get('doctrine.entitymanager.orm_default');
        return [
            'name' => NoObjectExists::class,
            'options' => [
                'object_repository' => $entityManager->getRepository($Entity),
                'fields' => $field,
                'messages' => [
                    'objectFound' =>  "{$campo} Ja Existe!",
                ]
            ],
        ];
    }


    protected function NoRecordExists($Entity,$field="email",$campo="Email"){

        $entityManager = $this->container->get('doctrine.entitymanager.orm_default');
        return [
            'name' => NoObjectExists::class,
            'options' => [
                'object_repository' => $entityManager->getRepository($Entity),
                'fields' => $field,
                'messages' => [
                    'objectFound' =>  "{$campo} Ja Existe!",
                ]
            ],
        ];

    }

    protected function RecordExists($Entity="users",$field="email",$campo="Email"){

        $entityManager = $this->container->get('doctrine.entitymanager.orm_default');
        return [
            'name' => ObjectExists::class,
            'options' => [
                'object_repository' => $entityManager->getRepository($Entity),
                'fields' => $field,
                'messages' => [
                    ObjectExists::ERROR_NO_OBJECT_FOUND =>  "{$campo} Não Existe!",
                ]
            ],
        ];
    }

    // This method creates input filter (used for form filtering/validation).
    protected function ImageFilter($name='files')
    {
        // Add validation rules for the "file" field.
        $input = new FileInput($name);
        $input->getValidatorChain()->attach(new Size(
                [
                    'max' => "5000MB",
                    'messageTemplates' => [
                        Size::TOO_BIG => 'O arquivo fornecido é maior que o tamanho de arquivo permitido',
                        Size::TOO_SMALL => 'O arquivo fornecido é muito pequeno',
                        Size::NOT_FOUND => 'O arquivo não pode ser encontrado']
                ]
            )
        );
        $mimetype = new MimeType();
        $mimetype->setMessages(array(
            MimeType::FALSE_TYPE => 'Este arquivo não é um tipo permitido',
            MimeType::NOT_DETECTED => 'O tipo de arquivo não foi detectado',
            MimeType::NOT_READABLE => 'O tipo de arquivo não era legível',
        ));
        $mimetype->setMimeType($this->getMimiType());
        //$input->getValidatorChain()->attach($mimetype);
        $renameUpload = new RenameUpload([
            'useUploadName'=>true,
            'useUploadExtension'=>true,
            'overwrite'=>true,
            'randomize'=>true,
            'target' => $this->getBasePath()
        ]);
        $input->getFilterChain()->attach($renameUpload);
    }

    // This method creates input filter (used for form filtering/validation).
    protected function FileFilter($name='file')
    {
        // Add validation rules for the "file" field.
        $input = new FileInput($name);
        $input->getValidatorChain()->attach(new Size(
                [
                    'max' => "5000MB",
                    'messageTemplates' => [
                        Size::TOO_BIG => 'O arquivo fornecido é maior que o tamanho de arquivo permitido',
                        Size::TOO_SMALL => 'O arquivo fornecido é muito pequeno',
                        Size::NOT_FOUND => 'O arquivo não pode ser encontrado']
                ]
            )
        );
        $mimetype = new MimeType();
        $mimetype->setMessages(array(
            MimeType::FALSE_TYPE => 'Este arquivo não é um tipo permitido',
            MimeType::NOT_DETECTED => 'O tipo de arquivo não foi detectado',
            MimeType::NOT_READABLE => 'O tipo de arquivo não era legível',
        ));
        $mimetype->setMimeType($this->getMimiType());
        //$input->getValidatorChain()->attach($mimetype);
        $renameUpload = new RenameUpload([
            'useUploadName'=>true,
            'useUploadExtension'=>true,
            'overwrite'=>true,
            'randomize'=>false,
            'target' => $this->getBasePath()
        ]);
        $input->getFilterChain()->attach($renameUpload);

        return $input;
    }

    protected function getMimiType($Types =null){
        $MimiType = [];
        $Config = $this->container->get("Config");
        $mime_types_custom = $Config['mime_types_custom'];
        $mime_types = $Config['mime_types'];
        if(!$Types){
            return $mime_types;
        }
        if (isset($mime_types_custom[$Types])):
            foreach ($mime_types_custom[$Types] as $type):
                $MimiType[] = $mime_types[$type];
            endforeach;
        endif;
        return $mime_types;
    }

//Verifica e cria os diretórios com base em tipo de arquivo, ano e mês!
    public function CheckFolder($Type, $Folder)
    {
        list($y, $m) = explode('/', date('Y/m'));
        $this->basePath = $this->CreateFolder("dist");
        $this->basePath = $this->CreateFolder("uploads");
        $this->basePath = $this->CreateFolder($Type);
        $this->basePath = $this->CreateFolder($Folder);
        $this->basePath = $this->CreateFolder($y);
        $this->basePath = $this->CreateFolder($m);
        $this->send = "{$this->ds}dist{$this->ds}uploads{$this->ds}{$Type}{$this->ds}{$Folder}{$this->ds}{$y}{$this->ds}{$m}{$this->ds}";
        return $this->basePath;
    }


    /**
     * Verifica e cria o diretório base!
     * @param $Folder
     * @return
     */
    public function CreateFolder($Folder)
    {
        if (!file_exists("{$this->basePath}{$this->ds}{$Folder}") && !is_dir("{$this->basePath}{$this->ds}{$Folder}")):
            mkdir("{$this->basePath}{$this->ds}{$Folder}", 0777);
        endif;
        return "{$this->basePath}{$this->ds}{$Folder}{$this->ds}";
    }

    /**
     * @return mixed
     */
    public function getBasePath()
    {

        return $this->basePath;
    }

    /**
     * @param mixed $basePath
     *
     * @return ImagesFilter
     */
    public function setBasePath($Type, $controller)
    {
        $this->basePath = $this->container->get('request')->getServer('DOCUMENT_ROOT');
        $this->basePath = $this->CheckFolder($Type, $controller);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSend()
    {
        return $this->send;
    }


    //Verifica e monta o nome dos arquivos tratando a string!
    public function setFileName($Name)
    {
        $FileName = $this->setName(substr($Name, 0, strrpos($Name, '.')));
        return sprintf("%s%s%s", date("YmdHis"), strtolower($FileName), strrchr($Name, '.'));
    }


    /**
     * @param $Name
     * @return null|string|string[]
     */
    public function setName($Name)
    {
        $var = strtolower(utf8_encode($Name));
        return preg_replace('{\W}', '', preg_replace('{ +}', '_', strtr(
            utf8_decode(html_entity_decode($var)), utf8_decode('ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ'), 'AAAAEEIOOOUUCNaaaaeeiooouucn')));
    }

    public function getFormMessages( $Msgs )
    {
        if ($Msgs):
            $ArayMsg = [];
            foreach ($Msgs as $msg) {
                $ArayMsg[] = array_pop($msg);
            }
            return str_replace("'", "-", implode(PHP_EOL, $ArayMsg));
        endif;
        return "Nenhuma informação disponivel";
    }

}