<?php


namespace App\Service;


class Tools
{
    public function fieldIfNotExist(&$array, $keys ){

        foreach ($keys as $key ){
            if(!array_key_exists($key, $array)) {
                $array[$key] = null;
            }
        }
    }


}