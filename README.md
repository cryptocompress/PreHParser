PreHParser
==========

pre parser for php

## use
### install
    composer require cryptocompress/prehparser
### and add this line right after ``require_once 'vendor/autoload.php';`` 
    \PreHParser\Loader::register();

#### now your can [omit "implements" on class definition](https://github.com/cryptocompress/PreHParser/blob/master/lib/Foo/PupilId.php)
#### and write [typehints _after_ the variable](https://github.com/cryptocompress/PreHParser/blob/master/lib/Foo/PupilId.php)

## more
    [LoaderTest.php](cat vendor/cryptocompress/prehparser/test/LoaderTest.php)
    
    [source tweet 1](https://twitter.com/mathiasverraes/status/420496198743494657)
    [source tweet 2](https://twitter.com/mathiasverraes/status/420493583389425664)
