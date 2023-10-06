<?php


namespace Temir8173\Sanitizer\sanitizers;


use Temir8173\Sanitizer\DataSpecification;

class IntegerSanitizer extends AbstractSanitizer
{
    public function handle(mixed $data, DataSpecification $specification): array
    {
        $errors = null;

        if ($error = $this->checkRequired($data, $specification->isRequired)) {
            $errors[] = $error;
            return [$data, $errors];
        }

        if (is_numeric($data)) {
            $data = (int)$data;
        } else {
            $errors[] = 'The field must be an numeric';
        }

        return [$data, $errors];
    }
}