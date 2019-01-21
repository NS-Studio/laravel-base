let numeral = require( 'numeral' );
numeral.register( 'locale', 'da', {
    delimiters:    {
        thousands: '.',
        decimal:   ','
    },
    abbreviations: {
        thousand: 'k',
        million:  'm',
        billion:  'b',
        trillion: 't'
    },
    ordinal:       function ( number ) {
        var b = number % 10;
        return (~~(number % 100 / 10) === 1) ? 'th' :
            (b === 1) ? 'st' :
                (b === 2) ? 'nd' :
                    (b === 3) ? 'rd' : 'th';
    },
    currency:      {
        symbol: '€'
    }
} );
numeral.locale( 'da' );

export default {

    toCurrency: function ( value ) {

        return numeral( value ).format( '0,0.00' );
    },
    toNumber:   function ( value ) {

        return numeral( value ).value();
    }
};