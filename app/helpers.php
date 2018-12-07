<?php
/**
 * Created by PhpStorm.
 * User: wangxiao
 * Date: 2018/12/7
 * Time: 11:49
 */

use \Illuminate\Support\Str;

if ( ! function_exists("convert_base64_to_file")) {
    function convert_base64_to_file($base64String): string
    {
        $path = '';
        if ( ! $base64String) {
            $path = '';
        }

        @list($baseType, $fileData) = explode(',', $base64String);
        $suffix   = mimetype_to_suffix(str_replace('data:', '', str_replace(';base64', '', $baseType)));
        $fileName = Str::uuid().$suffix;

        if ($fileData != "") {
            $path = '/avatar/'.date('ym').'/'.$fileName;
            Storage::disk('public')->put($path, base64_decode($fileData));
        }

        return $path;
    }
}

if ( ! function_exists("mimetype_to_suffix")) {
    function mimetype_to_suffix(string $mimeType): string
    {
        $suffix = '';
        switch ($mimeType) {
            case 'image/png' :$suffix = '.png';break;
            case 'image/jpeg' :$suffix = '.jpeg';break;
            case 'image/gif' :$suffix = '.gif';break;
        }

        return $suffix;
    }
}