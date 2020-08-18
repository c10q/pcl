<template>
    <v-card color="#ffebd9" class="post-comments">
        <v-card-title>
            <div class="md-title">Comments</div>
        </v-card-title>

        <ul>
            <post-comment
                v-for="(comment, k) in comments"
                :key="k"
                :comment="comment"
                :new-reply="newReply"
                :reply-mode.sync="replyMode"
                @getPost="getPost"
            ></post-comment>
        </ul>

        <md-card-content>
            <md-field>
                <label>댓글</label>
                <md-textarea md-autogrow v-model="newComment.content"></md-textarea>
            </md-field>
        </md-card-content>

        <md-card-actions>
            <md-button @click="createComment" class="reg-btn">
                등록
            </md-button>
        </md-card-actions>

    </v-card>
</template>

<script>
    import PostComment from "./PostComment";
    import jwt from "jsonwebtoken";
    import {http} from "../../service/http";
    import {isLoggedIn} from "../../service/auth";
    export default {
        name: "PostComments",
        components: {PostComment},
        props: {
            comments: Array,
        },

        created() {
            if(localStorage.getItem('project-cloq-token')){
                this.newReply.user_id = jwt.decode(localStorage.getItem('project-cloq-token')).user.user.id
                this.newComment.user_id = jwt.decode(localStorage.getItem('project-cloq-token')).user.user.id
            }
        },

        data() {
            return {
                replyMode: '',
                newReply: {
                    content: '',
                    commentable_id: this.$route.params.id,
                    user_id: '',
                    parent_id: '',
                    commentable_type: 'App\/Article'
                },
                newComment: {
                    content: '',
                    commentable_id: this.$route.params.id,
                    user_id: '',
                    parent_id: '',
                    commentable_type: 'App\/Article'
                },
                disabled: false
            }
        },

        methods: {
            createComment() {
                if(!isLoggedIn()){
                    this.$toasted.show("로그인을 해주세요!", {
                        theme: "toasted-primary",
                        position: "top-right",
                        duration : 5000
                    });
                    return
                }
                http().post(`/articles/${this.$route.params.id}/comments`, this.newComment)
                    .then(() => {
                        this.getPost()

                        this.$toasted.show("댓글 등록 완료!", {
                            theme: "toasted-primary",
                            position: "top-right",
                            duration : 5000
                        });
                    })
                    .catch((err) => {
                        throw err
                    })
                this.$forceUpdate()
            },
            getPost(){
                this.$emit('getPost')
            }
        }
    }
</script>

<style scoped>

    ul {
        list-style-type: none;
        padding-left: 40px;
    }

    .post-comments {
        width: 100%;
        float: left;
        height: auto;
        margin-top: 1%
    }

    .reg-btn {
        font-size: 1.4em;
        background: #1a253f;
        color: #ffebd9;
        font-weight: bolder;
        margin: 1%;
    }
</style>
