window.Vue = require( 'vue' );
require( './currency' );

import relativeTime from 'dayjs/plugin/relativeTime';
import VTooltip from 'v-tooltip';
import Gate from './Gate';
import VueResource from 'vue-resource';
import BootstrapVue from 'bootstrap-vue';
import VueRouter from 'vue-router';
import Toasted from 'vue-toasted';
import Icon from 'vue-awesome/components/Icon';
import 'vue-awesome/icons';
import vSelectPage from 'v-selectpage';
import VueEcho from 'vue-echo-laravel';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
// Translations
import Lang from 'lang.js';
import messages from './ll_messages';
import mixins from './mixins';

require( './ui' );

window._ = require( 'lodash' );


const default_locale = window.default_language;
const fallback_locale = window.fallback_locale;

window.dayjs = require( 'dayjs' );
window.dayjs.extend( relativeTime );

window.dayjs.locale( default_locale );

VTooltip.enabled = window.innerWidth > 768;
window.isMobile = window.innerWidth < 768;

Vue.use( VTooltip, {
    autoHide:              false,
    defaultAutoHide:       false,
    defaultHandleResize:   false,
    defaultDelay:          0,
    disposeTimeout:        0,
    defaultDisposeTimeout: 0,
    defaultOffset:         8,
    defaultTrigger:        'hover focus',

    popover: {
        autoHide:              false,
        defaultAutoHide:       false,
        defaultHandleResize:   false,
        defaultDelay:          0,
        disposeTimeout:        0,
        defaultDisposeTimeout: 0,
        defaultOffset:         8,
        defaultTrigger:        'hover focus',
    }
} );

window.substr_end = function ( value, length ) {
    if ( typeof value !== 'string' ) {
        value = value.toString();
    }

    return value.substring( value.length - length );
};

Vue.use( VueResource );
require( './http' );

Vue.use( BootstrapVue );
Vue.use( VueRouter );
Vue.component( 'icon', Icon );
Vue.use( Toasted );
Vue.use( vSelectPage );

window.Pusher = require( 'pusher-js' );
Vue.use( VueEcho, {

    broadcaster:  'pusher',
    key:          process.env.MIX_PUSHER_APP_KEY,
    cluster:      process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted:    true,
    authEndpoint: '/broadcasting/auth',
    auth:         {
        headers: {
            Authorization: null
        }
    },
} );
Vue.use( Loading );

Vue.prototype.$eventHub = new Vue(); // Global event bus
Vue.prototype.$gate = new Gate( window.user );
window.lang = new Lang( { messages, locale: default_locale, fallback: fallback_locale } );

window.environment = process.env.NODE_ENV;

window.currency_from_to = function ( value, rate_from, rate_to ) {
    return value / (rate_to / rate_from);
};

window.url_previous = function ( fallback ) {
    if ( window._url.previous === '' || window._url.previous === window._url.current ) {
        return fallback;
    }

    return window._url.previous;
};

require( './filters' );

window.groupBy = function ( list, key ) {
    return list.reduce( function ( list_item, item ) {
        (list_item[ item[ key ] ] = list_item[ item[ key ] ] || []).push( item );

        return list_item;
    }, {} );
};

window.objectMap = function ( object, mapFn ) {
    return Object.keys( object ).reduce( function ( result, key ) {
        result[ key ] = mapFn( object[ key ] );

        return result;
    }, {} );
};

if ( typeof(String.prototype.strip) === 'undefined' ) {
    String.prototype.strip = function ( char ) {
        return String( this ).replace( new RegExp( '(^' + char + ')|(' + char + '$)', 'g' ), '' );
    };
}

window.trans = function ( item, params ) {
    params = params || {};

    return lang.get( item, params );
};

Vue.mixin( mixins );

Date.prototype.yyyymmdd = function () {
    let mm = this.getMonth() + 1; // getMonth() is zero-based
    let dd = this.getDate();

    return [
        this.getFullYear(),
        (mm > 9 ? '' : '0') + mm,
        (dd > 9 ? '' : '0') + dd
    ].join( '-' );
};

Date.prototype.yyyymmddhhiiss = function () {
    let mm = this.getMonth() + 1; // getMonth() is zero-based
    let dd = this.getDate();
    let hh = this.getHours();
    let min = this.getMinutes();
    let ss = this.getSeconds();

    return [
        this.getFullYear(),
        (mm > 9 ? '' : '0') + mm,
        (dd > 9 ? '' : '0') + dd,
        (hh > 9 ? '' : '0') + hh,
        (min > 9 ? '' : '0') + min,
        (ss > 9 ? '' : '0') + ss,
    ].join( '' );
};