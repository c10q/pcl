<template>
    <div style="height: auto">
        <div class="div1">
            <div class="center">
                <img src="../assets/images/Original.png" alt="">
            </div>
        </div>
        <div class="div2">
            <div class="nav-home">
                <ul>
                    <router-link tag="li" to="/about">About</router-link>
                    <router-link tag="li" to="/posts/list">Posts</router-link>
                    <router-link tag="li" to="/admin/menu">Admin</router-link>
                    <router-link tag="li" to="/login">Contact</router-link>
                    <li v-if="loggedIn" @click="logout">Logout</li>
                    <router-link v-else tag="li" to="/login">Login</router-link>
                </ul>
            </div>
            <div class="content-box">
                <p class="f4">
                    Hello World!
                </p>
                <p class="f2">
                    반갑습니다 :)
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import * as auth from '../service/auth'

    export default {

        name: "Home",

        data(){
            return {
                loggedIn: auth.isLoggedIn(),
                admin: auth.admin()
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

    @font-face {
        font-family: 'S-CoreDream-1Thin';
        src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_six@1.2/S-CoreDream-1Thin.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }


    * {
        font-family: "PoiretOne", "hind", sans-serif;
    }

    .div1 {
        float: left;
        width: 40%;
        height: 100%;
        background: #1a253f;
    }

    .center {
        margin: 0% 35%;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .center img {
        width: 100%;
        display: flex;
        align-items: center;
    }

    .div2 {
        float: right;
        width: 60%;
        height: 100%;
        background: #edd7c3;
    }

    .nav-home {
        text-align: right;
        margin-left: 15%;
        padding: 30px;
        line-height: 80px;
    }

    .nav-home ul {
        float: right;
    }

    .nav-home ul li {
        display: inline;
        margin: 10px;
        padding: 10px 15px;
        font-size: 1.7em;
        border-radius: 15px;
        transition: .2s linear;
    }

    .nav-home ul li:hover {
        background-color: #bc9b9b;
        cursor: pointer;
    }

    .content-box {
        margin: 20% 10%;
    }

    .f4 {
        font-size: 4em;
    }

    .f2 {
        margin-top: 10%;
        font-family: "S-CoreDream-1Thin", sans-serif;
        font-size: 2em;
        font-weight: lighter;
    }


</style>
