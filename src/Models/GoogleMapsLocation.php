<?php

namespace LoveDuckie\SilverStripe\GoogleMapsField\Models;

use LoveDuckie\SilverStripe\GoogleMapsField\Fields\GoogleMapsPlacesField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

class GoogleMapsLocation extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'GoogleMapsLocation';

    /**
     * @var array|string[]
     */
    private static array $db = [
        'Name' => 'Varchar(255)', // The name of the place or venue
        'StreetAddress' => 'Varchar(255)',
        'City' => 'Varchar(100)',
        'State' => 'Varchar(100)',
        'PostalCode' => 'Varchar(20)',
        'Country' => 'Varchar(100)',
        'Latitude' => 'Decimal(9,6)',
        'Longitude' => 'Decimal(9,6)',
    ];

    /**
     * @var array|string[]
     */
    private static array $summary_fields = [
        'Name' => 'Name',
        'StreetAddress' => 'Street Address',
        'City' => 'City',
        'Country' => 'Country',
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = FieldList::create();

        // Add the GooglePlacesField for place autocomplete
        $fields->addFieldToTab('Root.Main', GoogleMapsPlacesField::create('Name', 'Search for Location'));

        // Add fields for address components
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('StreetAddress'),
            TextField::create('City'),
            TextField::create('State'),
            TextField::create('PostalCode'),
            TextField::create('Country'),
            HiddenField::create('Latitude'),
            HiddenField::create('Longitude'),
        ]);

        return $fields;
    }

    public function getTitle(): mixed
    {
        return $this->Name ?: $this->StreetAddress;
    }
}
