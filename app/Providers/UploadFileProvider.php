<?php

namespace App\Providers;

use App\Exceptions\UploadFileException;

class UploadFileProvider
{

    function uploadFile($file)
    {

        //We throw a personal Exception if the file is null
        if ($file == null)
            throw new UploadFileException('File not defined');

        //Metodo A (carpeta privada y nombre del file aleatorio)
        //Esta sentencia guarda facilmente el archivo en la ruta  storage/app/products
        //El problema es que esa carpeta es privada asi que si queremos que los usuarios vean ls fotos
        //de los productos guardaremos la foto en una carpeta publica
        //$request->imagen->store('products');

        //Metodo B (carpeta publica y nombre del file original)
        //guardamos la imagen en public/src/products para que los usuarios puedan
        //tener acceso
        $destinationPath = 'storage/products';
        $originalFile = $file->getClientOriginalName();
        $file->move($destinationPath, $originalFile);
    }
}
