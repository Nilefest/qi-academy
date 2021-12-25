<?php
namespace App\Library\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

use App\User;

class CommonService {

    /**
     * Get ststic data from JSON files
     * 
     * @param array    - type of data
     * @return array 
     */
    public static function getDataFromFile($file_name = 'common.default.json'){
        $data = Storage::disk('local')->get('default/' . $file_name);
        $data = json_decode($data, true);

        return $data;
    }

    /**
     * Get array with row`s key from array`s column
     * 
     * @param array     - start array
     * @param string    - column`s name for get data
     * @return array    - finish array
     */
    public static function colToKey($collection = [], $key){
        $new_arr = [];
        foreach($collection as $row) $new_arr[$row[$key]] = $row;
        return $new_arr;
    }

    public static function uploadFile($path, $file, $old_filepath = '', $file_index = -1, $file_type = ''){
        $filepath = public_path('uploads/' . $path);

        if($old_filepath) if(!mb_strpos($old_filepath, '.default.')) if(file_exists(public_path($old_filepath))) File::delete(public_path($old_filepath));
        
        if($file_index > -1){
            $filename = CommonService::translit_file(time() . '_' . $file['name'][$file_index][$file_type]);
            move_uploaded_file($file['tmp_name'][$file_index][$file_type], $filepath . '/' . $filename);
        } else {
            $filename = CommonService::translit_file(time() . '_' . $file['name']);
            move_uploaded_file($file['tmp_name'], $filepath . '/' . $filename);
        }
        
        return '/uploads/' . $path . '/' . $filename;
    }

    public static function replaceBrToLn($input){
        return preg_replace('/<br\s?\/?>/ius', "\n", str_replace("\n","",str_replace("\r","", htmlspecialchars_decode($input))));
    }

    public static function replaceNlToBr($str) {
        
		// Replace h1-h6 to paragraph-header-paragraph
        for($i = 1; $i < 7; $i++){
            $str = str_replace("<h$i>", "</p><h$i>", $str);
            $str = str_replace("</h$i>", "</h$i><p>", $str);
        }
        //$str = nl2br($str);
        $str = str_replace("\n", '<br/>', $str);
        
        return $str;
    }
    public static function translit_file($filename) {
        $converter = array(
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

            'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
            'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
            'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
            'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
            'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
            'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
            'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
        );

        $new = '';

        $file = pathinfo(trim($filename));
        if (!empty($file['dirname']) && @$file['dirname'] != '.') {
            $new .= rtrim($file['dirname'], '/') . '/';
        }

        if (!empty($file['filename'])) {
            $file['filename'] = str_replace(array(' ', ','), '-', $file['filename']);
            $file['filename'] = strtr($file['filename'], $converter);
            $file['filename'] = mb_ereg_replace('[-]+', '-', $file['filename']);
            $file['filename'] = trim($file['filename'], '-');					
            $new .= $file['filename'];
        }

        if (!empty($file['extension'])) {
            $new .= '.' . $file['extension'];
        }

        return $new;
    }
}