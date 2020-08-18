<template>
    <div>
        <side-bar></side-bar>
        <div class="div2">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import SideBar from "../../components/SideBar";
    import {http} from '../../service/http'
    export default {
        name: "Posts",
        components: {SideBar},
        created() {
            this.getPost()
        },

        methods: {
            getPost() {
                http().get('/groups')
                .then((res) => {
                    this.$store.commit('SET_GROUP_INFO', res.data.data);
                })
                .catch((err) => {
                    throw err
                })
            }
        }
    }
</script>

<style scoped>

    @font-face {
        font-family: 'PoiretOne';
        src: url('../../assets/font/PoiretOne-Regular.ttf');
    }

    * {
        font-family: "PoiretOne", "hind", sans-serif;
    }

    .div2 {
        background: #edd7c3;
        margin-left: 200px;
        padding-top: 3%;
    }


</style>
