<?php

namespace App\Currency;

class Parser
{
    protected const REGEXES = [
        'thousand' => '/(^\d{1,9}(\.[\d]{3}){1}(\,\d{1,})?$)/',
        'million'  => '/(^\d{1,6}(\.[\d]{3}){2}(\,\d{1,})?$)/',
        'billion'  => '/(^\d{1,3}(\.[\d]{3}){3}(\,\d{1,})?$)/',
        'trillion' => '/(^\d{1,3}(\.[\d]{3}){4}(\,\d{1,})?$)/',

        'space_period_thousand' => '/(^\d{1,9} ([\d]{3}){1}(\.\d{1,})?$)/',
        'space_period_million'  => '/(^\d{1,6} ([\d]{3}){2}(\.\d{1,})?$)/',
        'space_period_billion'  => '/(^\d{1,3} ([\d]{3}){3}(\.\d{1,})?$)/',
        'space_period_trillion' => '/(^\d{1,3} ([\d]{3}){4}(\.\d{1,})?$)/',

        'space_comma_thousand' => '/(^\d{1,9} ([\d]{3}){1}(\,\d{1,})?$)/',
        'space_comma_million'  => '/(^\d{1,6} ([\d]{3}){2}(\,\d{1,})?$)/',
        'space_comma_billion'  => '/(^\d{1,3} ([\d]{3}){3}(\,\d{1,})?$)/',
        'space_comma_trillion' => '/(^\d{1,3} ([\d]{3}){4}(\,\d{1,})?$)/',

        'comma_thousand' => '/(^\d{1,9}(\,[\d]{3}){1}(\.\d{1,})?$)/',
        'comma_million'  => '/(^\d{1,6}(\,[\d]{3}){2}(\.\d{1,})?$)/',
        'comma_billion'  => '/(^\d{1,3}(\,[\d]{3}){3}(\.\d{1,})?$)/',
        'comma_trillion' => '/(^\d{1,3}(\,[\d]{3}){4}(\.\d{1,})?$)/',

        'only_period' => '/(^\d{1,12}(\.\d{1,})?$)/',
        'only_comma'  => '/(^\d{1,12}(\,\d{1,})?$)/',
        'space'       => '/(^\d{1,12} (\d{1,})?$)/',

        'decimal_no_number'        => '/(^(\.\d{1,})?$)/',
        'decimal_no_number_period' => '/(^(\,\d{1,})?$)/',
    ];

    public static function isValid( $number = 0.0 )
    {
        foreach ( static::REGEXES as $regex ) {
            if ( (int) preg_match( $regex, $number ) === 1 ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $number
     *
     * @deprecated use ::format instead
     *
     * @return float
     */
    public static function parse( $number = '' )
    {
        return static::format( $number );
    }

    public static function format( $number = 0.0, $maxDecimals = 6 )
    {
        if ( \is_float( $number ) ) {
            return $number;
        }

        foreach ( static::REGEXES as $name => $regex ) {
            if ( (int) preg_match( $regex, $number ) === 1 ) {
                switch ( $name ) {
                    case 'only_period':
                        return round( $number, $maxDecimals );
                    case 'only_comma':
                        return round( 0 . str_replace( ',', '.', $number ), $maxDecimals );
                    case 'decimal_no_number':
                        return round( $number, $maxDecimals );
                    case 'decimal_no_number_period':
                        return round( 0 . str_replace( ',', '.', $number ), $maxDecimals );
                    case 'space':
                        return round( str_replace( ' ', '.', $number ), $maxDecimals );
                    case 'thousand':
                    case 'million':
                    case 'billion':
                    case 'trillion':
                        return round( str_replace( ',', '.', str_replace( '.', '', $number ) ), $maxDecimals );
                    case 'comma_thousand':
                    case 'comma_million':
                    case 'comma_billion':
                    case 'comma_trillion':
                        return round( str_replace( ',', '.', str_replace( '.', '', $number ) ), $maxDecimals );
                    case 'space_period_thousand':
                    case 'space_period_million':
                    case 'space_period_billion':
                    case 'space_period_trillion':
                        return round( str_replace( ' ', '', $number ), $maxDecimals );
                    case 'space_comma_thousand':
                    case 'space_comma_million':
                    case 'space_comma_billion':
                    case 'space_comma_trillion':
                        return round( str_replace( ',', '.', str_replace( ' ', '', $number ) ), $maxDecimals );
                }
            }
        }

        return (double) $number;
    }

    public static function toBaseValue( $amount = 1.0, $rate = 1.0 )
    {
        if ( $rate <= 0 ) {
            return 0;
        }

        return $amount * $rate;
    }
}