<?php

namespace App\Enums;

enum SaleStatusEnums: string
{
    case PENDING = 'pendente';
    case PROCESSING = 'processando';
    case COMPLETED = 'completo';
    case CANCELED = 'cancelado';
}
