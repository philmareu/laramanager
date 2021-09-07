
window._ = require('lodash');

window.SITE_URL = document.head.querySelector('meta[name="site-url"]').content;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

/**
 * Load UIkit
 */
window.UIkit = require('uikit');

import Icons from 'uikit/dist/js/uikit-icons';

UIkit.use(Icons);

// window.datepicker = require('@fengyuanchen/datepicker');
window.codemirror = require('codemirror');
require('codemirror/mode/markdown/markdown');
require('codemirror/mode/gfm/gfm');
require('codemirror/mode/javascript/javascript');
require('codemirror/mode/php/php');
require('codemirror/mode/xml/xml');

window.hljs = require('highlight.js');

window.marked = require('marked');
window.marked.setOptions({
    highlight: function(code) {
        return require('highlight.js').highlightAuto(code).value;
    },
    pedantic: false,
    gfm: true,
    tables: true,
    breaks: false,
    sanitize: false,
    smartLists: true,
    smartypants: false,
    xhtml: false
});

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.token = token.content;

    // window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

import Vue from 'vue'

/**
 * Vue components
 */
Vue.component('image-gallery', require('./vue/components/ImageGallery.vue').default);
Vue.component('image-field', require('./vue/components/ImageField.vue').default);
Vue.component('images-field', require('./vue/components/ImagesField.vue').default);
Vue.component('image-browser-modal', require('./vue/components/ImageBrowserModal.vue').default);
Vue.component('object-images-field', require('./vue/components/ObjectImagesField.vue').default);
Vue.component('ckeditor-image-browser', require('./vue/components/CKEditorImageBrower.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        siteUrl: SITE_URL,
        selectedImage: null,
        activeFieldId: null
    },

    methods: {
        setSelectedImage: function (image) {
            this.selectedImage = image;
        },
        openBrowser: function (fieldId) {
            this.activeFieldId = fieldId;
            UIkit.offcanvas('#offcanvas-image-browser').toggle();
        }
    }
});

/*
 * jQuery Slugify plugin v1.0
 *
 * Copyright 2012, Ryun Shofner <ryun@humboldtweb.com>
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Depends:
 *	jquery
 */
(function(window, $){

    var char_map = {
        //Latin
        'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE',
        'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I',
        'Ï': 'I', 'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ô': 'O', 'Õ': 'O',
        'Ő': 'O', 'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ű': 'U',
        'Ý': 'Y', 'Þ': 'TH', 'ß': 'ss', 'à':'a', 'á':'a', 'â': 'a', 'ã': 'a', 'ä':
            'a', 'å': 'a', 'æ': 'ae', 'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e',
        'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i', 'ð': 'd', 'ñ': 'n', 'ò': 'o',
        'ô': 'o', 'õ': 'o', 'ő': 'o', 'ø': 'o', 'ù': 'u', 'ú': 'u',
        'û': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th', 'ÿ': 'y',

        //Greek
        'α':'a', 'β':'b', 'γ':'g', 'δ':'d', 'ε':'e', 'ζ':'z', 'η':'h', 'θ':'8',
        'ι':'i', 'κ':'k', 'λ':'l', 'μ':'m', 'ν':'n', 'ξ':'3', 'ο':'o', 'π':'p',
        'ρ':'r', 'σ':'s', 'τ':'t', 'υ':'y', 'φ':'f', 'χ':'x', 'ψ':'ps', 'ω':'w',
        'ά':'a', 'έ':'e', 'ί':'i', 'ό':'o', 'ύ':'y', 'ή':'h', 'ώ':'w', 'ς':'s',
        'ϊ':'i', 'ΰ':'y', 'ϋ':'y', 'ΐ':'i',
        'Α':'A', 'Β':'B', 'Γ':'G', 'Δ':'D', 'Ε':'E', 'Ζ':'Z', 'Η':'H', 'Θ':'8',
        'Ι':'I', 'Κ':'K', 'Λ':'L', 'Μ':'M', 'Ν':'N', 'Ξ':'3', 'Ο':'O', 'Π':'P',
        'Ρ':'R', 'Σ':'S', 'Τ':'T', 'Υ':'Y', 'Φ':'F', 'Χ':'X', 'Ψ':'PS', 'Ω':'W',
        'Ά':'A', 'Έ':'E', 'Ί':'I', 'Ό':'O', 'Ύ':'Y', 'Ή':'H', 'Ώ':'W', 'Ϊ':'I',
        'Ϋ':'Y',

        //Turkish
        'ş':'s', 'Ş':'S', 'ı':'i', 'İ':'I', 'ç':'c', 'Ç':'C', 'ü':'u', 'Ü':'U',
        'ö':'o', 'Ö':'O', 'ğ':'g', 'Ğ':'G',

        //Russian
        'а':'a', 'б':'b', 'в':'v', 'г':'g', 'д':'d', 'е':'e', 'ё':'yo', 'ж':'zh',
        'з':'z', 'и':'i', 'й':'j', 'к':'k', 'л':'l', 'м':'m', 'н':'n', 'о':'o',
        'п':'p', 'р':'r', 'с':'s', 'т':'t', 'у':'u', 'ф':'f', 'х':'h', 'ц':'c',
        'ч':'ch', 'ш':'sh', 'щ':'sh', 'ъ':'', 'ы':'y', 'ь':'', 'э':'e', 'ю':'yu',
        'я':'ya',
        'А':'A', 'Б':'B', 'В':'V', 'Г':'G', 'Д':'D', 'Е':'E', 'Ё':'Yo', 'Ж':'Zh',
        'З':'Z', 'И':'I', 'Й':'J', 'К':'K', 'Л':'L', 'М':'M', 'Н':'N', 'О':'O',
        'П':'P', 'Р':'R', 'С':'S', 'Т':'T', 'У':'U', 'Ф':'F', 'Х':'H', 'Ц':'C',
        'Ч':'Ch', 'Ш':'Sh', 'Щ':'Sh', 'Ъ':'', 'Ы':'Y', 'Ь':'', 'Э':'E', 'Ю':'Yu',
        'Я':'Ya',

        //Ukranian
        'Є':'Ye', 'І':'I', 'Ї':'Yi', 'Ґ':'G', 'є':'ye', 'і':'i', 'ї':'yi', 'ґ':'g',

        //Czech
        'ď':'d', 'ě':'e', 'ň': 'n', 'ř':'r', 'ť':'t', 'ů':'u',
        'Ď':'D', 'Ě':'E', 'Ň': 'N', 'Ř':'R', 'Ť':'T',
        'Ů':'U',

        //Polish
        'ć':'c', 'ł':'l', 'ń':'n', 'ó':'o', 'ś':'s', 'ź':'z',
        'ż':'z', 'Ć':'C', 'Ł':'L', 'Ń':'N', 'Ó':'o', 'Ś':'S',
        'Ź':'Z', 'Ż':'Z',

        //Latvian
        'ā':'a', 'ē':'e', 'ģ':'g', 'ī':'i', 'ķ':'k', 'ļ':'l', 'ņ':'n',
        'Ā':'A', 'Ē':'E', 'Ģ':'G', 'Ī':'i',
        'Ķ':'k', 'Ļ':'L', 'Ņ':'N',

        //Lithuanian
        'ą':'a', 'č':'c', 'ę':'e', 'ė':'e', 'į':'i', 'š':'s', 'ų':'u', 'ū':'u',
        'ž':'z', 'Ą':'A', 'Č':'C', 'Ę':'E', 'Ė':'E', 'Į':'I', 'Š':'S', 'Ų':'U',
        'Ū':'U', 'Ž':'Z',

        //Currency
        '€': 'euro', '₢': 'cruzeiro', '₣': 'french franc', '£': 'pound',
        '₤': 'lira', '₥': 'mill', '₦': 'naira', '₧': 'peseta', '₨': 'rupee',
        '₩': 'won', '₪': 'new shequel', '₫': 'dong', '₭': 'kip', '₮': 'tugrik',
        '₯': 'drachma', '₰': 'penny', '₱': 'peso', '₲': 'guarani', '₳': 'austral',
        '₴': 'hryvnia', '₵': 'cedi', '¢': 'cent', '¥': 'yen', '元': 'yuan',
        '円': 'yen', '﷼': 'rial', '₠': 'ecu', '¤': 'currency', '฿': 'baht',

        //Symbols
        '©':'(c)', 'œ': 'oe', 'Œ': 'OE', '∑': 'sum', '®': '(r)', '†': '+',
        '“': '"', '”': '"', '‘': "'", '’': "'", '∂': 'd', 'ƒ': 'f', '™': 'tm',
        '℠': 'sm', '…': '...', '˚': 'o', 'º': 'o', 'ª': 'a', '•': '*',
        '∆': 'delta', '∞': 'infinity', '♥': 'love', '&': 'and'
    };

    var Slugify = function(e, cfg)
    {
        this.cfg = cfg || {};

        if (typeof this.cfg.slug == 'undefined')
        {
            console.log('Error no slug field');
            return;
        }
        this.type   = this.cfg.type||'_';
        this.$slug  = $(this.cfg.slug);
        this.$title = $(e);

        this.register_events();
    };

    Slugify.prototype = {
        encode: function(str)
        {
            if (typeof str != 'undefined')
            {
                var slug = '';
                str = $.trim(str);

                for (var i = 0; i < str.length; i++)
                {
                    slug += (char_map[str.charAt(i)]) ? char_map[str.charAt(i)] : str.charAt(i);
                }

                return slug.toLowerCase().replace(/-+/g, '').replace(/\s+/g, this.type).replace(/[^a-z0-9_\-]/g, '');
            }
        },
        register_events: function(){
            var me = this, $title = this.$title, $slug = this.$slug;

            // Check if the	 field is a text field or undefined (select)
            if ($title.attr('type') == 'text')
            {
                // For text fields
                $title.keyup(function(e) {
                    $slug.val(me.encode(e.currentTarget.value));
                });

                // Check if it's empty first and populate if so
                if ($slug.val() == '')
                {
                    $slug.val(me.encode($title.val()));
                }
            }
            else
            {
                // For dropdown fields
                if ($title.hasClass('chzn'))
                {
                    $title.chosen.change(function(e) {
                        $slug.val(me.encode(e.currentTarget.value));
                    });
                }
                else
                {
                    $title.change(function(e) {
                        $slug.val(me.encode(e.currentTarget.value));
                    });
                }
                // Check if it's empty first and populate if so
                if ($slug.val() == '')
                {
                    $slug.val(me.encode($(':selected', $title).val()));
                }
            }
        }
    };

    $.fn.slugify = function (option) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('slugify')
                , options = $.extend({}, $.fn.slugify.defaults, $this.data(), typeof option == 'object' && option);
            if (!data) $this.data('slugify', (data = new Slugify(this, options)));
            if (typeof option == 'string') data[option]();
        })
    };
    $.fn.slugify.defaults = {
        slug: '#slug',
        type:'_',
    };

})(window, jQuery);
