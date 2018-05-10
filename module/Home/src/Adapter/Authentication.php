<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Home\Adapter;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Authentication\Adapter\ObjectRepository;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;

class Authentication
{


    protected $storage;
    protected $result;
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
                'identity_class' => 'Sisc\Entity\ClientEntity',
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
        if($this->result->getIdentity()):
            $this->storage->write([
                'id' => $this->result->getIdentity()->getId(),
                'name' => $this->result->getIdentity()->getName(),
                'empresa' => $this->result->getIdentity()->getEmpresa(),
                'email' => $this->result->getIdentity()->getEmail(),
                'document' => $this->result->getIdentity()->getDocument(),
                'phone' => $this->result->getIdentity()->getPhone(),
                'street' => $this->result->getIdentity()->getStreet(),
                'number' => $this->result->getIdentity()->getNumber(),
                'complement' => $this->result->getIdentity()->getComplement(),
                'district' => $this->result->getIdentity()->getDistrict(),
                'zip' => $this->result->getIdentity()->getZip(),
                'city' => $this->result->getIdentity()->getCity(),
                'state' => $this->result->getIdentity()->getState(),
                'state' => $this->result->getIdentity()->getState(),
                'cover' => $this->result->getIdentity()->getCover()
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

    public function logout(){
        $this->storage->forgetMe();
        $this->storage->clear();
    }

}