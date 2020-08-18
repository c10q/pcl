<template>
    <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2"
                :class="{ 'on-hover': hover }"
                width="125px"
                style="margin: 10px 30px"
                dark
        >

            <v-img
                width="125px"
                height="125px"
                :src="item.path"
                class="align-content-center"
            >
            </v-img>

            <p style="text-align: center; padding: 5px; font-size: 15px">{{item.desc}}</p>
        </v-card>
    </v-hover>
</template>

<script>
    export default {
        name: "AboutLogo",

        props: {
            item: Object
        }
    }
</script>

<style scoped>
    .v-card {
        transition: opacity .2s ease-in-out;
    }

    .v-card:not(.on-hover) {
        opacity: 0.6;
    }
</style>
