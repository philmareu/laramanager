module.exports = {
    data: function() {
        return {
            resourceName: null,
            allow: '*.(jpg|jpeg|png)',
            upload: {
                id: null,
                filename: null
            }
        }
    },
    methods: {
        setupUploadField: function() {

            let vm = this;
            let bar = $("#progressbar-" + this.resourceName)[0];

            UIkit.upload('#upload-' + this.resourceName, {

                url: '/user/upload',
                multiple: false,
                params : {"_token": window.Laravel.csrfToken},
                name: 'file',
                allow : this.allow,

                loadStart: function (e) {
                    // vm.thinking = true;
                    bar.removeAttribute('hidden');
                    bar.max =  e.total;
                    bar.value =  e.loaded;
                },

                progress: function (e) {
                    bar.max =  e.total;
                    bar.value =  e.loaded;
                },

                loadEnd: function (e) {
                    bar.max =  e.total;
                    bar.value =  e.loaded;
                },

                completeAll: function (response) {
                    bar.setAttribute('hidden', 'hidden');

                    // vm.thinking = false;
                    vm.processUpload(JSON.parse(response.response));
                }
            });
        },
        processUpload: function(upload) {
            this.upload = upload;
            this.uploadProcessedHook(upload);
        },
        uploadProcessedHook: function (upload) {

        }
    }
};