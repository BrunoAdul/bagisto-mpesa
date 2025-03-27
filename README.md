# M-Pesa Payment Gateway for Bagisto

This package provides M-Pesa payment integration for Bagisto e-commerce platform.

## Installation

1. Add the package to your Bagisto installation:

```bash
composer require bruno/mpesa
```

2. Register the service provider in `config/app.php`:

```php
'providers' => [
    // Other service providers...
    Bruno\Mpesa\Providers\MpesaServiceProvider::class,
],
```

3. Publish the package assets:

```bash
php artisan vendor:publish --provider="Bruno\Mpesa\Providers\MpesaServiceProvider" --tag=mpesa-assets
php artisan vendor:publish --provider="Bruno\Mpesa\Providers\MpesaServiceProvider" --tag=mpesa-config
```

4. Clear the cache:

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Configuration

### Environment Variables

Add the following environment variables to your `.env` file:

```
# M-Pesa Configuration
MPESA_SANDBOX=true
MPESA_BUSINESS_SHORTCODE=174379
MPESA_CONSUMER_KEY=your_consumer_key
MPESA_CONSUMER_SECRET=your_consumer_secret
MPESA_PASSKEY=your_passkey
MPESA_INITIATOR_NAME=your_initiator_name
MPESA_INITIATOR_PASSWORD=your_initiator_password
```

### Sandbox Testing

For sandbox testing, you can use the following credentials:

- Business Shortcode: 174379
- Consumer Key: Get from Safaricom Developer Portal
- Consumer Secret: Get from Safaricom Developer Portal
- Passkey: Get from Safaricom Developer Portal

### Production Configuration

For production, update your `.env` file with your production credentials:

```
MPESA_SANDBOX=false
MPESA_BUSINESS_SHORTCODE=your_production_shortcode
MPESA_CONSUMER_KEY=your_production_consumer_key
MPESA_CONSUMER_SECRET=your_production_consumer_secret
MPESA_PASSKEY=your_production_passkey
MPESA_INITIATOR_NAME=your_production_initiator_name
MPESA_INITIATOR_PASSWORD=your_production_initiator_password
```

## Troubleshooting

### Wrong Credentials Error

If you see "Failed to initiate STK push: Wrong credentials" error, check the following:

1. Ensure your Consumer Key and Consumer Secret are correct
2. Make sure your Business Shortcode is correct
3. Verify that your Passkey is correct
4. Check that you're using the correct environment (sandbox or production)

### API Connection Issues

If you're having trouble connecting to the Safaricom API:

1. Ensure your server can make outbound HTTPS requests
2. Check that your server's SSL certificates are up to date
3. Verify that your callback URL is publicly accessible

## Support

For support, please contact me at brunoadul@gmail.com

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).