<?php

    function dateFormat($value)
    {
        if ($value == '0000-00-00' || $value == '' || $value == null)
            return "";
        return date_format(date_create($value),"d-m-Y");
    }
    