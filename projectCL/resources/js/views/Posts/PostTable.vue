<template>
    <v-simple-table height="750px" style="width: 100%; background: #ffebd9">
        <template v-slot:default>
            <thead>
            <tr style="text-align: left">
                <th class="text-left">No.</th>
                <th class="text-left">Title</th>
                <th class="text-left">Author</th>
                <th class="text-left">Posted At</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(post, k) in posts" :key="k" @click="postInfo(post.id)">
                <td>{{ k + 1 }}</td>
                <td>{{ post.title }}</td>
                <td>{{ post.user.name }}</td>
                <td>{{ post.created_at.substr(0, 10) }}</td>
            </tr>
            </tbody>
        </template>
    </v-simple-table>
</template>

<script>
    export default {
        name: "PostTable",

        props: {
            posts: Array,
        },

        methods: {
            postInfo(id) {
                this.$router.push(`/posts/list/${id}`)
            },
        }
    }
</script>

<style scoped>

</style>

