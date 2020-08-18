<template>
    <div class="container">
        <table>
            <tr style="border-top: 2px #bc9b9b solid">
                <td>
                    그룹 관리
                </td>
                <td>
                    <router-link tag="span" class="enter" to="/admin/group">
                        바로 가기
                    </router-link>
                </td>
            </tr>
            <tr>
                <td>
                    카테고리 관리
                </td>
                <td>
                    <router-link tag="span" class="enter" to="/admin/cat">
                        바로 가기
                    </router-link>
                </td>
            </tr>

            <tr>
                <td>
                    계정 관리
                </td>
                <td>
                    <span class="enter">
                        바로 가기
                    </span>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        name: "AdminMenu"
    }
</script>

<style scoped>
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
    }

    .container table tr {
        margin: 1%;
        border-bottom: 1px #bc9b9b solid;
    }

    .container table tr td {
        padding: 1%;
    }

    .enter {
        cursor: pointer;
        margin-right: 10%;
        text-align: center;
        float: right;
        padding: 1% 2%;
        width: 40%;
        background: #bc9b9b;
        border-radius: 15px;
    }

    .enter:hover {
        transition: 0.4s linear;
        background: #1a253f;
        color: #edd7c3;
    }
</style>
