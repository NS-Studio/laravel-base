<?php
/**
 * Created by PhpStorm.
 * User: ndimic
 * Date: 5.3.18.
 * Time: 19.01
 */

namespace App\Traits;


use League\Csv\Reader;

trait CsvImport
{

    private function import( $path, array $keys )
    {

        $csv = Reader::createFromPath( $path, 'r' )->setDelimiter( ';' );

        if ( $csv ) {

            $csv->setHeaderOffset( 0 );

            $entries = collect( $csv->getRecords() );


            $data = collect();

            foreach ( $entries as $entry ) {

                $entry = (object) $entry;

                $values = [];

                foreach ( $keys as $key => $value ) {

                    $values[ $key ] = $entry->{$value};
                }

                $data->push( $values );

            }
        }

        return $data ?? [];
    }

}