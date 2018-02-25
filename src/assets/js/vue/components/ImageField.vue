<template>
    <div>
        <p v-if="hasErrors()" class="uk-text-danger" v-text="this.errors[this.field.slug][0]"></p>
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
            'activeFieldId',
            'errors',
            'old',
            'entityImage'
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
            },
            hasErrors: function () {
                return this.errors[this.field.slug] !== undefined;
            },
            loadImage: function (id) {
                axios.get('/admin/images/' + id)
                    .then(response => {
                        console.log(response);
                        this.image = response.data;
                    })
                    .catch(error => {

                    })
            }
        },

        watch: {
            selectedImage: function (image, oldImage) {
                if(this.activeFieldId === this.field.id) this.image = image;
            }
        },

        mounted: function () {

            console.log(this.entityImage);

            if(this.old !== null) {
                this.loadImage(this.old);
            } else if(this.entityImage !== null) {
                this.image = this.entityImage;
            }
        }

    }
</script>