<?php

namespace Amethyst\Schemas;

use Amethyst\Attributes as AmethystAttributes;
use Amethyst\Managers\ContractManager;
use Amethyst\Managers\ProductManager;
use Illuminate\Support\Facades\Config;
use Railken\Lem\Attributes;
use Railken\Lem\Schema;

class ContractProductSchema extends Schema
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_STARTED = 'started';
    public const STATUS_SUSPENDED = 'suspended';
    public const STATUS_TERMINATED = 'terminated';

    /**
     * Get all the attributes.
     *
     * @var array
     */
    public function getAttributes()
    {
        return [
            Attributes\IdAttribute::make(),
            Attributes\BelongsToAttribute::make('contract_id')
                ->setRelationName('contract')
                ->setRelationManager(ContractManager::class)
                ->setRequired(true),
            Attributes\BelongsToAttribute::make('product_id')
                ->setRelationName('product')
                ->setRelationManager(ProductManager::class)
                ->setRequired(true),
            AmethystAttributes\TaxonomyAttribute::make('group_id', Config::get('amethyst.contract.data.contract-product.group-taxonomy'))
                ->setRelationName('group')
                ->setRequired(true),
            Attributes\EnumAttribute::make('status', [
                static::STATUS_PENDING,
                static::STATUS_STARTED,
                static::STATUS_SUSPENDED,
                static::STATUS_TERMINATED,
            ]),
            Attributes\DateTimeAttribute::make('started_at'),
            Attributes\DateTimeAttribute::make('suspended_at'),
            Attributes\DateTimeAttribute::make('terminated_at'),
            Attributes\CreatedAtAttribute::make(),
            Attributes\UpdatedAtAttribute::make(),
            Attributes\DeletedAtAttribute::make(),
        ];
    }
}
