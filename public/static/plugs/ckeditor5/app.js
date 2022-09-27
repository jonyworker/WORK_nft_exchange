// app.js

import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import Essentials from '@ckeditor/ckeditor5-essentials/src/essentials';
import Paragraph from '@ckeditor/ckeditor5-paragraph/src/paragraph';
// 文字類型選擇
import Heading from '@ckeditor/ckeditor5-heading/src/heading';
import HeadingButtonsUI from '@ckeditor/ckeditor5-heading/src/headingbuttonsui';
import ParagraphButtonUI from '@ckeditor/ckeditor5-paragraph/src/paragraphbuttonui';

// 文字樣式
import Bold from '@ckeditor/ckeditor5-basic-styles/src/bold';
import Italic from '@ckeditor/ckeditor5-basic-styles/src/italic';
// 圖片
import Image from '@ckeditor/ckeditor5-image/src/image.js';
import ImageCaption from '@ckeditor/ckeditor5-image/src/imagecaption.js';
import ImageStyle from '@ckeditor/ckeditor5-image/src/imagestyle.js';
import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar.js';
import ImageUpload from '@ckeditor/ckeditor5-image/src/imageupload.js';
import LinkImage from '@ckeditor/ckeditor5-link/src/linkimage';
import ImageInsert from '@ckeditor/ckeditor5-image/src/imageinsert';
import AutoImage from '@ckeditor/ckeditor5-image/src/autoimage';

// 連結
import Link from '@ckeditor/ckeditor5-link/src/link.js';
// 列表
import List from '@ckeditor/ckeditor5-list/src/list.js';
// 引用
import BlockQuote from '@ckeditor/ckeditor5-block-quote/src/blockquote.js';

ClassicEditor
    .create( document.querySelector( '#editor' ), {

        plugins: [ 
          Heading,
          Essentials,
          Paragraph,
          BlockQuote,
          Bold, 
          Italic, 
          Image, 
          ImageToolbar, 
          ImageCaption, 
          ImageStyle, 
          ImageUpload,
          ImageInsert,
          LinkImage,
          Link,
          List,
          AutoImage,
          HeadingButtonsUI,
          ParagraphButtonUI
        ],

        toolbar: [ 
          'paragraph', 
          'heading2',
          'heading3',
          '|', 
          'bold', 
          'italic', 
          'link', 
          'bulletedList',
          'numberedList', 
          '|', 
          'imageUpload', 
          'blockQuote',
          '|',
          'undo',
			    'redo'
        ],
        heading: {
          options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
          ]
        },
        image: {
          toolbar: [
            'imageStyle:block',
            'imageStyle:side',
            '|',
            'toggleImageCaption'
          ]
        }
    } )
    .then( editor => {
        console.log( 'Editor was initialized', editor );
    } )
    .catch( error => {
        console.error( error.stack );
    } );