<?php

namespace Railken\LaraOre\Contract\Attributes\Renewals;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;

class RenewalsAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'renewals';

    /**
     * Is the attribute required
     * This will throw not_defined exception for non defined value and non existent model.
     *
     * @var bool
     */
    protected $required = false;

    /**
     * Is the attribute unique.
     *
     * @var bool
     */
    protected $unique = false;

    /**
     * List of all exceptions used in validation.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_DEFINED    => Exceptions\ContractRenewalsNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\ContractRenewalsNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\ContractRenewalsNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\ContractRenewalsNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'contract.attributes.renewals.fill',
        Tokens::PERMISSION_SHOW => 'contract.attributes.renewals.show',
    ];

    /**
     * Is a value valid ?
     *
     * @param EntityContract $entity
     * @param mixed          $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        return v::length(1, 255)->validate($value);
    }
}
