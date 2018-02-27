<template>
    <div id="offcanvas-image-browser" uk-offcanvas="flip: true; overlay: true">
        <div class="uk-offcanvas-bar">

            <button class="uk-offcanvas-close" type="button" uk-close></button>

            <image-upload v-on:image-uploaded="updateGallery"></image-upload>

            <div class="uk-child-width-1-2" uk-grid>
                <div v-for="image in images" class="uk-margin">
                    <img :src="imageUrl('image-browser', image.filename)" :alt="image.alt"
                         :data-laramanager-image-id="image.id"
                         :data-laramanager-filename="image.filename"
                         @click.prevent="imageSelected(image)"
                         class="unselected-image">
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import ImageUpload from './ImageUpload.vue';

    export default {

        components: {
            ImageUpload
        },

        data: function () {
            return {
                images: [],
                pagination: null,
                pageArray: []
            }
        },

        methods: {
            updateGallery: function (image) {
                this.resources.unshift(image);
            },
            imageSelected: function (image) {
                this.$emit('image-selected', image);
            },
            imageUrl: function (filter, filename) {
                return SITE_URL + '/images/' + filter + '/' + filename;
            },
            uploadComplete: function (upload) {

            }
        },

        beforeCreate: function() {
            axios.get('/admin/images')
                .then(response => {
                    this.pagination = response.data;
                    this.pageArray = _.range(1, this.pagination.last_page + 1);
                    this.images = response.data.data;
                    this.loading = false;
                })
                .catch(error => {

                })
        }
    }
</script>