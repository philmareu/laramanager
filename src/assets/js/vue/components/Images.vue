<template>
    <div>
        <ul uk-tab>
            <li><a href="#">Gallery</a></li>
            <li><a href="#">Search</a></li>
            <li><a href="#">Upload</a></li>
        </ul>

        <ul class="uk-switcher uk-margin">
            <li>
                <gallery></gallery>
            </li>
            <li>
                <search></search>
            </li>
            <li>
                <upload></upload>
            </li>
        </ul>

    </div>
</template>

<script>
    import Gallery from './ImageGallery.vue';
    import Search from './ImageSearch.vue';
    import Upload from './ImageUpload.vue';

    export default {
        components: {
            Gallery,
            Search,
            Upload
        }
    }
</script>