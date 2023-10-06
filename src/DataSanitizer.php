<?php


namespace Temir8173\Sanitizer;


use Temir8173\Sanitizer\sanitizers\ArraySanitizer;
use Temir8173\Sanitizer\sanitizers\FloatSanitizer;
use Temir8173\Sanitizer\sanitizers\IntegerSanitizer;
use Temir8173\Sanitizer\sanitizers\AbstractSanitizer;
use Temir8173\Sanitizer\sanitizers\PhoneSanitizer;
use Temir8173\Sanitizer\sanitizers\StringSanitizer;
use Temir8173\Sanitizer\sanitizers\StructureSanitizer;

class DataSanitizer
{
    private array $data = [];
    private array $errors = [];

    public function handle($data, $specification): void
    {
        // Рекурсивно обрабатываем данные
        [$this->data, $this->errors] = self::sanitizeData($data, $specification);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getNormalizedData(): array
    {
        return $this->data;
    }

    public static function sanitizeData(mixed $data, DataSpecification $specification): array
    {
        $sanitizer = self::getSanitizerByType($specification->type);
        return $sanitizer->handle($data, $specification);
    }

    public static function getSanitizerByType(DataTypesList $type): AbstractSanitizer
    {
        $sanitizerClass = match($type) {
            DataTypesList::STRING => StringSanitizer::class,
            DataTypesList::INTEGER => IntegerSanitizer::class,
            DataTypesList::FLOAT => FloatSanitizer::class,
            DataTypesList::PHONE => PhoneSanitizer::class,
            DataTypesList::ARRAY => ArraySanitizer::class,
            DataTypesList::STRUCTURE => StructureSanitizer::class
        };

        return new $sanitizerClass();
    }
}
