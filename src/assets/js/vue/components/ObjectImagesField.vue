<template>
    <div class="uk-margin object-field object-field-images">

        <label :for="[ 'data[' + name + '][]' ]" class="uk-form-label" v-text="label"></label>

        <div class="uk-placeholder">
            <div class="uk-grid uk-grid-small uk-sortable images-container" data-uk-sortable>
                <div class="uk-width-1-2 uk-margin-bottom">
                    <div v-for="image in images">
                        <img :src="imageUrl('image-browser', image.filename)" alt="">
                        <input type="hidden" :name="[ 'data[' + name + '][]' ]" :value="image.id">
                    </div>
                </div>
            </div>
        </div>

        <a href="#" @click.prevent="openBrowser">Select</a>

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
            'images'
        ],

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
            console.log(this.object);
        }
    }
</script>