<?php


namespace Temir8173\Sanitizer\sanitizers;


use Temir8173\Sanitizer\DataSpecification;

class StringSanitizer extends AbstractSanitizer
{
    public function handle(mixed $data, DataSpecification $specification): array
    {
        $errors = null;

        if ($error = $this->checkRequired($data, $specification->isRequired)) {
            $errors[] = $error;
            return [$data, $errors];
        }

        if (!is_string($data)) {
            $errors[] = 'The field must be string';
        }

        return [$data, $errors];
    }
}