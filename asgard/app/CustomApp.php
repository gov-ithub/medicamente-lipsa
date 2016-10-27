<?php namespace App;

/* 
 * @author Adrian Nitu <adrian.nitu at gmail.com>
 * 
 * custom extend for shared hosting
 */
use Illuminate\Foundation\Application;

class CustomApp extends Application  
{
    public function publicPath()  
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'public_html';
    }
}