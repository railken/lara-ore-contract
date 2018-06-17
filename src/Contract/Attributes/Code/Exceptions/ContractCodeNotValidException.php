<?php

namespace Railken\LaraOre\Contract\Attributes\Code\Exceptions;

use Railken\LaraOre\Contract\Exceptions\ContractAttributeException;

class ContractCodeNotValidException extends ContractAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'code';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'CONTRACT_CODE_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}