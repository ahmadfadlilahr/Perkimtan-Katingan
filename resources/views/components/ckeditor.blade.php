@props([
    'id' => 'ckeditor',
    'name' => 'content',
    'value' => '',
    'height' => 400,
    'required' => false,
    'placeholder' => 'Mulai menulis...'
])

<div {{ $attributes->merge(['class' => 'ckeditor-wrapper']) }}>
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        class="ckeditor-textarea hidden"
        placeholder="{{ $placeholder }}"
    >{{ old($name, $value) }}</textarea>
</div>

@once
@push('styles')
<style>
    .ckeditor-wrapper {
        position: relative;
        width: 100%;
        margin: 8px 0;
    }

    /* CKEditor 5 Custom Styling */
    .ck-editor {
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
    }

    .ck-editor__top {
        border-bottom: 1px solid #e5e7eb !important;
    }

    .ck-toolbar {
        background: #f9fafb !important;
        border-bottom: 1px solid #e5e7eb !important;
        padding: 8px !important;
    }

    .ck-content {
        min-height: {{ $height }}px !important;
        padding: 16px !important;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
        font-size: 14px !important;
        line-height: 1.6 !important;
        color: #374151 !important;
    }

    .ck-content img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 4px !important;
    }

    .ck-content table {
        border-collapse: collapse !important;
        width: 100% !important;
        margin: 16px 0 !important;
    }

    .ck-content table td,
    .ck-content table th {
        border: 1px solid #d1d5db !important;
        padding: 8px 12px !important;
    }

    .ck-content table th {
        background-color: #f9fafb !important;
        font-weight: 600 !important;
    }

    .ck-content blockquote {
        border-left: 4px solid #e5e7eb !important;
        margin: 16px 0 !important;
        padding-left: 16px !important;
        font-style: italic !important;
        color: #6b7280 !important;
    }

    /* Focus state */
    .ck-editor__editable:focus {
        border: 1px solid #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }
</style>
@endpush
@endonce

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delay untuk memastikan DOM siap
    setTimeout(function() {
        console.log('Initializing CKEditor for: {{ $id }}');

        // Check if element exists
        const element = document.getElementById('{{ $id }}');
        if (!element) {
            console.error('Element not found: {{ $id }}');
            return;
        }

        console.log('Element found:', element);

        // Check if CKEditor is loaded
        if (typeof ClassicEditor !== 'undefined') {
            initCKEditor('{{ $id }}');
        } else {
            console.error('CKEditor not loaded');
        }
    }, 100);
});

function initCKEditor(editorId) {
    console.log('Starting CKEditor initialization for:', editorId);

    ClassicEditor
        .create(document.querySelector('#' + editorId), {
            // Simplified toolbar for better compatibility
            toolbar: [
                'undo', 'redo',
                '|',
                'heading',
                '|',
                'bold', 'italic', 'underline',
                '|',
                'bulletedList', 'numberedList',
                '|',
                'outdent', 'indent',
                '|',
                'link', 'imageUpload', 'insertTable',
                '|',
                'blockQuote',
                '|',
                'sourceEditing'
            ],

            // Heading configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            },

            // Image upload configuration
            image: {
                toolbar: [
                    'imageTextAlternative', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side'
                ]
            },

            // Table configuration
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells'
                ]
            },

            // Remove problematic features that cause errors
            removePlugins: [ 'MediaEmbed', 'CKBox', 'CKFinder', 'EasyImage', 'RealTimeCollaborativeComments', 'RealTimeCollaborativeTrackChanges', 'RealTimeCollaborativeRevisionHistory', 'PresenceList', 'Comments', 'TrackChanges', 'TrackChangesData', 'RevisionHistory', 'Pagination', 'WProofreader', 'MathType' ],

            // Language
            language: 'en'
        })
        .then(editor => {
            console.log('CKEditor successfully initialized:', editorId);

            // Store editor instance for later use
            window['ckEditor_' + editorId] = editor;

            // Set minimum height
            editor.editing.view.change(writer => {
                writer.setStyle('min-height', '{{ $height }}px', editor.editing.view.document.getRoot());
            });

            // Auto-save functionality
            editor.model.document.on('change:data', () => {
                console.log('Content changed in CKEditor:', editorId);
            });

            // Focus editor
            setTimeout(() => {
                editor.editing.view.focus();
                console.log('CKEditor focused and ready for input');
            }, 100);
        })
        .catch(error => {
            console.error('CKEditor initialization failed:', error);
        });
}
</script>
@endpush
