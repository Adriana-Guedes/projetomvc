<?php

class Checa {

    public static function checarNome($nome){
        if(!preg_match('/^([áÁàÀÃãÉéêÊíÍìÌóÒõÕòÒÔôúÚÙùcCaA-zZ]+)+((\s[áÁàÀÃãÉéêÊíÍìÌóÒõÕòÒÔôúÚÙùcCaA-zZ]+)+)?$/',$nome)):
            return true;
        else:
            return false;

        endif;
    }


    public static function checarEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            return true;
        else:
            return false;

        endif;

    }
}