# silverstripe-google-maps-field

A Silverstripe module that provides an input field extension for collecting postal addresses using Google Maps' Autocomplete functionality from the Places API. This extension offers users a streamlined way to enter accurate addresses by suggesting address completions directly within the input field.

## Features

- **Autocomplete**: As users type, Google Maps Autocomplete provides address suggestions.
- **Field Customization**: Easily integrates with Silverstripe’s form fields and can be customized to fit specific field requirements.
- **Real-time Address Validation**: Ensures that addresses are valid and formatted properly based on Google Maps data.

## Requirements

- Silverstripe CMS 4.x or later
- Google Maps API Key (with Places API enabled)

## Installation

1. **Install via Composer**:
   ```bash
   composer require loveduckie/silverstripe-google-maps-field
   ```

2. **Google Maps API Key**:
   Obtain an API key from the [Google Cloud Console](https://console.cloud.google.com/). Ensure that the Places API is enabled.

3. **Configuration**:
   In your Silverstripe project, add the Google Maps API key to your `.env` file:
   ```plaintext
   GOOGLE_MAPS_API_KEY="YOUR_API_KEY"
   ```

4. **Build the Project**:
   Run `dev/build` to ensure the module is loaded properly.

## Usage

1. **Add Field to Form**:
   In your form class, add the address autocomplete field as shown below:

   ```php
   use LoveDuckie\SilverStripe\GoogleMapsField;
   
   $form->addField(
       GoogleMapsAutocompleteAddressField::create('Address', 'Postal Address')
   );
   ```

2. **Customize Field Options**:
   - You can specify additional options like the country filter, address type, and more by configuring the field in the Silverstripe backend or by setting options directly in the form.

3. **Styling**:
   Customize the look and feel of the autocomplete field with CSS to match your site’s design.

## Configuration Options

Configure the following settings in your YAML configuration file:

```yaml
LoveDuckie\SilverStripe\GoogleMapsField:
  default_country: "US"  # Set the default country for address suggestions
  address_components:    # Specify which address components to retrieve
    - street_number
    - route
    - locality
    - administrative_area_level_1
    - country
    - postal_code
```

## Screenshots

TBD
<!-- ![Address Autocomplete Example](screenshots/example.png) -->

## Troubleshooting

- Ensure that the Google Maps API key has the correct permissions for the Places API.
- Verify that your Silverstripe cache is cleared after installation.
  
## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contributions

Contributions are welcome! Please submit issues or pull requests to help improve this module.

## Acknowledgments

This module utilizes the Google Maps API to deliver accurate address suggestions and facilitate seamless form input.
