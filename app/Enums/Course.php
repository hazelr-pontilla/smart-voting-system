<?php

namespace App\Enums;

enum Course:string
{
    case BSAR = 'BS Architecture';
    case BSID = 'BS Interior Design';

    //arts and sciences
    case BSEL = 'BS English Language';
    case BSMATH = 'BS Mathematics';
    case BSES = 'BS Environmental Science';
    case BSCHEM = 'BS Chemistry';
    case BSSTAT = 'BS Statistics';

    //business and entrep
    case BSE = 'BS Entrepreneurship';
    case BSOA = 'BS Office Administrator';
    case BSA = 'BS Accountancy';
    case BSM = 'BS Marketing';

    //engineering
    case BSCHE = 'BS Chemical Engineering';
    case BSCE = 'BS Civil Engineering';
    case BSEE = 'BS Electrical Engineering';
    case BSECE = 'BS Electronics Engineering';
    case BSGE = 'BS Geodetic Engineering';
    case BSME = 'BS Mechanical Engineering';
    case BSIE = 'BS Industrial Engineering';
    case BSIT = 'BS Information Technology';

    //technology
    case BSHM = 'BS Hospitality Management';
    case BSND = 'BS Nutrition & Diabetics';

}
