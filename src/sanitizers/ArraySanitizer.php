<?php


namespace Temir8173\Sanitizer\sanitizers;


use Temir8173\Sanitizer\DataSanitizer;
use Temir8173\Sanitizer\DataSpecification;

class ArraySanitizer extends AbstractSanitizer
{
    public function handle(mixed $data, DataSpecification $specification): array
    {
        $errors = null;

        if ($error = $this->checkRequired($data, $specification->isRequired)) {
            $errors[] = $error;
            return [$data, $errors];
        }

        if (!is_array($data)) {
            $errors[] = 'The field must be an array';
            return [$data, $errors];
        }

        $itemsType = $specification->arrayItemsType;
        if (!$itemsType) {
            $errors[] = 'Specify the items type';
            return [$data, $errors];
        }

        $itemsSpecification = new DataSpecification($itemsType, true);
        // Рекурсивно обрабатываем каждый элемент массива
        foreach ($data as $key => $value) {
            [$data[$key], $errors[$key]] = DataSanitizer::sanitizeData($value, $itemsSpecification);
        }

        return [$data, $errors];
    }
}