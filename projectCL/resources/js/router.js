import Vue from 'vue';
import Router from 'vue-router';
import Home from "./views/Home";
import Login from "./views/Login";
import About from "./views/About/About"
import Contact from "./views/Contact/Contact"
import Posts from "./views/Posts/Posts";
import PostList from "./views/Posts/PostList";
import PostCreate from "./views/Posts/PostCreate";
import PostTable from "./views/Posts/PostTable";
import Post from "./views/Posts/Post";
import SignUp from "./views/SignUp";
import Admin from "./views/Admin/Admin";
import AdminMenu from "./views/Admin/AdminMenu";
import ManageGroup from "./views/Admin/ManageGroup";
import ManageGroupInfo from "./views/Admin/ManageGroupInfo";
import ManageCategory from "./views/Admin/ManageCategory";
import ManageCategoryInfo from "./views/Admin/ManageCategoryInfo";
import * as auth from './service/auth';

Vue.use(Router)

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/signUp',
        name: 'signUp',
        component: SignUp
    },

    {
        path: '/about',
        name: 'About',
        component: About
    },

    {
        path: '/admin',
        component: Admin,
        children: [
            {
                path: 'menu',
                name: 'adminMenu',
                component: AdminMenu
            },
            {
                path: 'group',
                name: 'manageGroup',
                component: ManageGroup
            },
            {
                path: 'group/create',
                name: 'createGroup',
                component: ManageGroupInfo
            },
            {
                path: 'group/:id',
                name: 'editGroup',
                component: ManageGroupInfo
            },
            {
                path: 'cat',
                name: 'manageCat',
                component: ManageCategory
            },
            {
                path: 'cat/create',
                name: 'createCatInfo',
                component: ManageCategoryInfo
            },
            {
                path: 'cat/:id',
                name: 'editCatInfo',
                component: ManageCategoryInfo
            },
        ],
        beforeEnter(to, from, next) {
            if(!auth.admin()){
                if(!auth.isLoggedIn()){
                    Vue.toasted.show("관리자 권한 필요!", {
                        theme: "toasted-primary",
                        position: "top-right",
                        duration : 1500,
                        icon: 'fingerprint'
                    });
                } else {
                    Vue.toasted.show("관리자 권한 필요!", {
                        theme: "toasted-primary",
                        position: "top-right",
                        duration : 1500,
                        icon: 'fingerprint'
                    });
                }
            } else {
                next()
            }
        }
    },

    {
        path: '/contact',
        name: 'Contact',
        component: Contact
    },

    {
        path: '/posts',
        component: Posts,
        children: [
            {
                path: 'list',
                component: PostList,
                children: [
                    {
                        path: '/',
                        name: 'postList',
                        component: PostTable
                    },
                    {
                        path: ':id',
                        name: 'postContent',
                        component: Post
                    }
                ]
            },
            {
                path: 'create',
                name: 'postCreate',
                component: PostCreate,
                beforeEnter(to, from, next) {
                    if(!auth.admin()){
                        if(!auth.isLoggedIn()){
                            Vue.toasted.show("관리자 권한 필요!", {
                                theme: "toasted-primary",
                                position: "top-right",
                                duration : 1500,
                                icon: 'fingerprint'
                            });
                        } else {
                            Vue.toasted.show("관리자 권한 필요!", {
                                theme: "toasted-primary",
                                position: "top-right",
                                duration : 1500,
                                icon: 'fingerprint'
                            });
                        }

                    } else {
                        next()
                    }
                }
            },
        ]
    },

];

const router = new Router({
    mode: 'history',
    routes : routes
});

export default router;
