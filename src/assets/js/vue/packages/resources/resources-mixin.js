module.exports = {
    data: function() {
        return {
            // Init
            storeId: null,
            resources: [],
            resource: {
                id: null
            },
            reset: {
                id: null
            },
            modal: null,
            endpoint: null,

            // Inherited
            debug: false,
            thinking: false,
            errors: null,
            success: null,
            status: {
                thinking: false,
                errors: null,
                success: null
            },
            buttons: {
                add: {
                    html: 'Add',
                    defaultHtml: 'Add'
                },
                cancel: {
                    html: 'Cancel',
                    done: 'Done',
                    defaultHtml: 'Cancel'
                },
                save: {
                    html: 'Save',
                    defaultHtml: 'Save'
                }
            },
            messages: {
                deleting: 'Are you sure?'
            }
        }
    },
    methods: {
        showAddForm: function() {
            UIkit.modal(this.modal).toggle();
            this.showAddFormHook();
        },
        showEditForm: function (resource) {
            this.resource = resource;
            UIkit.modal(this.modal).toggle();
            this.showEditFormHook(resource);
        },
        processForm: function(form, data) {
            this.status.thinking = true;
            this.status.errors = null;
            this.buttons.cancel.html = this.buttons.cancel.done;

            if(this.resource.id === null) {
                this.store(data);
            } else {
                this.update(data)
            }
        },
        store: function(data) {
            axios.post(this.storePath, data)
                .then(response => {
                    this.processResponse(response);
                })
                .catch(error => {
                    this.displayErrors(error.response.data.errors);
                });
        },
        update: function (data) {
            axios.put(this.updatePath, data)
                .then(response => {
                    this.processUpdateResponse(response);
                    UIkit.modal(this.modal).toggle();
                    this.status.success = null;
                    this.resourceUpdatedEvent(response);
                })
                .catch(error => {
                    this.displayErrors(error.response.data.errors);
                });
        },
        destroy: function(resource) {
            let confirmed = confirm(this.messages.deleting);

            if(confirmed) {
                this.status.thinking = true;
                axios.delete(this.destroyPath(resource))
                    .then(response => {
                        this.processResponse(response);
                        this.status.thinking = false;
                        this.status.success = null;
                        this.resourceDeletedEvent(resource);
                    })
                    .catch(error => {
                        alert('Sorry, we were unable to process your request.');
                    });
            }
        },
        processStoreResponse: function (response) {
            if(this.debug) {
                console.log(response);
            }
            this.status.success = 'Success!';
            this.status.thinking = false;

            this.resources.unshift = response.data;

            this.responseProcessedHook(response);
            this.clearValues();
        },
        processUpdateResponse: function (response) {
            if(this.debug) {
                console.log(response);
            }
            this.status.success = 'Success!';
            this.status.thinking = false;

            this.resources = _.map(this.resources, function(resource) {
                if(resource.id === response.data.id) return response.data;
                return resource;
            });

            this.responseProcessedHook(response);
            this.clearValues();
        },
        clearValues: function () {
            this.resource = this.reset;
            this.status.errors = null;
        },
        closeModal: function () {
            this.clearValues();
            this.status.success = null;
        },
        displayErrors(errors) {
            let errorString = [];

            for(let field in errors) {
                errorString.push(errors[field][0]);
            }

            this.status.errors = errorString.join(' ');
            this.status.thinking = false;
        },
        closeAlert: function () {
            this.status.errors = null;
            this.status.success = null;
        },
        resourceDeletedEvent: function (resource) {

        },
        // need to deprecate
        resourceUpdatedEvent: function (response) {

        },
        responseProcessedHook: function (response) {

        },
        showAddFormHook: function () {

        },
        showEditFormHook: function (resource) {

        },
        destroyPath: function (resource) {
            return this.endpoint + '/' + resource.id;
        }
    },
    computed: {
        storePath: function () {
            if(this.storeId === null) return this.endpoint;

            return this.endpoint + '/' + this.storeId;
        },
        updatePath: function () {
            return this.endpoint + '/' + this.resource.id;
        }
    }
};