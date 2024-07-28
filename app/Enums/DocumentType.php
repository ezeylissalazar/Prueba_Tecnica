<?php

namespace App\Enums;

enum DocumentType: int
{
    case DNI     = 1;
    case CIF   = 2;
    case NIE   = 3;
    case PASSPORT   = 4;
    case OTHER   = 5;
}
