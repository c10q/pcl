<template>
    <div class="center">
        <div class="login-form">
            <div class="logo"><img src="../assets/images/logo.png" alt=""></div>

            <h6>Sign Up</h6>

            <form @submit.prevent="register">
                <div class="textbox">
                    <input type="text" placeholder="Email" v-model="data.email">
                    <span class="check-message hidden">Required</span>
                </div>

                <div class="textbox">
                    <input type="text" placeholder="Username" v-model="data.name">
                    <span class="check-message hidden">Required</span>
                </div>

                <div class="textbox">
                    <input type="password" placeholder="Password" v-model="data.password">
                    <span class="check-message hidden">Required</span>
                </div>

                <div class="textbox">
                    <input type="password" placeholder="Confirm Password" v-model="data.password_confirmation">
                    <span class="check-message hidden">Required</span>
                </div>

                {{data}}

                <input type="submit" value="Sign Up" class="login-btn" disabled>
                <div class="privacy-link">
                    <a href="#">Privacy Policy</a>
                </div>
            </form>

            <div class="dont-have-account">
                have an Cloq account?
                <router-link tag="a" to="/login">Login</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import $ from 'jquery'
    import {http} from '../service/http'

    export default {
        name: "Register",

        data() {
            return {
                data: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },

                errors: {}
            }
        },

        methods: {
            async register() {
                await http().post('/auth/register', this.data)
                    .then((res) => {
                        console.log(res.data.message)
                    })
                    .catch((err) => {
                        switch (err.response.status) {
                            case 422:
                                this.errors = err.response.data.errors;
                                break;
                            case 500:
                                this.errors = err.response.data.message;
                                break;
                        }
                    })
            }
        },

        mounted() {
            $(".textbox input").focusout(function () {
                if ($(this).val() == "") {
                    $(this).siblings().removeClass("hidden");
                    $(this).css("background", "#554343");
                } else {
                    $(this).siblings().addClass("hidden");
                    $(this).css("background", "#484848");
                }
            });

            $(".textbox input").keyup(function () {
                let inputs = $(".textbox input");
                if (inputs[0].value != "" && inputs[1].value && inputs[2].value && inputs[3].value) {
                    $(".login-btn").attr("disabled", false);
                    $(".login-btn").addClass("active");
                } else {
                    $(".login-btn").attr("disabled", true);
                    $(".login-btn").removeClass("active");
                }
            });
        } // jquery

    }
</script>

<style scoped>
    @font-face {
        font-family: 'RobotoMono';
        src: url('../assets/font/RobotoMono-Thin.ttf');
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "hind", sans-serif;
        text-decoration: none;
    }

    .center {
        background: #1a253f;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-form {
        width: 470px;
        background: #121212;
        padding: 30px 60px;
    }

    .logo {
        height: 120px;
        text-align: center;
    }

    .logo img {
        height: 100px;
    }

    .social-media {
        display: flex;
        margin: 30px 0;
    }

    .social-media button {
        height: 50px;
        width: 100px;
        margin-right: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
        transition: .3s linear;
    }

    .social-media button:last-child {
        margin: 0;
    }

    .social-media button img {
        width: 20px;
    }

    .social-media button:hover {
        opacity: .7;
    }

    .login-form h6 {
        color: #f1f1f1;
        font-size: 15px;
        text-transform: uppercase;
        font-weight: 500;
    }

    .textbox {
        width: 100%;
        height: 50px;
        position: relative;
        margin-top: 15px;
    }

    .textbox input {
        width: 100%;
        height: 50px;
        border: none;
        background: #2b2b2b;
        padding: 0 15px;
        font-size: 16px;
        outline: none;
        color: #f4f4f4;
    }

    .textbox input:focus {
        background: #484848 !important;
    }

    .check-message {
        position: absolute;
        top: 50%;
        right: 10px;
        color: #fff;
        text-transform: uppercase;
        transform: translateY(-50%);
    }

    .textbox input:focus + .check-message {
        display: none;
    }

    .options {
        margin-top: 15px;
        color: #f4f4f480;
        overflow: hidden;
        font-size: 14px;
    }

    .remember-me {
        float: left;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .checkbox {
        display: inline-block;
        width: 20px;
        height: 20px;
        background: #484848;
        margin-right: 15px;
        position: relative;
    }

    .checkbox input {
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .checked {
        position: absolute;
        left: 8px;
        top: 4px;
        width: 5px;
        height: 10px;
        border: solid #fff;
        border-width: 0 1px 1px 0;
        transform: rotate(45deg);
        display: none;
    }

    .checkbox input:checked + .checked {
        display: block;
    }

    .options a {
        color: #f4f4f480;
        font-size: 14px;
        float: right;
    }

    .login-btn {
        width: 100%;
        height: 50px;
        margin-top: 30px;
        background: #191919;
        border: none;
        outline: none;
        cursor: pointer;
        text-transform: uppercase;
        font-weight: 700;
        transition: .3s linear;
    }

    .login-btn.active {
        background: #f2b9ae;
        color: #1a253f;
    }

    .login-btn.active:hover {
        opacity: .7;
    }

    .hidden {
        display: none;
    }

    .privacy-link {
        text-align: center;
        margin-top: 35px;
    }

    .privacy-link a {
        color: #f1f1f1;
        font-size: 14px;
    }

    .dont-have-account {
        font-size: 14px;
        text-align: center;
        color: #f4f4f480;
        margin: 20px 0;
    }

    .dont-have-account a {
        color: #f1f1f1;
    }

    @media screen and (max-width: 470px) {
        body {
            background: #202020;
        }

        .login-form {
            width: 100%;
            padding: 0 15px;
        }
    }

</style>
