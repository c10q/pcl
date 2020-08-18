<template>
    <div>
        <side-bar/>
        <v-card max-width="1200px" color="#edd7c3" class="contact-box" flat>
            <v-card-title> <h2> CONTACT </h2> </v-card-title>

            <v-divider></v-divider>

            <v-card-text>
                <v-row v-for="(item, k) in items" :key="k">
                    <v-col>
                        <h2><v-icon x-large>{{item.icon}}</v-icon> {{item.title}}</h2>
                    </v-col>
                    <v-col>
                        <p style="font-size: 24px"> {{item.val}}</p>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
    import SideBar from "../../components/SideBar";
    export default {
        name: "Contact",
        components: {SideBar},
        data() {
            return {
                items: [
                    {
                        title: 'EAMIL',
                        icon: 'mdi-email',
                        val: 'cloq@kakao.com'
                    },
                    {
                        title: 'GITHUB ID',
                        icon: 'mdi-github',
                        val: 'c10q'
                    },
                    {
                        title: 'FACEBOOK ID',
                        icon: 'mdi-facebook',
                        val: 'noh0907'
                    },
                    {
                        title: 'INSTAGRAM ID',
                        icon: 'mdi-instagram',
                        val: 'nohkwanok'
                    },
                ]
            }
        }
    }
</script>

<style scoped>
    .contact-box {
        margin-left: 215px;
        padding: 70px;
    }
</style>
