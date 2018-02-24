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
            'activeField',
            'errors',
            'old'
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
            }
        },

        watch: {
            selectedImage: function (image, oldImage) {
                if(this.activeField === this.field.id) this.image = image;
            }
        },

        mounted: function () {
            console.log(this.old);

            if(this.old !== null) {
                axios.get('/admin/images/' + this.old)
                    .then(response => {
                        console.log(response);
                        this.image = response.data;
                    })
                    .catch(error => {

                    })
            }
        }

    }
</script>