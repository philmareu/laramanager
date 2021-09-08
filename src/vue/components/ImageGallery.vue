<template>
    <div>
        <image-upload v-on:image-uploaded="updateGallery"></image-upload>

        <div v-if="loading === false" class="uk-grid-medium uk-grid-width-1-2 uk-child-width-1-4@s uk-child-width-1-6@m image-browser-images" id="images" uk-grid>
            <div v-for="image in resources">
                <img :src="imageUrl('image-browser', image.filename)" :alt="image.alt"
                     :data-laramanager-image-id="image.id"
                     :data-laramanager-filename="image.filename"
                     @click.prevent="showEditForm(image)"
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

        <form-modal id="modal-image" :buttons="buttons" :status="status" v-on:submitted="processForm" v-on:closing="closeModal">
            <span slot="title">Image</span>

            <div class="uk-grid">
                <div class="uk-width-2-3">
                    <label for="title" class="uk-form-label">Title</label>
                    <div class="uk-form-controls">
                        <input type="text" name="title" id="title" v-model="resource.title" class="uk-input">
                    </div>

                    <div class="uk-margin">
                        <label for="filename" class="uk-form-label">Filename</label>
                        <div class="uk-form-controls">
                            <input type="text" name="filename" id="filename" v-model="resource.filename" class="uk-input">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label for="original_filename" class="uk-form-label">Original Filename</label>
                        <div class="uk-form-controls">
                            <input type="text" name="original_filename" id="original_filename" v-model="resource.original_filename" class="uk-input" disabled>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label for="alt" class="uk-form-label">Alt</label>
                        <div class="uk-form-controls">
                            <input type="text" name="alt" id="alt" v-model="resource.alt" class="uk-input">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label for="description" class="uk-form-label">description</label>
                        <div class="uk-form-controls">
                            <textarea name="description" id="description" class="uk-textarea" cols="30" rows="10" v-model="resource.description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <img :src="imageUrl('original', resource.filename)" :alt="resource.alt" v-if="resource.filename !== null">
                </div>
            </div>
        </form-modal>
    </div>
</template>

<script>
    import FormModal from '../packages/resources/FormModal.vue';
    import Resources from '../packages/resources/resources-mixin';
    import ImageUpload from './ImageUpload.vue';

    export default {

        mixins: [
            Resources
        ],

        components: {
            FormModal,
            ImageUpload
        },

        data: function() {
            return {
                loading: true,
                storeId: null,
                resources: [],
                resource: {
                    id: null,
                    filename: null,
                    alt: null,
                    title: null,
                    description: null
                },
                reset: {
                    id: null,
                    filename: null,
                    alt: null,
                    title: null,
                    description: null
                },
                modal: "#modal-image",
                endpoint: '/admin/images',
                pagination: null,
                pageArray: []
            }
        },

        methods: {
            imageUrl: function (filter, filename) {
                return SITE_URL + '/images/' + filter + '/' + filename;
            },
            uploadComplete: function (upload) {

            },
            updateGallery: function (image) {
                this.resources.unshift(image);
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
                        this.resources = response.data.data;
                        this.loading = false;
                    })
                    .catch(error => {

                    })
            }
        },

        beforeCreate: function() {
            axios.get('/admin/images')
                .then(response => {
                    console.log(response.data);

                    this.pagination = response.data;
                    this.pageArray = _.range(1, this.pagination.last_page + 1);
                    this.resources = response.data.data;
                    this.loading = false;
                })
                .catch(error => {

                })
        }
    }
</script>