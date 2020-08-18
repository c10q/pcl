<template>
    <div class="container">
        <p>
            {{mode}} Group
        </p>
        <tr>
            <td>
                <md-field>
                    <label>Input Title</label>
                    <md-input v-model="group.title"></md-input>
                </md-field>
            </td>
        </tr>
        <div style="float: right; margin: 5%">
            <md-button v-if="mode === 'New'" @click="createGroup">Create</md-button>
            <md-button v-if="mode === 'Edit'" @click="updateGroup">Edit</md-button>
            <md-button>Cancel</md-button>
        </div>
    </div>
</template>

<script>
    import {http} from '../../service/http'

    export default {
        name: "manageGroupInfo",

        created() {
            if(this.$route.params.id) {
                this.getGroup();
                this.mode = 'Edit';
            }
        },

        data() {
            return {
                mode: 'New',
                group: {
                    id: '',
                    title: '',
                },
            }
        },

        methods: {
            getGroup() {
                http().get(`/groups/${this.$route.params.id}`)
                    .then((res) => {
                        this.group = res.data.data
                    })
                    .catch((err) => {
                        throw err
                    })
            },
            createGroup() {
                http().post('/groups', this.group)
                    .then((res) => {
                        console.log(res)
                        this.$router.push('/admin/group')
                    })
                    .catch((err) => {
                        throw err
                    })
            },
            updateGroup() {
                http().put(`/groups/${this.$route.params.id}`, this.group)
                    .then((res) => {
                        console.log(res)
                        this.$router.push('/admin/group')
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
        font-family: 'S-CoreDream-1Thin';
        src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_six@1.2/S-CoreDream-1Thin.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }

    .container {
        font-family: "S-CoreDream-1Thin", sans-serif;
        font-weight: bolder;
        width: 70%;
        margin-top: 5%;
        border: 1px #bc9b9b solid;
        border-radius: 15px;
        padding: 32px;
        font-size: 1.3em;
    }

    .container tr {
        margin: 1%;
        border-bottom: 1px #bc9b9b solid;
    }

    .container tr td {
        padding: 1%;
    }
</style>

