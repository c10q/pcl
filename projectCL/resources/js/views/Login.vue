<template>
    <div class="center">
        <div class="login-form">
            <div class="logo"><img src="../assets/images/logo.png" alt=""></div>

            <h6>Sign In</h6>

            <div class="social-media">
                <button class="fb" @click="sorry"><img src="../assets/images/fb.png"></button>
                <button class="google" @click="sorry"><img src="../assets/images/google.png"></button>
                <button class="kakao" @click="sorry"><img src="../assets/images/kakao.png"></button>
                <button class="naver" @click="sorry"><img src="../assets/images/naver.png"></button>
                <button class="insta" @click="sorry"><img src="../assets/images/instagram.png"></button>
            </div>

            <form @submit.prevent="login">
                <div class="textbox">
                    <input type="text" placeholder="Email" v-model="data.email">
                    <span class="check-message hidden">Required</span>
                </div>

                <div class="textbox">
                    <input type="password" placeholder="Password" v-model="data.password">
                    <span class="check-message hidden">Required</span>
                </div>

                <div class="options">
                    <label class="remember-me">
            <span class="checkbox">
              <input type="checkbox">
              <span class="checked"></span>
            </span>
                        Remember me
                    </label>

                    <a href="#">Forgot Your Password</a>
                </div>

                <input type="submit" value="Log In Now" class="login-btn" disabled>
                <div class="privacy-link">
                    <a href="#">Privacy Policy</a>
                </div>
            </form>

            <div class="dont-have-account">
                Don't have an Cloq account?
                <router-link tag="a" to="/signUp">Sign Up</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import $ from 'jquery'
    import * as auth from '../service/auth'
    import Vue from "vue";

    export default {
        name: "Login",

        data() {
            return {
                data: {
                    email: '',
                    password: '',
                    remember_me: false
                },
            }
        },

        methods: {
            sorry(){
                this.$toasted.show("준비중 입니다 ㅠ", {
                    theme: "toasted-primary",
                    position: "top-right",
                    duration : 1500,
                });
            },
            async login() {
                if(!this.data.email && !this.data.password) {
                    this.$toasted.show("입력 확인!", {
                        theme: "toasted-primary",
                        position: "top-right",
                        duration : 1500,
                        icon: 'check'
                    });
                }
                try {
                    await auth.login(this.data);
                    this.$router.go(-1);

                    this.$toasted.show("로그인 완료!", {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration : 5000
                    });
                } catch (err) {
                    switch (err.response.status) {
                        case 401:
                            this.errors = err.response.data.message;
                            this.$toasted.show("패스워드가 일치하지 않아요!", {
                                theme: "toasted-primary",
                                position: "top-right",
                                duration : 1500,
                                icon: 'check'
                            });
                            break;
                        case 422:
                            this.errors = err.response.data.errors;
                            this.$toasted.show("이메일 정보를 확인해주세요!", {
                                theme: "toasted-primary",
                                position: "top-right",
                                duration : 1500,
                                icon: 'check'
                            });
                            break;
                        case 500:
                            this.errors = err.response.data.message;
                            this.$toasted.show("error!", {
                                theme: "toasted-primary",
                                position: "top-right",
                                duration : 1500,
                                icon: 'check'
                            });
                            break;
                    }
                }
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
                var inputs = $(".textbox input");
                if (inputs[0].value != "" && inputs[1].value) {
                    $(".login-btn").attr("disabled", false);
                    $(".login-btn").addClass("active");
                } else {
                    $(".login-btn").attr("disabled", true);
                    $(".login-btn").removeClass("active");
                }
            });
        }

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

    .fb {
        background: #4267b2;
    }

    .google {
        background: #fff;
    }

    .kakao {
        background: #fcce00;
    }

    .naver {
        background: #107c10;
    }

    .insta {
        background: #f09433;
        background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
        background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );
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
