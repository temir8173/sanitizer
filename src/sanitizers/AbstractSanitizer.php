<?php


namespace Temir8173\Sanitizer\sanitizers;


use Temir8173\Sanitizer\DataSpecification;

abstract class AbstractSanitizer
{
    public abstract function handle(mixed $data, DataSpecification $specification): array;

    public function checkRequired(mixed $data, bool $isRequired): ?string
    {
        $error = null;
        if ($isRequired && !$data) {
            $error = 'Fill the required parameter';
        }

        return $error;
    }
}
