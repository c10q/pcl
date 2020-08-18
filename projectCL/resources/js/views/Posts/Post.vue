<template>
    <div>
        <v-card-title>
            <div class="md-title">{{post.title}}</div>
        </v-card-title>
        <v-card-text>
            <div class="md-subhead">{{posted_at}}</div>
        </v-card-text>

        <div class="output ql-snow">
            <div class="ql-editor" v-html="post.content"></div>
        </div>


        <post-comments :comments="comments" @getPost="getPostOnly"></post-comments>

    </div>
</template>

<script>
    import {http} from '../../service/http'
    import PostComments from "../../components/Post/PostComments";

    export default {
        name: "Post",

        components: {
            PostComments
        },

        created() {
            this.getPost()
        },

        computed: {
            posted_at() {
                let date = '';
                if (this.post.created_at) {
                    date = this.post.created_at.split('T')[0] + ' ' + this.post.created_at.split('T')[1].substr(0, 8) + ' 작성';
                }
                return date
            }
        },

        data() {
            return {
                post: {
                    title: '',
                    created_at: '',
                    content: '',
                },
                comments: [],
            }
        },

        methods: {
            getPost() {
                let loading = this.$toasted.show("Loading...", {
                    theme: "toasted-primary",
                    position: "top-right",
                    duration : null,
                    icon: 'timer-sand-empty'
                });

                this.getPostOnly()

                loading.text('로딩 완료 !').goAway(700);
            },
            getPostOnly() {
                http().get(`/articles/${this.$route.params.id}`)
                    .then((res) => {
                        this.post = res.data.data
                        this.comments = res.data.comments
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
        font-family: 'GmarketSansLight';
        src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_2001@1.1/GmarketSansLight.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }

    * {
        font-family: 'GmarketSansLight', sans-serif;
        background: #ffebd9;
    }

</style>
