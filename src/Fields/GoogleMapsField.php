<?php

namespace LoveDuckie\SilverStripe\GoogleMapsField\Forms;

use SilverStripe\Forms\TextField;
use SilverStripe\View\Requirements;
use SilverStripe\Core\Environment;

class GooglePlacesField extends TextField
{
    public function Field($properties = [])
    {
        $apiKey = Environment::getEnv('GOOGLE_API_KEY');

        Requirements::javascript("https://maps.googleapis.com/maps/api/js?key={$apiKey}&libraries=places");
        Requirements::javascript('https://code.jquery.com/jquery-3.6.0.min.js');

        Requirements::customScript(<<<JS
        (function($) {
            $(document).ready(function() {
                var input = document.getElementById("{$this->ID()}");
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.setFields(['address_components', 'geometry']);
                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    var components = {
                        street_number: '',
                        route: '',
                        locality: '',
                        administrative_area_level_1: '',
                        postal_code: '',
                        country: ''
                    };
                    place.address_components.forEach(function(component) {
                        var types = component.types;
                        for (var i = 0; i < types.length; i++) {
                            var type = types[i];
                            if (components[type] !== undefined) {
                                components[type] = component.long_name;
                            }
                        }
                    });
                    // Combine street number and route for street address
                    var streetAddress = [components.street_number, components.route].join(' ').trim();

                    // Set the values of fields using name attributes
                    $('input[name="StreetAddress"]').val(streetAddress);
                    $('input[name="City"]').val(components.locality);
                    $('input[name="State"]').val(components.administrative_area_level_1);
                    $('input[name="PostalCode"]').val(components.postal_code);
                    $('input[name="Country"]').val(components.country);
                    if (place.geometry) {
                        $('input[name="Latitude"]').val(place.geometry.location.lat());
                        $('input[name="Longitude"]').val(place.geometry.location.lng());
                    }
                });
            });
        })(jQuery);
        JS
        );

        return parent::Field($properties);
    }
}
