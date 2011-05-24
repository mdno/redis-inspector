Redis inspector
====
Redis inspector is a small tool to inspect the data on your Redis server. It allows you to easily browse your keys if they are set like `object:id:attribute` or `object:id:attribute:another_id:another_attribute` or something comparable.

### Requirements
* The excellent PHP Redis extension: https://github.com/nicolasff/phpredis

### Configuration
In config.php:

* Set the Redis host, port and db
* Set a prefix - default: none
* Select a db - default: 0
* Set the separator - default: `:`

### Limitations
* Gets slow when handling large amounts of data (>100k keys in your db), but still useful for debugging

### Issues & improvements
* Open an issue or submit a patch