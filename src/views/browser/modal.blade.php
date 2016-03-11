<div id="modal-image-browser" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-blank uk-modal-dialog-large">
        <div class="uk-modal-header">
            <div class="uk-grid uk-flex uk-flex-middle">
                <div class="uk-width-1-1 uk-width-medium-1-2">
                    <span class="title">Image Browser</span>
                </div>
                <div class="uk-width-1-1 uk-width-medium-1-2 uk-text-right">
                    <button type="button" class="uk-button cancel">Cancel</button>
                    <button type="button" class="uk-button uk-button-primary done">Done</button>
                </div>
            </div>
        </div>

        <!-- This is the tabbed navigation containing the toggling elements -->
        <ul class="uk-tab" data-uk-tab="{connect:'#browser-tabs'}">
            <li><a href="">All</a></li>
            <li><a href="">Search</a></li>
            <li><a href="">Upload</a></li>
        </ul>

        <!-- This is the container of the content items -->
        <ul id="browser-tabs" class="uk-switcher uk-margin uk-tab-center">
            <li id="all-images">
                <div class="uk-overflow-container">
                    <div class="image-browser-images uk-grid" data-uk-observe>
                    </div>
                    <div class="options uk-margin-top uk-clearfix">
                        <a href="#" class="load-more uk-button uk-width-1-1">Load More</a>
                        <span class="page-number uk-hidden">1</span>
                    </div>
                </div>
            </li>
            <li id="search-images">
                <form action="">
                    <input type="text"/>
                </form>

                <div class="uk-overflow-container">
                    <div class="image-browser-images uk-grid">
                    </div>
                </div>
            </li>
            <li id="upload-images">
                <div id="upload-drop" class="uk-placeholder uk-text-center">
                    <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
                    Drag images here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (20Mb Max)
                </div>

                <div id="progressbar" class="uk-progress uk-hidden">
                    <div class="uk-progress-bar" style="width: 0%;">...</div>
                </div>

                <div class="uk-overflow-container">
                    <div class="image-browser-images uk-grid">
                    </div>
                </div>
            </li>
        </ul>

        <div class="uk-modal-footer uk-text-right">
            <div id="selected-images" class="uk-placeholder">
                <div class="uk-grid uk-sortable images" data-uk-sortable>
                </div>
            </div>
        </div>
    </div>
</div>