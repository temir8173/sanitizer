<?php


namespace Temir8173\Sanitizer;


/**
 * @property DataSpecification[] $fields
*/
class DataSpecification
{
    public function __construct(
        public readonly DataTypesList $type,
        public readonly bool $isRequired,
        public readonly array $fields = [],
        public readonly DataTypesList|null $arrayItemsType = null,
    ) {}
}
