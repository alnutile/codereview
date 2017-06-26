# codereview

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** Replace ```Al``` ```alnutile``` ```https://github.com/alnutile``` ```alfrednutile@gmail.com``` ```alnutile``` ```codereview``` ```CLI to help with the many steps``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line. You can run `$ php prefill.php` in the command line to make all replacements at once. Delete the file prefill.php as well.

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.


This will create a CLI foundation using [Silly](https://github.com/mnapoli/silly)

It is based off the [thephpleague/skeleton](https://github.com/thephpleague/skeleton) library

>THIS IS 99% BASED ON [https://github.com/thephpleague/skeleton](https://github.com/thephpleague/skeleton)
>TOTALLY APPRECIATE THEIR WORK

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practises by being named the following.

```
bin/        
config/
src/
tests/
vendor/
```


## Install

First install `cgr` as seen [here](https://github.com/consolidation/cgr)
Then run 
``` bash
$ cgr global require alnutile/codereview:dev-master
```

So the article [here](https://medium.com/@alnutile/php-cli-skeleton-c054eedde48f) for more details

## Global Install Notes

This is how a user can install this for a reliable global install:


## Usage

``` php
$skeleton = new Alnutile\Codereview();
echo $skeleton->echoPhrase('League!', 'Hello');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

>if you get an error change the extend of 
>`src/SkeletonClass.php` to `\PHPUnit\Framework\TestCase`
>your install might have setup PHPUnit 6


``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email alfrednutile@gmail.com instead of using the issue tracker.

## Credits

- [Al][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/alnutile/codereview.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/alnutile/codereview/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/alnutile/codereview.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/alnutile/codereview.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/alnutile/codereview.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/alnutile/codereview
[link-travis]: https://travis-ci.org/alnutile/codereview
[link-scrutinizer]: https://scrutinizer-ci.com/g/alnutile/codereview/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/alnutile/codereview
[link-downloads]: https://packagist.org/packages/alnutile/codereview
[link-author]: https://github.com/alnutile
[link-contributors]: ../../contributors
