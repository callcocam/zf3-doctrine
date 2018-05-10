<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Auth\Adapter;

use Admin\Entity\UserEntity;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Authentication\Adapter\ObjectRepository;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;

class Authentication
{
    /**
     * @var AuthenticationService $authenticate
     */
    protected $authenticate;
    protected $result;
    protected $storage;
    protected $type = FlashMessenger::NAMESPACE_ERROR;
    const SUCCESS = 1;
    const FAILURE = 0;
    const FAILURE_IDENTITY_NOT_FOUND = -1;
    const FAILURE_IDENTITY_AMBIGUOUS = -2;
    const FAILURE_CREDENTIAL_INVALID = -3;
    const FAILURE_UNCATEGORIZED = -4;

    /**
     * @var EntityManager
     */
    private $entityManager;
    protected $adapter;

    public function __construct(EntityManager $entityManager)
    {
        $this->storage = new AuthStorage(__NAMESPACE__);
        $this->entityManager = $entityManager;
    }

    public function login(string $identity, string $credential)
    {
        $this->adapter = new ObjectRepository([
                'object_manager' => $this->entityManager,
                'identity_class' => 'Admin\Entity\UserEntity',
                'identity_property' => 'document',
                'credential_property' => 'password'
            ]

        );
        $this->adapter->setIdentity($identity);
        $this->adapter->setCredential($credential);
        $this->result = $this->adapter->authenticate();
        return $this->result;
    }



    public function getResult()
    {
        switch ($this->result->getCode()) {

            case self::FAILURE_IDENTITY_NOT_FOUND:
                $this->type = FlashMessenger::NAMESPACE_WARNING;
                /** do stuff for nonexistent identity **/
                return "Sua identidade não foi encontrada, inexistente";
                break;

            case self::FAILURE_CREDENTIAL_INVALID:
                $this->type = FlashMessenger::NAMESPACE_INFO;
                /** do stuff for invalid credential **/
                return "Credenciais inválidas, não foi encontrada, inexistente";
                break;

            case self::SUCCESS:
                $this->type = FlashMessenger::NAMESPACE_SUCCESS;
                /** do stuff for successful authentication **/
                return "Autenticação bem-sucedida, credenciais verificadas com sucesso!";
                break;

            default:
                $this->type = FlashMessenger::NAMESPACE_ERROR;
                /** do stuff for other failure **/
                return "Autenticação falhou, se você ja e cadastrado tente mais tarde";
                break;
        }
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @return AuthStorage
     */
    public function setStorage(): Authentication
    {
        /**
         * @var  $identity UserEntity
         */
        $identity = $this->result->getIdentity();
        if($identity):
            $this->getStorage()->write([
                'id' => $identity->getId(),
                'name' => sprintf("%s %s",$identity->getFirstName(),$identity->getLastName()),
                'first_name' => $identity->getFirstName(),
                'last_name' => $identity->getLastName(),
                'empresa' => $identity->getEmpresa(),
                'email' => $identity->getEmail(),
                'document' => $identity->getDocument(),
                'phone' => $identity->getPhone(),
                'street' => $identity->getStreet(),
                'number' => $identity->getNumber(),
                'complement' => $identity->getComplement(),
                'district' => $identity->getDistrict(),
                'zip' => $identity->getZip(),
                'city' => $identity->getCity(),
                'state' => $identity->getState(),
                'cover' => $identity->getCover(),
                'access' => $identity->getAccess(),
            ]);
        endif;
        return $this;
    }

    /**
     * @return AuthStorage
     */
    public function getStorage(): AuthStorage
    {
        return $this->storage;

    }

    public function read(){
        return $this->storage->read();
    }

    public function logout(){
        $this->storage->forgetMe();
        $this->storage->clear();
    }
}