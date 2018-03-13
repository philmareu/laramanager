<template>
    <div>
        <image-upload v-on:image-uploaded="updateGallery"></image-upload>

        <div v-for="image in images" class="uk-margin">
            <img :src="imageUrl('image-browser', image.filename)" :alt="image.alt"
                 :data-laramanager-image-id="image.id"
                 :data-laramanager-filename="image.filename"
                 @click.prevent="imageSelected(image)"
                 class="unselected-image">
        </div>
    </div>
</template>

<script>

    import ImageUpload from './ImageUpload.vue';

    export default {

        components: {
            ImageUpload
        },

        props: [
            'funcNum'
        ],

        data: function () {
            return {
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

                window.opener.CKEDITOR.tools.callFunction(this.funcNum, this.imageUrl('original', image.filename), function() {
                    // Get the reference to a dialog window.
                    let dialog = this.getDialog();
                    // Check if this is the Image Properties dialog window.
                    if ( dialog.getName() == 'image' ) {
                        // Get the reference to a text field that stores the "alt" attribute.
                        let element = dialog.getContentElement( 'info', 'txtAlt' );
                        // Assign the new value.
                        if ( element )
                            element.setValue( image.alt );
                    }
                    // Return "false" to stop further execution. In such case CKEditor will ignore the second argument ("fileUrl")
                    // and the "onSelect" function assigned to the button that called the file manager (if defined).
                    // return false;
                } );

                window.close();
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