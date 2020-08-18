<template>
    <div class="content-box">
        <h1>Post Maker</h1>

        <md-card style="width: 95%; float: left; height: auto; background: #ffebd9; padding: 3% 5%">
            <div class="md-layout md-gutter">

                <md-field style="width: 30%; margin-right: 3%">
                    <label for="group">Select Group</label>
                    <md-select v-model="group_idx" name="group" id="group" md-dense>
                        <md-option v-if="$store.state.groups" v-for="(group, k) in $store.state.groups" :key="k"
                                   :value="k">{{group.title}}
                        </md-option>
                    </md-select>
                </md-field>

                <md-field style="width: 30%; margin-right: 3%">
                    <label for="category">Selct Category</label>
                    <md-select v-model="form.cat_id" name="category" id="category" md-dense>
                        <md-option v-if="$store.state.groups" v-for="( cat, k ) in $store.state.groups[group_idx].cats"
                                   :key="k" :value="cat.id">{{cat.title}}
                        </md-option>
                    </md-select>
                </md-field>

                <md-field style="width: 30%">
                    <label>Title</label>
                    <md-input v-model="form.title"></md-input>
                </md-field>
            </div>
            <div class="editor">
                <label for="rich-text" class="form-label">Content</label>
                <quill-editor v-model="form.content"
                              class="mb-3"
                              id="rich-text"
                              rows="20"
                              :options="editorOption"
                              ref="myQuillEditor"
                              @blur="onEditorBlur($event)"
                              @focus="onEditorFocus($event)"
                              @ready="onEditorReady($event)">
                </quill-editor>
                <div class="custom-file d-none">
                    <input ref="image" @change="imageUpload($event)" type="file" class="custom-file-input" id="imageUpload" aria-describedby="imageUploadAddon">
                    <label class="custom-file-label" for="imageUpload">Choose file</label>
                </div>
            </div>
            <md-card-actions>
                <md-button @click="submit">Save</md-button>
                <md-button @click="$router.push('/posts/list')">Cancel</md-button>
            </md-card-actions>
        </md-card>

    </div>
</template>

<script>

    import {http} from '../../service/http';
    import jwt from 'jsonwebtoken'
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'

    import { quillEditor, Quill } from 'vue-quill-editor'
    import ImageResize from 'quill-image-resize';

    Quill.register('modules/imageResize', ImageResize);

    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],

        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'script': 'sub'}, {'script': 'super'}],
        [{'indent': '-1'}, {'indent': '+1'}],

        [{'size': ['small', false, 'large', 'huge']}],

        [{'color': []}, {'background': []}],
        [{'font': []}],
        [{'align': []}],
        ['link', 'image', 'video']
    ];


    export default {
        name: "PostCreate",

        created() {
            this.form.user_id = jwt.decode(localStorage.getItem('project-cloq-token')).user.user.id
        },

        components: {
            quillEditor
        },



        computed: {
            editor() {
                return this.$refs.myQuillEditor.quill
            },
        },

        data() {
            return {
                group_idx: 0,
                form: {
                    cat_id: '',
                    user_id: '',
                    title: '',
                    content: '',
                    images: []
                },
                editorOption: {
                    modules: {
                        toolbar: {
                            container: toolbarOptions,
                            handlers: {
                                'image': function (value) {
                                    if (value) {
                                        document.querySelector('#imageUpload').click();
                                    } else {
                                        this.quill.format('image', false);
                                    }
                                }
                            },
                        },
                        history: {
                            delay: 1000,
                            maxStack: 50,
                            userOnly: false
                        },
                        imageResize: {
                            displayStyles: {
                                backgroundColor: 'black',
                                border: 'none',
                                color: 'white'
                            },
                            modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
                        }
                    }
                },

                images: [],
            }
        },

        methods: {
            submit() {
                http().post('/articles', this.form)
                    .then((res) => {
                        console.log(res.data.data)
                        // this.$router.push('/posts/list');
                    })
                    .catch((err) => {
                        throw err
                    })
            },
            uploadFunction(e) {
                this.selectedFile = e.target.files[0];

                let form = new FormData();
                form.append("file", this.selectedFile);
                form.append("name", this.selectedFile.name);

                this.file = form

            },

            onEditorBlur(editor) {
                // console.log('editor blur!', editor)
            },
            onEditorFocus(editor) {
                // console.log('editor focus!', editor)
            },
            onEditorReady(editor) {
                // console.log('editor ready!', editor)
            },
            submitForm(){

            },
            imageUpload(e) {
                if (e.target.files.length !== 0) {

                    let quill = this.editor;
                    let reader = new FileReader();
                    reader.readAsDataURL(e.target.files[0]);
                    let self = this;
                    reader.onloadend = function() {
                        let base64data = reader.result;
                        self.form.images.push(base64data);

                        // Get cursor location
                        let length = quill.getSelection().index;

                        // Insert image at cursor location
                        quill.insertEmbed(length, 'image', base64data);

                        // Set cursor to the end
                        quill.setSelection(length + 1);
                    }
                }
            },
        }
    }
</script>

<style scoped>
    li {
        background: linen;
    }

    .content-box {
        margin-left: 75px;
        white-space: nowrap;
    }

    .content-box h1 {
        text-align: center;
        margin-top: 3%;
        margin-bottom: 4%;
        margin-right: 4%
    }


</style>
