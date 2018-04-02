#Instalação e configuração

Rode o comando 

´´´

``
composer install
``

Criar as pasta dentro do diretorio data na raiz do seu projeto:

```

data/cache

data/Migrations

data/logs

```
Crie um arquivo  com o seguinte nome na pasta config/autoload:<br>

``
doctrine_orm.local.php
``

Para configuração da conexão authenticação e  migrations
com o conteudo: 
```
<?php
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'sua base de dados'
                    'driverOptions' => [
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ]
            ]
        ],
        'migrations_configuration' => [
            'orm_default' => [
                'directory' => 'data/Migrations',
                'name'      => 'Doctrine Database Migrations',
                'namespace' => 'Migrations',
                'table'     => 'migrations',
            ],
        ],
        'authentication' => [
            'orm_default' => [
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Admin\Entity\UserEntity',
                'identity_property' => 'email',
                'credential_property' => 'password',
            ],
        ],
    ],
];
```

Em seguida rode os comandos:

```
diff-db
```
E
```
migrate-db
```
e por fim rode o segunte comando

```
vendor/bin/doctrine-module data-fixture:import
```

Na pasta public_html inicio um serviço com o comando

``
php -S localhost:8585 ou outra port de sua preferencia
``

Abra o navegador e acesso o host localhost:8585