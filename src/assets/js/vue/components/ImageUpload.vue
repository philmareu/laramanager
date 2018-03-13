<template>
    <upload :resourceName="resourceName"></upload>
</template>

<script>
    import UploadMixin from '../packages/upload/upload-mixin';
    import Upload from '../packages/upload/UploadComponent.vue';

    export default {

        mixins: [
            UploadMixin
        ],

        components: {
            Upload
        },

        data: function() {
            return {
                resourceName: 'gallery',
                fileName: 'image',
                uploadUrl: '/admin/images',
            }
        },

        methods: {
            uploadComplete: function (upload) {
                this.$emit('image-uploaded', upload);
            }
        },

        mounted: function () {
            this.setupUploadField();
        }

    }
</script>