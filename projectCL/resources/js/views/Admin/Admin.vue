<template>
    <div>
        <side-bar></side-bar>
        <div style="margin-left: 200px">
            <p class="title">Admin Page</p>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import SideBar from "../../components/SideBar";
    export default {
        name: "Admin",
        components: {SideBar}
    }
</script>

<style scoped>
    @font-face {
        font-family: 'PoiretOne';
        src: url('../../assets/font/PoiretOne-Regular.ttf');
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

    .title {
        padding-top: 5%;
        border-radius: 15px;
        text-align: center;
        font-size: 1.9em;
    }
</style>
