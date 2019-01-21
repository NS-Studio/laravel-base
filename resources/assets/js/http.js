import Vue from 'vue';

let token = document.head.querySelector( 'meta[name="csrf-token"]' ).content;

Vue.http.headers.common[ 'X-CSRF-TOKEN' ] = token;
Vue.http.headers.common[ 'Accept' ] = 'application/json';

Vue.http.interceptors.push( function ( request ) {

    let self = this;

    // return response callback
    return function ( response ) {

        if ( response.status === 401 ) {

            self.$toasted.show( 'You have been logged out due to inactivity, will be now redirected to login.', {

                type:     'danger',
                duration: 2000,
            } );

            window.setTimeout( function () {

                window.location.replace( '/' );
            }, 3000 );

        }

    };
} );