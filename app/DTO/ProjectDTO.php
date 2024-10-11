<?php

namespace App\DTO;

use Illuminate\Support\Arr;
use Spatie\DataTransferObject\DataTransferObject;

class ProjectDTO extends DataTransferObject
{
    public string $name = '';

    public int $userId = 1;

    public string $description = '';

    public int $sourceLanguageId = 1;

    public array $targetLanguagesIds = [];

    public bool $useMachineTranslate = false;

    public int $progress = 0;

    public function mapProjectData(array $data): array
    {
        $mappedData = [];
        $dotArray = Arr::dot($data);

        foreach ($dotArray as $key => $value) {
            if (str_contains($key, 'languages.target')) {
                $mappedData[$this->getTableName($key)][] = $value;
            } else {
                $mappedData[$this->getTableName($key)] = $value;
            }
        }

        return $mappedData;
    }

    private function getTableName(string $key)
    {
        $fields = [
            'name' => 'name',
            'description' => 'description',
            'languages.source' => 'source_language_id',
            'languages.target' => 'target_language_ids',
            'settings.useMachineTranslate' => 'use_machine_translate',
            'progress' => 'progress',
        ];

        if (str_contains($key, 'languages.target')) {
            return $fields['languages.target'];
        }

        return $fields[$key];
    }
}
