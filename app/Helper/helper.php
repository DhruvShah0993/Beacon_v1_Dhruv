<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

function replace_null_with_empty_string($array)
{
     
    $array = collect($array)->toArray();
    
    foreach ($array as $key => $value) {
        if (is_array($value)){
            if(empty($value)){
                $array[$key] = (object)[];
            }else{
                $array[$key] = replace_null_with_empty_string($value);
            }
        }
            
        else {
            if (is_null($value))
                $array[$key] = "";
        }
    }
    
    return $array;
}

function RandomPassword($length)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
    $password = substr(str_shuffle($chars), 0, $length);
    return $password;
}

function unique_code($len)
{
    /*$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
    $password = substr(str_shuffle($chars), 0, $length);
    return $password;*/
    
    //enforce min length 8
//    if($len < 8)
//        $len = 8;

    //define character libraries - remove ambiguous characters like iIl|1 0oO
    $sets = array();
//    $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
    $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    $sets[] = '1234567890';
//    $sets[]  = '~!@#$%^&*(){}[],./?';

    $password = '';
    
    //append a character from each set - gets first 4 characters
    foreach ($sets as $set) {
        $password .= $set[array_rand(str_split($set))];
    }

    //use all characters to fill up to $len
    while(strlen($password) < $len) {
        //get a random set
        $randomSet = $sets[array_rand($sets)];
        
        //add a random char from the random set
        $password .= $randomSet[array_rand(str_split($randomSet))]; 
    }
    
    //shuffle the password string before returning!
    return str_shuffle($password);
}

function HashPassword($password)
{
    return Hash::make($password);
}

function getFormatedDate($date, $format=NULL)
{
    $return = '';
    if (isset($date) && !empty($date) && $date != null) {
        if(!isset($format)){
            $format = 'Y-m-d H:i:s';
        }
        return Carbon::parse($date)->format($format);
    }
    return $return;
}

function getDbCompetibleDateFormat($date){
    return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d H:i:s');

}
function moneyFormat($value)
{
    return number_format($value, 2);
}

function be64($id) {
    return base64_encode($id);
}

function bd64($id) {
    return base64_decode($id);
}

function uploadUserImage($image, $location = "others", $oldfile = "") {
    $img_name = time() . "_" . Str::random() . "_" . rand(111111, 999999) . "." . $image->getClientOriginalExtension();
    $path = \Storage::disk('public')->putFileAs(
            $location, $image, $img_name
    );
    if (!empty($oldfile) && file_exists(public_path('storage/' . $oldfile))) {
        unlink(public_path('storage/' . $oldfile));
    }
    return $img_name;
}

   

?>