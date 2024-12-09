<script lang="ts" setup>
import {Ckeditor} from '@ckeditor/ckeditor5-vue';
import {
    AccessibilityHelp,
    Alignment,
    Autoformat,
    AutoImage,
    AutoLink,
    Autosave,
    Bold,
    ClassicEditor,
    Essentials,
    FindAndReplace,
    FontBackgroundColor,
    FontColor,
    FontSize,
    GeneralHtmlSupport,
    Heading,
    Highlight,
    HorizontalLine,
    Image,
    ImageBlock,
    ImageCaption,
    ImageInline,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    Italic,
    Link,
    LinkImage,
    List,
    ListProperties,
    MediaEmbed,
    Paragraph,
    PasteFromMarkdownExperimental,
    PasteFromOffice,
    RemoveFormat,
    SelectAll,
    SpecialCharacters,
    SpecialCharactersArrows,
    SpecialCharactersCurrency,
    SpecialCharactersEssentials,
    SpecialCharactersLatin,
    SpecialCharactersMathematical,
    SpecialCharactersText,
    Strikethrough,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    TextTransformation,
    Underline,
    Undo,
} from 'ckeditor5';
import translations from 'ckeditor5/translations/tr.js';
import 'ckeditor5/ckeditor5.css';
import InvalidFeedback from '@/Components/Form/InvalidFeedback.vue';

withDefaults(
    defineProps<{
        label?: string;
        required?: boolean;
        error?: string | null;
    }>(),
    {
        required: false,
    },
);

const model = defineModel<string | null>({required: true});

const config = {
    toolbar: {
        items: [
            'undo',
            'redo',
            'findAndReplace',
            '|',
            'heading',
            '|',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'removeFormat',
            '|',
            'fontSize',
            'fontColor',
            'fontBackgroundColor',
            'highlight',
            '|',
            'specialCharacters',
            'horizontalLine',
            'link',
            'insertImageViaUrl',
            'mediaEmbed',
            'insertTable',
            '|',
            'alignment',
            '|',
            'bulletedList',
            'numberedList',
            'accessibilityHelp',
        ],
        shouldNotGroupWhenFull: false,
    },
    plugins: [
        AccessibilityHelp,
        Alignment,
        Autoformat,
        AutoImage,
        AutoLink,
        Autosave,
        Bold,
        ClassicEditor,
        Essentials,
        FindAndReplace,
        FontBackgroundColor,
        FontColor,
        FontSize,
        GeneralHtmlSupport,
        Heading,
        Highlight,
        HorizontalLine,
        Image,
        ImageBlock,
        ImageCaption,
        ImageInline,
        ImageInsertViaUrl,
        ImageResize,
        ImageStyle,
        ImageTextAlternative,
        ImageToolbar,
        ImageUpload,
        Italic,
        Link,
        LinkImage,
        List,
        ListProperties,
        MediaEmbed,
        Paragraph,
        PasteFromMarkdownExperimental,
        PasteFromOffice,
        RemoveFormat,
        SelectAll,
        SpecialCharacters,
        SpecialCharactersArrows,
        SpecialCharactersCurrency,
        SpecialCharactersEssentials,
        SpecialCharactersLatin,
        SpecialCharactersMathematical,
        SpecialCharactersText,
        Strikethrough,
        Table,
        TableCaption,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        TextTransformation,
        Underline,
        Undo,
    ],
    fontSize: {
        options: [10, 12, 14, 'default', 18, 20, 22],
        supportAllValues: true,
    },
    image: {
        toolbar: [
            'toggleImageCaption',
            'imageTextAlternative',
            '|',
            'imageStyle:inline',
            'imageStyle:wrapText',
            'imageStyle:breakText',
            '|',
            'resizeImage',
        ],
    },
    language: 'tr',
    link: {
        addTargetToExternalLinks: true,
        defaultProtocol: 'https://',
        decorators: {
            toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                    download: 'file',
                },
            },
        },
    },
    list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true,
        },
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableProperties',
            'tableCellProperties',
        ],
    },
    translations: [translations],
};
</script>

<template>
    <div>
        <label v-if="label" class="mb-3 block text-sm font-medium text-black dark:text-white"
            >{{ label }} <span v-if="required" class="text-danger">*</span></label
        >
        <Ckeditor v-model="model" :config :editor="ClassicEditor"></Ckeditor>
        <InvalidFeedback v-if="error" :message="error" />
    </div>
</template>
