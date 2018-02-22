<template>
    <upload-component :resourceName="image"></upload-component>
</template>

<script>
    import UploadMixin from '../packages/upload/upload-mixin';
    import UploadComponent from '../packages/upload/UploadComponent.vue';

    export default {

        mixins: [
            UploadMixin
        ],

        components: {
            UploadComponent
        }

    }
</script>