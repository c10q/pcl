<template>
    <v-card class="content-box" flat color="#edd7c3" width="80%">
        <v-row>
            <v-col cols="9">
                <v-card color="#ffebd9">
                    <v-card-title>{{title}}</v-card-title>
                    <router-view :posts="posts"></router-view>
                </v-card>
            </v-col>
            <v-col cols="3">
                <v-card color="#ffebd9" class="mx-auto">
                    <md-list md-expand-single="expandSingle">
                        <md-list-item v-for="(group, k) in $store.state.groups" :key="k" md-expand>
                            <span class="md-list-item-text">
                                {{group.title}}
                            </span>
                            <md-list slot="md-expand">
                                <md-list-item v-for="(cat, l) in group.cats" :key="l" class="md-inset" @click="changeCat(cat.id, group.title, cat.title)">
                                    {{cat.title}} ( {{cat.articles_count}} )
                                </md-list-item>
                            </md-list>
                        </md-list-item>
                    </md-list>
                </v-card>
            </v-col>
        </v-row>
    </v-card>
</template>

<script>
    import {http} from '../../service/http'

    export default {
        name: "PostList",

        created() {
            this.getPosts();
        },

        computed: {
            title(){
                let title = 'All'
                if(this.selected.group && this.selected.cat) {
                    title = `${this.selected.group} / ${this.selected.cat}`
                }

                return title
            }
        },

        data() {
            return {
                posts: [],
                params: {
                    filters: {
                        cat: {
                            key: 'cat_id',
                            val: ''
                        }
                    },
                },
                selected: {
                    group: '',
                    cat: ''
                }
            }
        },

        methods: {

            getPosts() {
                let loading = this.$toasted.show("Loading...", {
                    theme: "toasted-primary",
                    position: "top-right",
                    duration : null,
                    icon: 'timer-sand-empty'
                });
                http().get(`/articles`, {params: this.params})
                    .then((res) => {
                        this.posts = res.data.data
                        loading.text('로딩 완료 !').goAway(700);
                    })
                    .catch((err) => {
                        throw err
                    })
            },

            changeCat(id, group, cat) {
                this.selected = {
                    group: group,
                    cat: cat
                }
                this.params.filters.cat.val = id
                if(this.$route.params.id) this.$router.push('/posts/list')
                this.getPosts()
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
    }

    .content-box {
        margin-left: 60px;
    }


</style>
