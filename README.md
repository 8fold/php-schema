# 8fold Schema

8fold Schema is designed to make interacting with structured data for the web easier.

The first library being tested is the [Schema.org](https://schema.org/) vocabulary for adding metadata to the web. This metadata not only helps with search engine optimization, but may also help improve the accessibility and experience of your site for those using assistive technologies. The vocabulary includes dozens of standardized objects, fields, and relationships.

> Note: If you are looking for a way to objectify JSON-LD strings, we can point you to [Aaron Bullard's PhpSchema](https://github.com/aaronbullard/php-schema). It is self-validating and appears to be designed to convert JSON-LD string into objects. 8fold Schema is designed to create objects that can output JSON-LD from the contents of a path, a provided `stdClass` instance, or JSON-LD string.

## Installation

```bash
composer require 8fold/php-schema
```

## Usage

```json
{
  "@context": "http://schema.org",
  "@type": "Permit",
  "name": "something"
}
```

`@context` let's us know which vocabulary we're using. `@type` tells us which object type to instantiate.

```php
Schema::fromString($json);
// output: Instance of Eightfold\Schema\Types\Permit with property name with value of "something"
```

Let's consider that JSON being the content of a file.

```php
Schema::fromPath("/full/path/to/file.json");
// output: Instance of Eightfold\Schema\Types\Permit with property name with value of "something"
```
