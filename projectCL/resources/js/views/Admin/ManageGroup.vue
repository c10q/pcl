<template>
    <div class="container">
        <span style="float: left; font-size: 1.8em; margin: 1%">
            Group
        </span>
        <router-link tag="span" class="add-cat" to="/admin/group/create">
            New
        </router-link>
        <table>
            <tr style="border-top: 2px #bc9b9b solid">
                <th>
                    Group Title
                </th>
                <th>
                    Category Cnt
                </th>
                <th>
                    Edit
                </th>
            </tr>
            <tr v-for="group in groups" :key="group.id">
                <td>
                    {{group.title}}
                </td>
                <td>
                    {{group.cats.length}}
                </td>
                <td>
                    <router-link tag="span" class="enter" :to="`/admin/group/${group.id}`">
                        수정
                    </router-link>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    import {http} from '../../service/http'
    export default {
        name: "manageGroup",

        created() {
            this.getGroups()
        },

        data() {
            return {
                groups: []
            }
        },

        methods: {
            getGroups(){
                http().get('/groups')
                    .then((res) => {
                        this.groups = res.data.data
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
        width: 70%;
        margin-top: 5%;
        border: 1px #bc9b9b solid;
        border-radius: 15px;
        padding: 32px;
        font-size: 1.3em;
    }

    .container table {
        width: 100%;
        font-family: "S-CoreDream-1Thin", "hind", sans-serif;
    }

    .container table tr {
        margin: 1%;
        border-bottom: 1px #bc9b9b solid;
    }

    .container table tr th {
        padding: 1%;
    }

    .container table tr td {
        padding: 1%;
        font-weight: bolder;
    }

    .enter {
        cursor: pointer;
        text-align: center;
        float: left;
        padding: 4% 2% 0 2%;
        width: 60%;
        background: #bc9b9b;
        border-radius: 15px;
    }

    .enter:hover {
        transition: 0.4s linear;
        background: #1a253f;
        color: #edd7c3;
    }

    .add-cat {
        float: right;
        font-size: 1.2em;
        cursor: pointer;
        text-align: center;
        width: 10%;
        background: #bc9b9b;
        border-radius: 15px;
        margin: 1%;
        padding: 1%
    }

    .add-cat:hover {
        transition: 0.1s;
        background: #1a253f;
        color: #edd7c3;
    }
</style>
