<?php

namespace App\Enums;

enum AccountType: string
{
    case LTD = 'ltd';

    case Freelance = 'freelancer';

    case Individual = 'individual';
}
