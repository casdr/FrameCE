<?php
class asset {
    /*
        insert( file<string>, type<boolean> ) Echo a asset
        link( to<string>, inner<string>, args<array> ) Create a a href
        img( path<string>, title<string>, args<array> ) Insert a image
    */
    public static function insert($file, $type=false) {
        $types = array(
            'js'=>'<script type="text/javascript" src=":path:"></script>',
            'css'=>'<link rel="stylesheet" type="text/css" href=":path:">',
            'ico' => '<link rel="shortcut icon" href=":path:" type="image/x-icon" />'
        );
        $exfile = explode('.', $file);
        $count = count($exfile);
        if($type == false) $ext = $exfile[$count - 1];
        else $ext = $type;
        if(substr($file, 0, 7) == 'http://' || substr($file, 0, 8) == 'https://' || substr($file, 0,2) == '//') {
            $url = $file;
        } else {
            $url = BASE.'assets/'.$ext.'/'.$file;
        }
        return str_replace(':path:', $url, $types[$ext]);
    }
    public static function link($to, $inner, $args = array()){
        if(substr($to, 0, 7) == "http://" || substr($to, 0, 8) == "https://")
          $http = $to;
        else
          $http = BASE.$to;
    
        $str = "";
        if(count($args)>0)
          foreach ($args as $key => $value)
            $str .= ' '.$key.'="'.$value.'"';
    
        return '<a'.$str.' href="'.$http.'">'.$inner.'</a>';
    }
    public static function img($path, $title, $args = array()) {
        if(substr($path, 0, 7) == 'http://' || substr($path, 0, 8) == 'https://' || substr($path, 0, 2) == '//') $path = $path;
        else $path = BASE.'assets/img/'.$path;
        
        $str ='';
        if(count($args)>0)
            foreach($args as $key => $val)
                $str .= ' '.$key.'="'.$val.'"';
        return '<img'.$str.' src="'.$path.'" title="'.$title.'" alt="'.$title.'">';
    }
}