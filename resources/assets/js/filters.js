Vue.filter( 'timestamp', function ( value ) {
    return dayjs( value ).format( 'YYYY-MM-DD HH:mm:ss' );
} );

Vue.filter( 'lang', function ( value ) {
    return lang.get( value );
} );

Vue.filter( 'relativeTime', function ( value ) {
    return dayjs( value ).fromNow();
} );

Vue.filter( 'date', function ( value ) {
    if ( !value ) {
        return '';
    }

    return dayjs( value ).format( 'YYYY-MM-DD' );
} );

Vue.filter( 'datetime', function ( dateObject ) {
    return dayjs( dateObject ).format( 'YYYY-MM-DD HH:mm:ss' );
} );

Vue.filter( 'ymdhi', function ( dateObject ) {
    return dayjs( dateObject ).format( 'YYYY-MM-DD HH:mm' );
} );

Vue.filter( 'prettyDate', function ( dateObject ) {
    return dayjs( dateObject ).format( 'MMMM D, YYYY, HH:mm' );
} );

Vue.filter( 'pad_start', function ( value, length, char ) {
    if ( typeof value !== 'string' ) {
        value = value.toString();
    }

    return value.padStart( length, char );
} );

Vue.filter( 'substr_start', function ( value, length ) {
    if ( typeof value !== 'string' ) {
        value = value.toString();
    }

    return value.substring( 0, length );
} );

Vue.filter( 'str_replace', function ( value, old_string, new_string ) {
    if ( typeof value !== 'string' ) {
        value = value.toString();
    }

    return value.replace( old_string, new_string );
} );


Vue.filter( 'substr_end', function ( value, length ) {
    return window.substr_end( value, length );
} );

Vue.filter( 'pluralize', function ( count, single, plural ) {
    if ( count !== 1 ) {
        return lang.get( plural );
    }

    return lang.get( single );
} );

Vue.filter( 'nl2br', function ( text ) {
    return text.replace( /\n/, '<br/>' );
} );

Vue.filter( 'ucfirst', function ( text ) {
    return text.charAt( 0 ).toUpperCase() + text.slice( 1 );
} );