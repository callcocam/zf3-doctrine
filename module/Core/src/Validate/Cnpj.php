<?php
/**
 * Created by PhpStorm.
 * User: Salao Do Reino
 * Date: 02/05/2018
 * Time: 18:04
 */

namespace Core\Validate;


/**
 * Description of Cgc
 *
 * @author Luiz Carlos
 */
class Cnpj extends CgcAbstract {

    /**
     * Tamanho do Campo
     * @var int
     */
    protected $size = 14;

    /**
     * Modificadores de Dígitos
     * @var array
     */
    protected $modifiers = [
        [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2],
        [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]
    ];

}