<?php

namespace App\Enums;

enum DocumentStatusType: string
{
    case CREATED = 'created';

    case INPROGRESS = 'in progress';

    case COMPLETED = 'completed';
}


