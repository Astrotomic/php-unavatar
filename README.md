# PHP Unavatar

[![Latest Version](http://img.shields.io/packagist/v/astrotomic/php-unavatar.svg?label=Release&style=for-the-badge)](https://packagist.org/packages/astrotomic/php-unavatar)
[![MIT License](https://img.shields.io/github/license/Astrotomic/php-unavatar.svg?label=License&color=blue&style=for-the-badge)](https://github.com/Astrotomic/php-unavatar/blob/master/LICENSE)
[![Offset Earth](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-green?style=for-the-badge)](https://offset.earth/treeware)
[![Larabelles](https://img.shields.io/badge/Larabelles-%F0%9F%A6%84-lightpink?style=for-the-badge)](https://www.larabelles.com/)

[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/Astrotomic/php-unavatar/run-tests?style=flat-square&logoColor=white&logo=github&label=Tests)](https://github.com/Astrotomic/php-unavatar/actions?query=workflow%3Arun-tests)
[![StyleCI](https://styleci.io/repos/242236468/shield)](https://styleci.io/repos/242236468)
[![Total Downloads](https://img.shields.io/packagist/dt/astrotomic/php-unavatar.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/astrotomic/php-unavatar)

This package provides a PHP OOP builder for [unavatar](https://unavatar.now.sh).

## Installation

You can install the package via composer:

```bash
composer require astrotomic/php-unavatar
```

## Usage

To create an `Unavatar` instance you can simply create one or use one of the static helper methods.
Please refer to the [unavatar docs](https://unavatar.now.sh/) for a full documentation of possibilities.

```php
use Astrotomic\Unavatar\Unavatar;

$unavatar = new Unavatar('email@example.com');
Unavatar::email('email@example.com');
Unavatar::username('Astrotomic');
Unavatar::domain('astrotomic.info');
Unavatar::github('Astrotomic');
```

### Fallback

You can also add a fallback image URL that's used if no image is found.

```php
$unavatar->fallback('https://example.com/image.jpg');
```

### URL

You can call `toUrl()` on your `Unavatar` instance to retrieve the full generated URL.

```php
$unavatar->toUrl();
```

```
https://unavatar.now.sh/email%40example.com/?fallback=https%3A%2F%2Fexample.com%2Fimage.jpg
```

### HTML img-tag

You can also call `toImg()` on your `Unavatar` instance to get a full HTML `<img/>` tag.

```php
$unavatar->toImg(['loading' => 'lazy']);
```

```html
<img
  alt="email@example.com's avatar"
  loading="lazy"
  src="https://unavatar.now.sh/email%40example.com/?fallback=https%3A%2F%2Fexample.com%2Fimage.jpg"
/>
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/Astrotomic/.github/blob/master/CONTRIBUTING.md) for details. You could also be interested in [CODE OF CONDUCT](https://github.com/Astrotomic/.github/blob/master/CODE_OF_CONDUCT.md).

### Security

If you discover any security related issues, please check [SECURITY](https://github.com/Astrotomic/.github/blob/master/SECURITY.md) for steps to report it.

## Credits

- [Tom Witkowski](https://github.com/Gummibeer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Treeware

You're free to use this package, but if it makes it to your production environment I would highly appreciate you buying the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to [plant trees](https://www.bbc.co.uk/news/science-environment-48870920). If you contribute to my forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at [offset.earth/treeware](https://plant.treeware.earth/Astrotomic/php-unavatar)

Read more about Treeware at [treeware.earth](https://treeware.earth)
