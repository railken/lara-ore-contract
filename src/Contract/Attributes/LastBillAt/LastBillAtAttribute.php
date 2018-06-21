<?php

namespace Railken\LaraOre\Contract\Attributes\LastBillAt;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;

class LastBillAtAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'last_bill_at';

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
        Tokens::NOT_DEFINED    => Exceptions\ContractLastBillAtNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\ContractLastBillAtNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\ContractLastBillAtNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\ContractLastBillAtNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'contract.attributes.last_bill_at.fill',
        Tokens::PERMISSION_SHOW => 'contract.attributes.last_bill_at.show',
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
        return $this->validByFormat($value, 'Y-m-d') || $this->validByFormat($value, 'Y-m-d H:i:s');
    }

    /**
     * Validate by format
     *
     * @param string $value
     * @param string $format
     *
     * @return boolean
     */
    public function validByFormat($value, string $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $value);
        return $d && $d->format($format) === $value;
    }
}
