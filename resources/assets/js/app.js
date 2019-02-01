require( './application-bootstrap' );
import router from './router';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue( {
    el:         '#app',
    router,
    mounted() {
        /*
         Example of creating new listener for broadcasting events

         this.$echo.private( 'orders' ).listen( 'OrderResentEvent', ( response ) => {

         this.$eventHub.$emit( 'order-resend-done' );
         this.$toasted.show( response.message, {

         duration: 5000,
         type:     response.type,
         } );
         } );*/
    }

} );

