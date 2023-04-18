<?php

namespace App\Models\enums;

enum DeliveryStatus: string
{
    case Aangemeld = 'Aangemeld';
    case AangemeldVoorBezorging = 'Aangemeld voor bezorging';
    case Uitgeprint = 'Uitgeprint';
    case Opgehaald = 'Opgehaald';
    case SorteerCentrum = 'Sorteercentrum';
    case Onderweg = 'Onderweg';
    case Afgeleverd = 'Afgeleverd';
}
