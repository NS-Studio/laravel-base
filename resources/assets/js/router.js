window.changeCase = require( 'change-case' );
import VueRouter from 'vue-router';
// Admin components
import AdminUsers from './components/Admin/Cards/AdminUsers';
// Example component - @todo remove this in private projects
import ExampleComponent from './components/ExampleComponent';
import Gate from './Gate';


const routes = [

    // Admin routes
    {
        path:      '/admin/users',
        component: AdminUsers,
        name:      'admin-users-table'
    },
    // Example route - @todo remove this in private projects
    { path: '/example', component: ExampleComponent, name: 'example' },
];


VueRouter.prototype.$gate = new Gate( window.user );

const router = new VueRouter( {
    routes // short for `routes: routes`
} );


router.beforeEach( ( to, from, next ) => {

    //console.log( to );
    let self = router;

    if ( to.path !== '/' && to.name !== null && self.$gate.can( window.changeCase.snakeCase( to.name ), 'router', to ) ) {

        next();

    } else {

        return false;
    }

} );

export default router;