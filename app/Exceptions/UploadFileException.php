<?php

namespace App\Exceptions;

use Exception;

class UploadFileException extends Exception 
{
    public function customMessage(){
        return 'Nos has subido ninguna foto';
    }
}
