<template>
    <div>
        <div class="uk-placeholder uk-text-center" :id="elementId()">
            <span uk-icon="icon: cloud-upload"></span>
            <span class="uk-text-middle">Attach images by dropping them here or</span>
            <div uk-form-custom>
                <input type="file" multiple>
                <span class="uk-link">selecting one</span>
            </div>
        </div>

        <progress :id="progressbarId()" class="uk-progress" value="0" max="100" hidden></progress>
    </div>
</template>

<script>
    export default {

        props: [
            'resourceName'
        ],

        data: function() {
            return {

            }
        },

        methods: {
            elementId: function() {
                return 'upload-' + this.resourceName;
            },
            progressbarId: function() {
                return 'progressbar-' + this.resourceName;
            }
        }
    }
</script>