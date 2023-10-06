<?php


namespace Temir8173\Sanitizer\sanitizers;


use Temir8173\Sanitizer\DataSanitizer;
use Temir8173\Sanitizer\DataSpecification;

class StructureSanitizer extends AbstractSanitizer
{
    public function handle(mixed $data, DataSpecification $specification): array
    {
        $errors = null;

        // Перебираем ключи и значения спецификации
        foreach ($specification->fields as $field => $fieldSpecification) {
            // Рекурсивно обрабатываем значение
            [$data[$field], $errors[$field]] = DataSanitizer::sanitizeData(
                $data[$field] ?? null,
                $fieldSpecification
            );
        }

        return [$data, $errors];
    }

}
