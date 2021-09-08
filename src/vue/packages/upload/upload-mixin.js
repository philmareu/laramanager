module.exports = {
    data: function() {
        return {
            resourceName: null,
            allow: '*.(jpg|jpeg|png)',
            upload: {
                id: null,
                filename: null
            },
            uploadUrl: '/uploads',
            multiple: true,
            fileName: 'file'
        }
    },
    methods: {
        setupUploadField: function() {
            let vm = this;
            let bar = document.getElementById('progressbar-' + this.resourceName);

            UIkit.upload('#upload-' + this.resourceName, {

                url: vm.uploadUrl,
                multiple: vm.multiple,
                params : {"_token" : window.token},
                name: vm.fileName,
                allow : this.allow,
                dataType: 'json',

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

                error: function () {
                    console.log('error', arguments);
                },

                complete: function (response) {
                    vm.uploadComplete(JSON.parse(response.response));
                },

                completeAll: function (response) {
                    bar.setAttribute('hidden', 'hidden');

                    // vm.thinking = false;
                    vm.allUploadsComplete(JSON.parse(response.response));
                }
            });
        },
        uploadComplete: function (upload) {

        },
        allUploadsComplete: function(upload) {

        }
    }
};