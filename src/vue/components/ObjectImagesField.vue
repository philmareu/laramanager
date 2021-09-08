<template>
    <div class="uk-margin object-field object-field-images">

        <label :for="[ 'data[' + name + '][]' ]" class="uk-form-label" v-text="label"></label>

        <div class="uk-placeholder">
            <div class="uk-child-width-1-6@s" uk-grid>
                <div v-for="image in images" @click="removeImage(image)">
                    <img :src="imageUrl('image-browser', image.filename)" alt="">
                    <input type="hidden" :name="[ 'data[' + name + '][]' ]" :value="image.id">
                </div>
            </div>
        </div>

        <a href="#" @click.prevent="openBrowser" class="uk-button uk-button-default uk-button-small">Select</a>

        <!--Do we need this????-->
        <input type="hidden" name="images_field_name" value="[ 'data[' + name + ']' ]">
    </div>
</template>

<script>
    export default {
        props: [
            'name',
            'label',
            'selectedImage',
            'activeFieldId',
            'object',
            'objectImages'
        ],

        data: function () {
            return {
                images: []
            }
        },

        methods: {
            openBrowser: function () {
                this.$emit('open-browser', this.object.id)
            },
            removeImage: function (image) {
                this.images = _.filter(this.images, function(item) {
                    return item.id !== image.id;
                });
            },
            imageUrl: function (filter, filename) {
                return SITE_URL + '/images/' + filter + '/' + filename;
            }
        },

        watch: {
            selectedImage: function (image, oldImage) {
                if(this.activeFieldId === this.object.id) this.images.push(image);
            }
        },

        mounted: function () {
            this.images = this.objectImages;
        }
    }
</script>