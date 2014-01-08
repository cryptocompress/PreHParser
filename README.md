PreHParser
==========

pre parser for php

## use
### install:
    composer require cryptocompress/prehparser
### and add this line right after composer:
    require_once 'vendor/autoload.php';
    \PreHParser\Loader::register();

now your can [omit _implements_ on class definition](https://twitter.com/mathiasverraes/status/420496198743494657)
and write [typehints _after_ the variable](https://twitter.com/mathiasverraes/status/420493583389425664)
see [LoaderTest.php](https://github.com/cryptocompress/PreHParser/blob/master/test/LoaderTest.php)
and [PupilId.php](https://github.com/cryptocompress/PreHParser/blob/master/lib/Foo/PupilId.php)
