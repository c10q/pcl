<template>
    <v-card dark tile class="side-bar">
        <ul class="nav-bar">
            <img src="../assets/images/Original.png" style="width: 100px; margin: 15% 10%;">
            <router-link tag="li" to="/">Home</router-link>
            <div style="border-bottom: 1.6px #f2b9ae groove; margin: 10% 0%"></div>
            <router-link tag="li" to="/about">About</router-link>
            <router-link tag="li" to="/posts/list">Posts</router-link>
            <router-link tag="li" to="/admin/menu">Admin</router-link>
            <router-link tag="li" to="/contact">Contact</router-link>
            <li v-if="loggedIn" @click="logout">Logout</li>
            <router-link v-else tag="li" to="/login">Login</router-link>
        </ul>
    </v-card>
</template>

<script>
    import * as auth from '../service/auth'

    export default {
        name: "SideBar",

        data() {
            return {
                loggedIn: auth.isLoggedIn()
            }
        },

        methods: {
            logout() {
                auth.logout()
            }
        }
    }
</script>

<style scoped>
    @font-face {
        font-family: 'PoiretOne';
        src: url('../assets/font/PoiretOne-Regular.ttf');
    }

    * {
        font-family: "PoiretOne", "hind", sans-serif;
    }

    .side-bar {
        position: fixed;
        float: left;
        height: 100%;
        background: #1a253f;
        color: #edd7c3;
        font-size: 1.7em;
        overflow-x: hidden;
        padding-left: 35px;
    }

    ul {
        list-style-type: none;
    }

    .nav-bar {

    }

    .nav-bar li {
        width: 100%;
        transition: .2s linear;
        margin-right: 100px;
        padding: 5% 3%;
    }

    .nav-bar li:hover,
    .nav-bar li.router-link-exact-active {
        background-color: #bc9b9b;
        cursor: pointer;
    }
</style>
