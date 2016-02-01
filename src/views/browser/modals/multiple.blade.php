<div id="modal-image-browser-multiple" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-blank uk-modal-dialog-large">
        <div class="uk-modal-header">
            <span class="title">File Browser</span>

            <div id="upload-drop" class="uk-placeholder uk-text-center">
                <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
                Drag files here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (5Mb Max)
            </div>

            <div id="progressbar" class="uk-progress uk-hidden">
                <div class="uk-progress-bar" style="width: 0%;">...</div>
            </div>
        </div>

        <div class="uk-overflow-container">
            <div id="image-browser" class="uk-grid">
                @each('laramanager::browser.file', $images, 'file')
            </div>
        </div>

        <div class="uk-modal-footer uk-text-right">
            <div id="selected-images" class="uk-placeholder">
                <div class="uk-grid uk-sortable images" data-uk-sortable>
                </div>
            </div>
            <button type="button" class="uk-button cancel">Cancel</button>
            <button type="button" class="uk-button uk-button-primary done">Done</button>
        </div>
    </div>
</div>