<template>
    <div>
        <div v-for="image in images">
            <img :src="imageUrl('image-browser', image.filename)" alt="">
            <input type="hidden" :name="field.slug" v-model="image.id">
        </div>

        <a href="#" @click.prevent="openBrowser">Select</a>
    </div>
</template>

<script>
    export default {

        props: [
            'field',
            'selectedImage',
            'activeField'
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
            }
        },

        watch: {
            selectedImage: function (image, oldImage) {
                if(this.activeField === this.field.id) this.images.push(image);
            }
        },

        mounted: function () {
            console.log('Field:');
            console.log(this.field);
        }

    }
</script>