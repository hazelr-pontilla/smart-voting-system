<?php

namespace App\Enums;

enum Position:string
{
    case PRESIDENT = 'President';
    case VICE = 'Vice President';
    case CAAD = 'CAAD Senator';
    case COBE = 'COBE Senator';
    case CAS = 'CAS Senator';
    case COT = 'COT Senator';
    case COED = 'COED Senator';

    case BSF = 'BSF Representative';
    case BSECE = 'BSECE Representative';
    case BTVTED = 'BTVTED Representative';
    case BSES = 'BSES Representative';
    case BSIT = 'BSIT Representative';
    case BTLED = 'BTLED Representative';

}
