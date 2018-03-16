<template>
    <div id="offcanvas-image-browser" uk-offcanvas="flip: true; overlay: true">
        <div class="uk-offcanvas-bar">

            <button class="uk-offcanvas-close" type="button" uk-close></button>

            <image-upload v-on:image-uploaded="updateGallery"></image-upload>

            <div v-if="loading === false"  class="uk-child-width-1-2 uk-grid-small" uk-grid>
                <div v-for="(image, index) in images" class="uk-margin-small">
                    <img :src="imageUrl('image-browser', image.filename)" :alt="image.alt"
                         :data-laramanager-image-id="image.id"
                         :data-laramanager-filename="image.filename"
                         @click.prevent="imageSelected(image)"
                         class="unselected-image">
                </div>
            </div>

            <div v-if="loading" class="uk-padding-large uk-text-center">
                <div uk-spinner></div>
            </div>

            <div v-if="pagination != null">
                <ul class="uk-pagination uk-flex-center" uk-margin>
                    <li v-if="pagination.prev_page_url !== null"><a href="#" @click.prevent="loadPage(page)"><span uk-pagination-previous></span></a></li>

                    <li v-for="page in pageArray" :class="getPaginationClass(page)">
                        <span v-if="page === pagination.current_page" v-text="page"></span>
                        <a v-if="page !== pagination.current_page" href="#" v-text="page" @click.prevent="loadPage(page)"></a>
                    </li>

                    <li v-if="pagination.next_page_url !== null"><a :href="pagination.next_page_url" @click.prevent="loadPage(page)"><span uk-pagination-next></span></a></li>
                </ul>
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
                loading: true,
                images: [],
                pagination: null,
                pageArray: []
            }
        },

        methods: {
            updateGallery: function (image) {
                this.images.unshift(image);
            },
            imageSelected: function (image) {
                this.$emit('image-selected', image);
            },
            imageUrl: function (filter, filename) {
                return SITE_URL + '/images/' + filter + '/' + filename;
            },
            uploadComplete: function (upload) {

            },
            getPaginationClass: function (page) {
                if(page === this.pagination.current_page) return 'uk-active';
            },
            loadPage: function (page) {
                this.loading = true;
                axios.get('/admin/images?page=' + page)
                    .then(response => {
                        console.log(response.data);

                        this.pagination = response.data;
                        this.pageArray = _.range(1, this.pagination.last_page + 1);
                        this.images = response.data.data;
                        this.loading = false;
                    })
                    .catch(error => {

                    })
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