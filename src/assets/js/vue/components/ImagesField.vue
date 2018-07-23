<template>
    <div>
        <label :for="field.slug" class="uk-form-label" v-text="field.title"></label>
        <p v-if="hasErrors()" class="uk-text-danger" v-text="this.errors[this.field.slug][0]"></p>

        <div class="uk-placeholder">
            <div class="uk-child-width-1-6@s" uk-grid uk-sortable>
                <div v-for="image in images" @click="removeImage(image)">
                    <img :src="imageUrl('image-browser', image.filename)" alt="">
                    <input type="hidden" :name="[ field.slug + '[]' ]" v-model="image.id">
                </div>
            </div>
        </div>

        <a href="#" @click.prevent="openBrowser" class="uk-button uk-button-small uk-button-default">Select</a>
    </div>
</template>

<script>
    export default {

        props: [
            'field',
            'selectedImage',
            'activeFieldId',
            'errors',
            'old',
            'entryImages'
        ],

        data: function () {
            return {
                images: []
            }
        },

        methods: {
            openBrowser: function () {
                this.$emit('open-browser', this.field.id)
            },
            imageUrl: function (filter, filename) {
                return SITE_URL + '/images/' + filter + '/' + filename;
            },
            removeImage: function (image) {
                this.images = _.filter(this.images, function(item) {
                    return item.id !== image.id;
                });
            },
            hasErrors: function () {
                return this.errors[this.field.slug] !== undefined;
            },
            loadImages: function (ids) {

                let v = this;

                _.each(ids, function(id) {
                    axios.get('/admin/images/' + id)
                        .then(response => {
                            v.images.push(response.data);
                        })
                        .catch(error => {
                            console.log(error);
                        })
                })
            }
        },

        watch: {
            selectedImage: function (image, oldImage) {
                if(this.activeFieldId === this.field.id) this.images.push(image);
            }
        },

        mounted: function () {

            console.log(this.entryImages);

            if(this.old !== null) {
                this.loadImages(this.old);
            } else if(this.entryImages !== null) {
                this.images = this.entryImages;
            }
        }

    }
</script>