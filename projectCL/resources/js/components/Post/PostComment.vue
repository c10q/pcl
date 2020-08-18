<template>
    <li>
        <md-avatar>
            <img src="https://bucketpcl.s3.ap-northeast-2.amazonaws.com/user/1024px-User_font_awesome.svg.png" alt="CL">
        </md-avatar>

        <div class="md-list-item-text" style="display: inline-flex; padding-left: 3%;" >
            <p style="font-weight: bolder; font-size: 1.1em">{{comment.user.name}}</p>
            <p>{{comment.content}}</p>
        </div>

        <md-card-actions>
            <md-button @click="$emit('update:replyMode', comment.id)">
                reply
            </md-button>
        </md-card-actions>

        <md-field v-if="replyMode === comment.id" style="width: 95%">
            <label>답글</label>
            <md-textarea md-autogrow v-model="newReply.content"></md-textarea>
        </md-field>

        <md-card-actions v-if="replyMode === comment.id">
            <md-button class="reply-btn" @click.once="createReply">
                확인
            </md-button>
        </md-card-actions>

        <ul v-for="(reply, k) in comment.replies" :key="k">
            <li>
                <md-avatar>
                    <img src="https://bucketpcl.s3.ap-northeast-2.amazonaws.com/user/1024px-User_font_awesome.svg.png" alt="CL">
                </md-avatar>

                <div class="md-list-item-text" style="display: inline-flex; padding-left: 3%;" >
                    <p style="font-weight: bolder; font-size: 1.1em">{{reply.user.name}}</p>
                    <p>{{reply.content}}</p>
                </div>

                <md-card-actions>
                    <md-button disabled="">

                    </md-button>
                </md-card-actions>

            </li>
        </ul>
        <v-dialog/>
    </li>
</template>

<script>
    import {http} from "../../service/http";
    import {isLoggedIn} from "../../service/auth";

    export default {
        name: "PostComment",

        props: {
            comment: Object,
            replyMode: null,
            newReply: Object
        },

        watch: {
            replyMode(value) {
                this.newReply.content = ''
                this.newReply.parent_id = value
                this.$store.commit('SET_REPLY_MODE', value)
            }
        },

        methods: {
            createReply() {
                if(!isLoggedIn()){
                    this.$toasted.show("로그인을 해주세요!", {
                        theme: "toasted-primary",
                        position: "top-right",
                        duration : 5000
                    });
                    return
                }
                http().post(`/articles/${this.$route.params.id}/comments`, this.newReply)
                    .then(() => {
                        this.$emit('getPost')

                        this.$toasted.show("댓글 등록 완료!", {
                            theme: "toasted-primary",
                            position: "top-right",
                            duration : 5000
                        });

                        this.$emit('update:replyMode', '')
                    })
                    .catch((err) => {
                        throw err
                    })
            },
        }
    }
</script>

<style scoped>
    ul {
        list-style-type: none;
        padding-left: 40px;
    }
    .reply-btn {
        background: #1a253f;
        color: #ffebd9;
        margin-right: 5%;
        font-weight: bolder;
        font-size: 1.2em
    }
</style>
