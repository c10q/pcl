<template>
    <div class="container">
        <p>
            {{mode}} Category
        </p>
        <tr>
            <td>
                <md-field>
                    <label>Input Title</label>
                    <md-input v-model="cats.title"></md-input>
                </md-field>
            </td>
        </tr>
        <tr>
            <td>
                <md-field>
                    <label for="group">Select Group</label>
                    <md-select v-model="cats.group_id" name="group" id="group">
                        <md-option v-if="groups" v-for="group in groups" :key="group.id" :value="group.id">
                            {{group.title}}
                        </md-option>
                    </md-select>
                </md-field>
            </td>
        </tr>
        <div style="float: right; margin: 5%">
            <md-button v-if="mode === 'New'" @click="createCat">Create</md-button>
            <md-button v-if="mode === 'Edit'" @click="updateCat">Edit</md-button>
            <md-button>Cancel</md-button>
        </div>
    </div>
</template>

<script>
    import {http} from '../../service/http'

    export default {
        name: "manageCategoryInfo",

        created() {
            if(this.$route.params.id) {
                this.getCat();
                this.mode = 'Edit';
            }
            this.getGroups();
        },

        data() {
            return {
                mode: 'New',
                cats: {
                    id: '',
                    title: '',
                    group_id: ''
                },
                groups: []
            }
        },

        methods: {
            getCat() {
                http().get(`/cats/${this.$route.params.id}`)
                    .then((res) => {
                        this.cats = res.data.data
                    })
                    .catch((err) => {
                        throw err
                    })
            },
            getGroups() {
                http().get('/groups')
                    .then((res) => {
                        this.groups = res.data.data
                    })
                    .catch((err) => {
                        throw err
                    })
            },
            createCat() {
                http().post('/cats', this.cats)
                    .then((res) => {
                        this.groups = res.data.data
                        this.$router.push('/admin/cat')
                    })
                    .catch((err) => {
                        throw err
                    })
            },
            updateCat() {
                http().put(`/cats/${this.$route.params.id}`, this.cats)
                    .then((res) => {
                        this.groups = res.data.data
                        this.$router.push('/admin/cat')
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

