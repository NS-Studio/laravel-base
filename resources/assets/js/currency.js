window.accounting = require( 'accounting' );

window.money = function ( value ) {
    const max_decimals = 6;
    let decimals = 2;

    if ( decimals > max_decimals ) {
        decimals = max_decimals;
    }

    return accounting.format( value, {
        symbol:    '',
        format:    '%v',
        precision: Number( decimals ),
        decimal:   ',',
        thousand:  '.'
    } );
};

window.quantity = function ( value ) {
    const max_decimals = 4;
    let decimals = 2;

    if ( decimals > max_decimals ) {
        decimals = max_decimals;
    }

    return accounting.format( value, {
        symbol:    '',
        format:    '%v',
        precision: Number( decimals ),
        decimal:   ',',
        thousand:  '.'
    } );
};

window.vat_format = function ( value ) {
    const max_decimals = 3;
    let decimals = 2;

    if ( decimals > max_decimals ) {
        decimals = max_decimals;
    }

    return accounting.format( value, {
        symbol:    '',
        format:    '%v',
        precision: Number( decimals ),
        decimal:   ',',
        thousand:  '.'
    } );
};

window.discount_format = function ( value ) {
    const max_decimals = 2;
    let decimals = 2;

    if ( decimals > max_decimals ) {
        decimals = max_decimals;
    }

    return accounting.format( value, {
        symbol:    '',
        format:    '%v',
        precision: Number( decimals ),
        decimal:   ',',
        thousand:  '.'
    } );
};

Vue.filter( 'money', function ( value ) {
    return money( value );
} );

Vue.filter( 'quantity', function ( value ) {
    return quantity( value );
} );

Vue.filter( 'vat_format', function ( value ) {
    return vat_format( value );
} );

Vue.filter( 'discount_format', function ( value ) {
    return discount_format( value );
} );