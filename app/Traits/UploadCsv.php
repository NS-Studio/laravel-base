<?php
/**
 * Created by PhpStorm.
 * User: ndimic
 * Date: 5.3.18.
 * Time: 19.53
 */

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadCsv
{

    private function upload( $file, $name )
    {

        if ( $file && $name ) {

            return Storage::disk( 'public' )->putFileAs( 'products_imports', $file, $name );

        } else {

            return false;
        }

    }

}