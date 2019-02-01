import AdminNavigation from './components/Admin/AdminNavigationComponent';
import NavigationComponent from './components/NavigationComponent';
import Navbar from './components/Navbar';
import MainContent from './components/MainContent';
import EditButton from './components/UI/EditButton';
import DeleteButton from './components/UI/DeleteButton';
import NewButton from './components/UI/NewButton';
import SelectField from './components/UI/SelectField';

Vue.component('admin-navigation', AdminNavigation);
Vue.component('navigation', NavigationComponent);
Vue.component('navbar', Navbar);
Vue.component('main-content', MainContent);
Vue.component('edit-button', EditButton);
Vue.component('delete-button', DeleteButton);
Vue.component('new-button', NewButton);
Vue.component('select-field', SelectField);