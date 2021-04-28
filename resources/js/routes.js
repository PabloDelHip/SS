import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

//Index
import Index from './views/index.vue' 

// Login section
import Login from "./views/Login/LoginComponent.vue";
import RestablecerContrasena from "./views/Login/RestorePassword.vue";
import NuevaContrasena from "./views/Login/NewPassword.vue";

//Dashboard section
import Overview from "./views/Dashboard/OverviewComponent.vue";

//Users section
import UsersIndex from "./views/Users/index.vue";
import Userslist from "./views/Users/Userslist.vue";
import UserView from "./views/Users/UserView.vue";
import UserProfile from "./views/Users/profileView.vue";
import PermitsUsers from "./views/Users/permissionUsers.vue";

//Customer section
import Customer from './views/Customers/TableView.vue'
import ProfileCustomer from './views/Customers/profileView.vue'

// Error section
import Error from "./views/Error/Error.vue";
import InternalError from "./views/Error/InternalError.vue";
import NotFound from "./views/Error/NotFound.vue";
import NotAuthorized from "./views/Error/NotAuthorized.vue";

//Vendors section
import Vendors from './views/vendors/index.vue'
import VendorComponent from './views/vendors/VendorComponent.vue'
import VendorsList from './views/vendors/listView.vue'
import VendorsProfile from './views/vendors/profile.vue'
import VendorsContacts from './views/vendors/Contacts/index.vue'
import VendorsContactsList from './views/vendors/Contacts/contactslist.vue'
import VendorsContactsView from './views/vendors/Contacts/contactsview.vue'

//Case section
import CasesHistory from './views/Cases/timeLineView.vue'

export default new Router({
    linkExactActiveClass: "active",
    routes: [{
            path: "*",
            redirect: { name: "Overview" },
        },
        {
            path: "/login",
            name: "Login",
            component: Login,
        },
        {
            path: "/restablecer-contrasena",
            name: "RestablecerContrasena",
            component: RestablecerContrasena,
        },
        {
            path: "/nueva-contrasena/:token?",
            name: "NuevaContrasena",
            component: NuevaContrasena,
            props: true,
        },
        {
            path: "/users",
            name: "Users",
            component: UsersIndex,
            children: [{
                    path: "",
                    name: "ListUser",
                    component: Userslist,
                },
                {
                    path: "create",
                    name: "CreateUser",
                    component: UserView,
                },
                {
                    path: "edit/:id",
                    name: "EditUser",
                    component: UserView,
                    props: true,
                },
                {
                    path: "profile/:id",
                    name: "perfilUsuario",
                    component: UserProfile,
                    props: true,
                },
                {
                    path: "permissions/:id",
                    name: "permisosUser",
                    component: PermitsUsers,
                    props: true,
                },
            ],
        },
        {
            path: "/contacts",
            name: "Contacts",
            component: Customer,
        },
        {
            path: '/contacts/profile/:id',
            name: 'profileCustomer',
            component: ProfileCustomer,
            props: true
        },
        {
            path: "/error",
            name: "error",
            component: Error,
            children: [{
                    path: "",
                    name: "internalError",
                    component: InternalError,
                },
                {
                    path: "notfound",
                    name: "notfound",
                    component: NotFound,
                },
                {
                    path: "notauthorized",
                    name: "notauthorized",
                    component: NotAuthorized,
                },
            ]
        },
        {
            path: "/vendors",
            name: "Vendors",
            component: Vendors,
            children: [{
                    path: "",
                    name: "ListVendor",
                    component: VendorsList,
                },
                {
                    path: "create",
                    name: "CreateVendor",
                    component: VendorComponent,
                },
                {
                    path: "edit/:id",
                    name: "EditVendor",
                    component: VendorComponent,
                    props: true,
                },
                {
                    path: "profile/:id",
                    name: "profileVendor",
                    component: VendorsProfile,
                    props: true,
                },
                {
                    path: "contacts",
                    name: "contactsVendor",
                    component: VendorsContacts,
                    children: [{
                            path: ":id",
                            name: "listContactsVendor",
                            component: VendorsContactsList,
                            props: true,
                        },
                        {
                            path: ":id/create",
                            name: "createContactsVendor",
                            component: VendorsContactsView,
                            props: true,
                        },
                        {
                            path: ":id/edit/:contactId",
                            name: "editContactsVendor",
                            component: VendorsContactsView,
                            props: true,
                        },
                    ]
                },
            ]
        },
        {
            path: "/cases",
            name: "cases",
            component: Index,
            children:[
                {
                    path: "history/:id_case",
                    name: "caseHistory",
                    component: CasesHistory,
                    props: true
                }
            ]
        },
        {
            path: "/overview",
            name: "Overview",
            component: Overview,
        },
    ],
    mode: "history",
});