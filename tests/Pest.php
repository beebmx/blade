<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function expected(string $file): string
{
    $file_path = __DIR__.'/fixtures/expected/'.$file.'.html';

    return file_get_contents($file_path);
}
