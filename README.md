php-foursquare-api
==================

ORM agnostic php library to access foursquare api
version 2.0

Installation
=============
Add to composer
```js
    "require": {
        "ner0tic/php-api-core":     "2.*",
        "ner0tic/foursquare-api":   "2.*"
        // ...
```


Usage
=============
```php
$fs = new \Foursquare\Client();

$checkins = $fs->api('checkins')->recent(); // recent($id,max=10)
foreach($checkins as $checkin) {
  echo $checkin; // $checkin->timestamp.' '.$checkin->getVenue()->getName()
}
```
Api's to choose from:
- users
- checkins
- venues
- venue groups
- tips
- lists
- updates
- photos
- settings
- specials
- campaigns
- events
- pages
- page updates
- multi

To set the auth settings manually
```php
$fs = new \Foursquare\Client();

$fs->setAuthClientId($id);
$fs->setAuthHttpPassword($pass);
$fs->setAuthUrlToken($token);
$fs->setAuthHttpToken($token);
```

If you have api keys to use, mash them into a [pem](http://www.fileinfo.com/extension/pem) file and 
set the `certificate` option to the path  of the file.
```php
$client->setOption('certificate', $pem_file);
```

Make a query
```php
$result = $api->get($endpoint, $parameters, $request_options);
```
ToDo
=================
Laundry List
- DI to access config.yml for variables

