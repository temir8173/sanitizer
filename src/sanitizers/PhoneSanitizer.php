<?php


namespace Temir8173\Sanitizer\sanitizers;


use Temir8173\Sanitizer\DataSpecification;

class PhoneSanitizer extends AbstractSanitizer
{
    public function handle(mixed $data, DataSpecification $specification): array
    {
        $errors = null;

        if ($error = $this->checkRequired($data, $specification->isRequired)) {
            $errors[] = $error;
            return [$data, $errors];
        }

        $pattern = '/\b\d{1}\s?\((\d{3})\)\s?(\d{3}-\d{2}-\d{2})\b/';
        if (is_string($data) && preg_match($pattern, $data, $matches)) {
            $data = '7' . $matches[1] . str_replace('-', '', $matches[2]);
        } else {
            $errors[] = 'The phone format is not valid';
        }

        return [$data, $errors];
    }
}