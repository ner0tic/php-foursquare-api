php-foursquare-api
==================

ORM agnostic php library to access foursquare api

Usage
=============
```php
use Core\Api\AbstractApi;

$api = AbstractApi();
$client = api->getClient();
```

If you have api keys to use, mash them into a [pem](google.com) file and 
set the `certificate` option to the path  of the file.
```php
$client->setOption('certificate', $pem_file);
```

Make a query
```php
$result = $api->get($endpoint, $paramters, $request_options);
```