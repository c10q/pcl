<template>
    <div>
        <side-bar></side-bar>
        <v-card color="#edd7c3" class="about-box" flat>
            <v-card-title><h2>반가워요! 저는 개발자 노관옥입니다 :)</h2></v-card-title>

            <v-divider></v-divider>

            <v-card-text class="about-content">
                제가... 개발 공부를 시작한게 2019년 7월쯤인데 벌써 9달이나 지났어요
            </v-card-text>

            <v-card-text class="about-content">
                9달만에 드디어..!! 포트폴리오를 하나 만들게 됐네요 !
            </v-card-text>

            <br>

            <v-card-title><h2>왜 CLOQ 인가요?</h2></v-card-title>

            <v-divider></v-divider>

            <v-card-text class="about-content">
                저는 고등학생 때 항상 하던 말이 있었어요. 그게 뭐였냐면 "아, 내 컨셉은 클린이야" 였어요.
            </v-card-text>

            <v-card-text class="about-content">
                이게 나름 저의 신념이었는데 '담배 x', '클럽 x', '욕 x' 이런 것들이 포함됐었죠.
            </v-card-text>

            <v-card-text class="about-content">
                그리고 저는 외삼촌의 진로 상담을 통해 고3 때부터 해커를 꿈꾸기 시작했어요.
            </v-card-text>

            <v-card-text class="about-content">
                그렇게 보안에 관심을 두고, 공부하면서 들었던 생각이 있었어요.
            </v-card-text>

            <v-card-text class="about-content">
                "어쩌면 내가 클린한 세상을 만들 수 있겠다!"
            </v-card-text>

            <v-card-text class="about-content">
                그렇게 저는 제 이름 앞에 클린을 붙이게 됐어요.
            </v-card-text>

            <v-card-text class="about-content">
                그렇게 탄생한 게 클린 관옥이고, 그걸 줄여서 클록이 되었답니다 :)
            </v-card-text>

            <br>

            <v-card-title><h2>공부한 것들</h2></v-card-title>

            <v-divider></v-divider>

            <v-card-title>
                <h3>언어</h3>
            </v-card-title>

            <v-row>
                <v-col cols="2" v-for="(item, k) in languages" :key="k">
                    <about-logo :item="item"></about-logo>
                </v-col>
            </v-row>

            <v-card-title>
                <h3>프레임워크</h3>
            </v-card-title>

            <v-row>
                <v-col cols="2" v-for="(item, k) in frameworks" :key="k">
                    <about-logo :item="item"></about-logo>
                </v-col>
            </v-row>

            <v-card-title>
                <h3>자격</h3>
            </v-card-title>

            <v-row>
                <v-col cols="2" v-for="(item, k) in certificates" :key="k">
                    <about-logo :item="item"></about-logo>
                </v-col>
            </v-row>


        </v-card>
    </div>
</template>

<script>
    import SideBar from "../../components/SideBar";
    import AboutLogo from "../../components/About/AboutLogo";

    export default {
        name: "About",
        components: {AboutLogo, SideBar},
        data() {
            return {
                languages: [
                    {
                        desc: 'C/C++',
                        path: 'https://bucketpcl.s3.ap-northeast-2.amazonaws.com/logo/c-programming.png'
                    },
                    {
                        desc: 'Kotlin',
                        path: 'https://bucketpcl.s3.ap-northeast-2.amazonaws.com/logo/Kotlin.png'
                    },
                    {
                        desc: 'Go',
                        path: 'https://bucketpcl.s3.ap-northeast-2.amazonaws.com/logo/Go.png'
                    },
                    {
                        desc: 'JavaScript',
                        path: 'https://bucketpcl.s3.ap-northeast-2.amazonaws.com/logo/JS.png'
                    },
                    {
                        desc: 'TypeScript',
                        path: 'https://bucketpcl.s3.ap-northeast-2.amazonaws.com/logo/TS.png'
                    },
                ],
                frameworks: [
                    {
                        desc: 'Laravel',
                        path: 'https://bucketpcl.s3.ap-northeast-2.amazonaws.com/logo/Laravel.png'
                    },
                    {
                        desc: 'Vue',
                        path: 'https://bucketpcl.s3.ap-northeast-2.amazonaws.com/logo/Vue.png'
                    },
                    {
                        desc: 'React',
                        path: 'https://bucketpcl.s3.ap-northeast-2.amazonaws.com/logo/React.png'
                    },
                ],
                certificates: [
                    {
                        desc: 'OCP 11g',
                        path: 'https://bucketpcl.s3.ap-northeast-2.amazonaws.com/logo/iconfinder_oracle_294664.png'
                    },
                    {
                        desc: 'CCNA',
                        path: 'https://bucketpcl.s3.ap-northeast-2.amazonaws.com/logo/pngfuel.com.png'
                    }
                ]
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

    .about-box {
        margin-left: 215px;
        padding: 70px;
    }

    .about-content {
        font-size: 1.5em;
    }
</style>
