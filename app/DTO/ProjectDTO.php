<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ProjectDTO extends DataTransferObject
{
    public string $name = '';
    public string $description = '';
    public int $sourceLanguageId = 1;
    public array $targetLanguagesIds = [];
    public bool $useMachineTranslate = false;
}
