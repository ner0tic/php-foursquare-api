php-foursquare-api
==================

ORM agnostic php library to access foursquare api

Installation
=============
Add to composer
```js
    "require": {
        "ner0tic/php-api-core":     "*",
        "ner0tic/foursquare-api":   "*"
        // ...
```
Create your config file `app/config/foursquare.yml`
```yaml
url_token: XXXXXXXx
http_password: XXXXXXXXXXX
url_client_id: XXXXXXXXXXXXXXXXX
http_token: XXXXXXXXXXXXXXXX
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
Api's to choose from
- user
- checkins
- venues
- venuegroups
- tips
- lists
- updates
- photos
- settings
- specials
- campaigns
- events
- pages
- pageUpdates
- multi

To set the auth settings manually
```php
$fs = new \Foursquare\Client();

$fs->setAuthClientId($id);
$fs->setAuthHttpPassword($pass);
$fs->setAuthUrlToken($token);
$fs->setAuthHttpToken($token);
```

If you have api keys to use, mash them into a [pem](google.com) file and 
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
- DI to access config.yml for variables
- 