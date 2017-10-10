<?php

namespace system\libary;

class form{

    public static function start($action="",$method="post"){
        if(strlen($action) <= 0)$action = $_SERVER['PHP_SELF'];
        return '<form action="'.$action.'" method="'.$method.'">';
    }

    public static function end(){
        return '</form>';
    }

    public static function select($instance,$array_id,$array_display,$selected="",$blank="",$onchange="",$blank_value='0',$extra=""){
        if(strlen($onchange) >= 1)$onchange = ' onchange="'.$onchange.'" ';
        $msg = '<select name="'.$instance.'" id="'.$instance.'" '.$onchange.' '.$extra.'>';
        if(strlen($blank) >= 1)$msg .= '<option value="'.$blank_value.'">'.$blank.'</option>';
        return $msg.self::options($array_id,$array_display,$selected).'</select>';
    }

    public static function options($array_id,$array_display,$selected=""){
        $length = count($array_id);
        $use_selected = strlen($selected) >= 1 || false;
        for($i=0;$i<$length;$i++){
            $is_selected = '';
            if($use_selected && $array_id[$i] === $selected){
                $is_selected =' selected="selected"';
                $use_selected = false;
            }
            $msg .= '<option value="'.$array_id[$i].'"'.$is_selected.'>'.$array_display[$i].'</option>';
        }

        return $msg;
    }

    public static function text($instance,$value='',$maxlength=250,$size=20,$password=false,$bootstrap=false,$extra=''){
        if($password)$type = 'password';
        else $type = 'text';
        if($bootstrap)$extra .= ' class="form-control" ';
        return '<input type="'.$type.'" name="'.$instance.'" id="'.$instance.'" value="'.$value.'" size="'.$size.'" maxlength="'.$maxlength.'" '.$extra.'>';

    }


    public static function radio($instance,$array_id,$array_display,$checked='',$divider=' '){
        $length = count($array_id);
        for($i=0;$i<$length;$i++){
            if($array_id[$i] === $checked || $array_id[$i] === strip_tags($_POST[$instance]))$isChecked = ' checked="checked" ';
            else $is_checked = '';
            $msg .= ' <input type="radio" name="'.$instance.'" id="'.$instance.'" value="'.$array_id[$i].'"'.$is_checked.'> '.$array_display[$i].$divider;
        }
        return $msg;
    }

    public static function check($instance,$value="true",$checked=false,$hide_post=false,$extra=''){
        if(!$hide_post)if(strip_tags($_POST[$instance]) === $value)$checked = true;
        if($checked)$temp = 'checked="checked" ';
        else $temp = '';
        $temp .= ' '.$extra;
        return '<input type="checkbox" name="'.$instance.'" id="'.$instance.'" value="'.$value.'" '.$temp.'>';
    }

    public static function checks($instance_array,$value_array,$hor=1,$msg=''){
        $length = count($instance_array);
        for($i=0;$i<$length;$i++){
            if($value_array[$i] === strip_tags($_POST[$instance_array[$i]]))$checked = true;
            else $checked = false;
            if($hor <= 0)$divider = '<br>';
            else $divider = '';
            $msg .= self::check($instance_array[$i],"true",$checked).$value_array[$i].$divider;
        }
        return $msg;
    }

    public static function hidden($instance,$value='yes'){
        return '<input type="hidden" name="'.$instance.'" id="'.$instance.'" value="'.$value.'">';
    }
    public static function textArea($instance,$text="",$cols=30,$rows=5,$extra=''){
        return '<textarea style="border-radius:6px;border:none;" name="'.$instance.'" id="'.$instance.'" rows="'.$rows.'" cols="'.$cols.'" '.$extra.'>'.$text.'</textarea>';
    }

    public static function submit($value="Submit", $extra=''){
        return '<input type="submit" value="'.$value.'" '.$extra.'>';
    }
    public static function button($value="Submit",$extra=''){
        return '<input class="master_link" type="button" value="'.$value.'" '.$extra.'>';
    }


    //SIMPLE FORM THAT PASSES ONLY 1 HIDDEN VARIABLE TO SAME PAGE
    public static function simple($instance,$value,$submit="Submit",$extra='',$url=''){
        if(strlen($url) <= 1)$url = $_SERVER['PHP_SELF'];
        return '<form action="'.$url.'" method="post">
				'.self::hidden($instance,$value).'
				<input type="hidden" name="'.$instance.'" value="'.$value.'">'.$extra.self::submit($submit).'</form>';
    }

    public static function upload($instance){
        return '<input name="'.$instance.'" id="'.$instance.'" type="file">';
    }

    public static function quickUpload($text,$hidden="yes",$url="",$caption=false,$caption_text=""){
        if(strlen($url) <= 0)$url = $_SERVER['PHP_SELF'];
        $msg = '<form enctype = "multipart/form-data" method="post" action="'.$url.'">
				'.self::hidden($hidden, $hidden).'<span style="font-weight:bold;">'.$text.'</span><br>';
        if($caption)$msg .= '<span style="font-weight:bold;">Caption</span> '.self::text("upload_caption",$caption_text).' ';
        return $msg.'<input class="btn btn-default" style="border-radius:4px;margin:0 auto;" name="file_up" type="file"> 
				<br>'.self::submit("Upload").'
			</form>';

    }


} ?>

