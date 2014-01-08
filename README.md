PreHParser [![Build Status](https://secure.travis-ci.org/cryptocompress/PreHParser.png?branch=master)](https://travis-ci.org/cryptocompress/PreHParser)
==========

pre parser for php

#### install
    composer require cryptocompress/prehparser:dev-master
#### add this line right after composers class loader
    require_once 'vendor/autoload.php';
    \PreHParser\Loader::register();

Now your can [omit _implements_ on class definition](https://twitter.com/mathiasverraes/status/420496198743494657)
and write [typehints _after_ the variable](https://twitter.com/mathiasverraes/status/420493583389425664).

See [LoaderTest.php](https://github.com/cryptocompress/PreHParser/blob/master/test/LoaderTest.php)
and [PupilId.php](https://github.com/cryptocompress/PreHParser/blob/master/lib/Foo/PupilId.php).
