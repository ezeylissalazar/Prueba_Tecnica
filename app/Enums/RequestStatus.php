<?php

namespace App\Enums;

enum RequestStatus: int
{
    case Created     = 0;
    case Accepted   = 1;
    case Reject   = 2;
}
