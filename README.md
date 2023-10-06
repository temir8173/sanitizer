```

use Temir8173\Sanitizer\DataSanitizer;
use Temir8173\Sanitizer\DataSpecification;
use Temir8173\Sanitizer\DataTypesList;


$jsonData = '{
    "foo": "123.asd",
    "bar": "asd",
    "baz": "8 (707) 288-56-23",
    "arrayField": {"phone1": "8 (707) 288-56-23 123.asd"}
}';
$data = json_decode($jsonData, true);

// Спецификация для данных
$specification = new DataSpecification(
    DataTypesList::STRUCTURE,
    true,
    [
        'foo' => new DataSpecification(DataTypesList::INTEGER, true),
        'bar' => new DataSpecification(DataTypesList::STRING, true),
        'baz' => new DataSpecification(DataTypesList::PHONE, true),
        'arrayField' => new DataSpecification(DataTypesList::ARRAY, true, arrayItemsType: DataTypesList::PHONE),
        'nestedStructure' => new DataSpecification(DataTypesList::STRUCTURE, true, [
            'field1' => new DataSpecification(DataTypesList::INTEGER, true),
            'field2' => new DataSpecification(DataTypesList::INTEGER, true),
        ])
    ]
);

$sanitizer = new DataSanitizer();
$sanitizer->handle($data, $specification);

echo '<pre>';
print_r($data);
print_r($sanitizer->getNormalizedData());
print_r($sanitizer->getErrors());
```