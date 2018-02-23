<template>
    <div>
        <div v-if="image !== null" @click="removeImage">
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
                image: null
            }
        },

        methods: {
            openBrowser: function () {
                this.$emit('open-browser', this.field.id)
            },
            imageUrl: function (filter, filename) {
                return SITE_URL + '/images/' + filter + '/' + filename;
            },
            removeImage: function () {
                this.image = null;
            }
        },

        watch: {
            selectedImage: function (image, oldImage) {
                if(this.activeField === this.field.id) this.image = image;
            }
        },

        mounted: function () {
            console.log('Field:');
            console.log(this.field);
        }

    }
</script>