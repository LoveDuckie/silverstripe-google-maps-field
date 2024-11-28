<?php

namespace LoveDuckie\SilverStripe\GoogleMapsField\Models;

use SilverStripe\ORM\DataObject;

class GoogleMapsLocation extends DataObject
{
    private static $table_name = 'GoogleMapsLocation';

    private static $db = [
        'Name' => 'Varchar(255)', // The name of the place or venue
        'StreetAddress' => 'Varchar(255)',
        'City' => 'Varchar(100)',
        'State' => 'Varchar(100)',
        'PostalCode' => 'Varchar(20)',
        'Country' => 'Varchar(100)',
        'Latitude' => 'Decimal(9,6)',
        'Longitude' => 'Decimal(9,6)',
    ];

    private static $summary_fields = [
        'Name' => 'Name',
        'StreetAddress' => 'Street Address',
        'City' => 'City',
        'Country' => 'Country',
    ];

    public function getTitle()
    {
        return $this->Name ?: $this->StreetAddress;
    }
}
