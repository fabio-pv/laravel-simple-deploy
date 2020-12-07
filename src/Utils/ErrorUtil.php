<?php


namespace LaravelSimpleDeploy\Utils;


use Carbon\Carbon;

class ErrorUtil
{
    static function make(\Exception $e)
    {
        $dir = base_path() . '/laravel_simple_deploy.error';
        $content =
            'Date: ' . Carbon::now() . PHP_EOL .
            'Message: ' . $e->getMessage()
            . PHP_EOL . 'File: ' . $e->getFile()
            . PHP_EOL . 'Line: ' . $e->getLine()
            . PHP_EOL . PHP_EOL;

        file_put_contents(
            $dir,
            $content,
            FILE_APPEND
        );

        chmod($dir, 0777);
    }

}
