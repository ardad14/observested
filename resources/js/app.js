require('./bootstrap');

window.Vue = require('vue').default;


import 'material-icons/iconfont/material-icons.css';
import VueI18n from 'vue-i18n'

Vue.use(VueI18n);

const messages = {
    en: {
        navbar: {
            analytics: 'Analytics',
            clients: 'Clients',
            workers: 'Workers',
            exit: 'Exit'
        },
        analytics: {
            dataTitle: 'Raw data',
            table: {
                clients: 'Client',
                money: 'Money',
                date: 'Date'
            },

            sidebar: {
                general: 'General',
                month: 'Month',
                clients: 'Clients',
                goods: 'Goods'
            },
            general: {
                title: 'General'
            },
            month: {
                title: 'Month'
            },
            clients: {
                title: 'Clients'
            },
            goods: {
                title: 'Goods',
                good: 'Good'
            }
        },
        clients: {
            title: 'Clients',
            table: {
                name: `Name`,
                surname: 'Surname',
                age: 'Age',
                spendMoney: 'Spend money',
                change: 'Change'
            }
        },
        workers: {
            title: 'Workers',
            table: {
                name: `Name`,
                surname: 'Surname',
                email: 'Email',
                position: 'Role'
            },
            addNewWorker: 'Add new worker'
        }
    },
    ua: {
        navbar: {
            analytics: 'Аналітика',
            clients: 'Клієнти',
            workers: 'Працівники',
            exit: 'Вийти'
        },
        analytics: {
            dataTitle: 'Необроблені дані',
            table: {
                clients: 'Клієнт',
                money: 'Гроші',
                date: 'Дата'
            },

            sidebar: {
                general: 'Загальна',
                month: 'Місячна',
                clients: 'Клієнти',
                goods: 'Товари'
            },
            general: {
                title: 'Загальна'
            },
            month: {
                title: 'Місячна'
            },
            clients: {
                title: 'Клієнти'
            },
            goods: {
                title: 'Товари',
                good: 'Товар'
            }

        },
        clients: {
            title: 'Клієнти',
            table: {
                name: `Ім'я`,
                surname: 'Прізвище',
                age: 'Вік',
                spendMoney: 'Витрачені кошти',
                change: 'Змінити'
            }
        },
        workers: {
            title: 'Працівники',
            table: {
                name: `Ім'я`,
                surname: 'Прізвище',
                email: 'Пошта',
                position: 'Позиція'
            },
            addNewWorker: 'Додати нового працівника'
        }
    }
}

// Create VueI18n instance with options
const i18n = new VueI18n({
    locale: 'ua', // set locale
    messages, // set locale messages
})

//defined as global component
Vue.component('V-MaterialIcon', require('vue-materials-icon/MaterialIcon').default);

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('main-page', require('./components/Main.vue').default);
Vue.component('create-place', require('./components/CreatePlace.vue').default);

Vue.component('clients', require('./components/Clients.vue').default);
Vue.component('edit-client', require('./components/EditClient.vue').default);

Vue.component('workers', require('./components/Wokers.vue').default);
Vue.component('add-worker', require('./components/AddWorker.vue').default);

Vue.component('sign-up', require('./components/SignUp.vue').default);
Vue.component('sign-in', require('./components/SignIn.vue').default);

Vue.component('analytics-sidebar', require('./components/analytics/AnalyticsSidebar.vue').default);
Vue.component('analytics-general', require('./components/analytics/AnalyticsGeneral.vue').default);
Vue.component('analytics-month', require('./components/analytics/AnalyticsMonth.vue').default);
Vue.component('analytics-clients', require('./components/analytics/AnalyticsClients.vue').default);
Vue.component('analytics-goods', require('./components/analytics/AnalyticsGoods.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    i18n,
    el: '#app',
});

const navbar = new Vue({
    i18n,
    el: '#navbar',
})

if(localStorage.getItem(' ') !== null) {
    i18n.locale = localStorage.getItem('locale');
}
