@props([
    'id' => 'tinymce-editor',
    'name' => 'content',
    'value' => '',
    'height' => 400,
    'plugins' => 'advlist autolink lists link image charmap anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
    'toolbar' => 'undo redo | blocks | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image media table link | code fullscreen help',
    'required' => false
])

<div {{ $attributes->merge(['class' => 'tinymce-wrapper']) }}>
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        class="tinymce-textarea"
        style="width: 100%; min-height: {{ $height }}px; visibility: visible !important;"
    >{{ old($name, $value) }}</textarea>
</div>

@once
@push('styles')
<style>
    .tinymce-wrapper {
        position: relative;
        z-index: 1;
        width: 100%;
        clear: both;
    }

    .tinymce-textarea {
        display: block !important;
        visibility: visible !important;
        width: 100% !important;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.75rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
    }

    /* TinyMCE Container Styling */
    .tox-tinymce {
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
        z-index: 10 !important;
        position: relative !important;
    }

    .tox-editor-header {
        border-bottom: 1px solid #e5e7eb !important;
        z-index: 11 !important;
    }

    .tox .tox-toolbar__primary {
        background-color: #f9fafb !important;
    }

    /* Editor Content Area - Fix untuk area yang tidak bisa diklik */
    .tox-edit-area {
        border: none !important;
        background: white !important;
        position: relative !important;
        z-index: 5 !important;
    }

    .tox-edit-area iframe {
        border: none !important;
        background: white !important;
        pointer-events: auto !important;
        z-index: 5 !important;
    }

    /* Editor Content Body */
    .tox-edit-area__iframe {
        background: white !important;
        border: none !important;
        width: 100% !important;
        min-height: 300px !important;
        pointer-events: auto !important;
    }

    /* Force clickable area */
    .tox .tox-edit-area__iframe {
        pointer-events: auto !important;
        cursor: text !important;
    }

    /* Status bar */
    .tox-statusbar {
        border-top: 1px solid #e5e7eb !important;
        background: #f9fafb !important;
    }

    /* Override any potential blocking elements */
    .tox-tinymce * {
        pointer-events: auto !important;
    }

    /* Ensure no overlay blocks the editor */
    .tinymce-wrapper::after,
    .tinymce-wrapper::before {
        display: none !important;
    }
</style>
@endpush
@endonce

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delay untuk memastikan DOM siap
    setTimeout(function() {
        console.log('Initializing TinyMCE for: {{ $id }}');

        // Check if element exists
        const element = document.getElementById('{{ $id }}');
        if (!element) {
            console.error('Element not found: {{ $id }}');
            return;
        }

        console.log('Element found:', element);

        // Pastikan TinyMCE sudah loaded
        if (typeof tinymce !== 'undefined') {
            initTinyMCE('{{ $id }}');
        } else {
            console.log('TinyMCE not loaded, loading from CDN...');
            // Fallback loading - gunakan CDN community version
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js';
            script.onload = function() {
                console.log('TinyMCE loaded from CDN');
                initTinyMCE('{{ $id }}');
            };
            script.onerror = function() {
                console.error('Failed to load TinyMCE from CDN');
            };
            document.head.appendChild(script);
        }
    }, 100);
});

function initTinyMCE(editorId) {
    console.log('Starting TinyMCE initialization for:', editorId);

    // Destroy existing instance jika ada
    if (tinymce.get(editorId)) {
        console.log('Destroying existing instance');
        tinymce.get(editorId).destroy();
    }

    tinymce.init({
        selector: '#' + editorId,
        height: {{ $height }},
        menubar: false,
        plugins: '{{ $plugins }}',
        toolbar: '{{ $toolbar }}',

        // Force visible dan clickable
        hidden_input: false,
        readonly: false,
        disabled: false,

        // Browser compatibility
        browser_spellcheck: true,
        contextmenu: "link image table",

        // Ensure editor is interactive
        setup: function (editor) {
            console.log('TinyMCE setup callback called for:', editorId);

            editor.on('init', function () {
                console.log('Editor init event fired');

                // Force focus and enable editing
                setTimeout(function() {
                    editor.getBody().style.pointerEvents = 'auto';
                    editor.getBody().style.cursor = 'text';
                    editor.getBody().contentEditable = true;

                    console.log('Editor body made clickable');
                }, 100);
            });

            // Custom button untuk responsive table
            editor.ui.registry.addButton('responsivetable', {
                text: 'Tabel',
                tooltip: 'Buat tabel responsif',
                onAction: function () {
                    editor.insertContent(`
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; margin: 16px 0;">
                                <thead>
                                    <tr style="background-color: #f9fafb;">
                                        <th style="border: 1px solid #d1d5db; padding: 8px 12px; text-align: left; font-weight: 600;">Header 1</th>
                                        <th style="border: 1px solid #d1d5db; padding: 8px 12px; text-align: left; font-weight: 600;">Header 2</th>
                                        <th style="border: 1px solid #d1d5db; padding: 8px 12px; text-align: left; font-weight: 600;">Header 3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #d1d5db; padding: 8px 12px;">Data 1</td>
                                        <td style="border: 1px solid #d1d5db; padding: 8px 12px;">Data 2</td>
                                        <td style="border: 1px solid #d1d5db; padding: 8px 12px;">Data 3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `);
                }
            });

            // Custom button untuk quote
            editor.ui.registry.addButton('customquote', {
                text: 'Quote',
                tooltip: 'Tambah kutipan',
                onAction: function () {
                    editor.insertContent('<blockquote>Masukkan kutipan di sini...</blockquote>');
                }
            });
        },

        // Content styling
        content_style: `
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                font-size: 14px;
                line-height: 1.6;
                color: #374151;
                margin: 16px;
            }
            img {
                max-width: 100%;
                height: auto;
                border-radius: 4px;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                margin: 16px 0;
            }
            table td, table th {
                border: 1px solid #d1d5db;
                padding: 8px 12px;
            }
            table th {
                background-color: #f9fafb;
                font-weight: 600;
            }
            blockquote {
                border-left: 4px solid #e5e7eb;
                margin: 16px 0;
                padding-left: 16px;
                font-style: italic;
                color: #6b7280;
            }
        `,

        // Image configuration
        image_advtab: true,
        image_caption: true,
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',

        // Media configuration
        media_live_embeds: true,
        media_dimensions: false,
        media_poster: false,
        media_alt_source: false,

        // Paste configuration (TinyMCE 6 compatible)
        paste_data_images: true,
        paste_as_text: false,
        paste_merge_formats: true,
        paste_auto_cleanup_on_paste: true,
        paste_remove_styles: false,
        paste_remove_styles_if_webkit: false,

        // Upload handler untuk gambar
        images_upload_handler: function (blobInfo, success, failure, progress) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route("admin.upload.image") }}');

            // Set CSRF token
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            xhr.upload.onprogress = function (e) {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = function() {
                var json;

                if (xhr.status === 403) {
                    failure('HTTP Error: ' + xhr.status, { remove: true });
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            xhr.onerror = function () {
                failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },

        // Setup callback untuk customization
        setup: function (editor) {
            console.log('TinyMCE setup callback called for:', editorId);

            // Custom button untuk responsive table
            editor.ui.registry.addButton('responsivetable', {
                text: 'Tabel',
                tooltip: 'Buat tabel responsif',
                onAction: function () {
                    editor.insertContent(`
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; margin: 16px 0;">
                                <thead>
                                    <tr style="background-color: #f9fafb;">
                                        <th style="border: 1px solid #d1d5db; padding: 8px 12px; text-align: left; font-weight: 600;">Header 1</th>
                                        <th style="border: 1px solid #d1d5db; padding: 8px 12px; text-align: left; font-weight: 600;">Header 2</th>
                                        <th style="border: 1px solid #d1d5db; padding: 8px 12px; text-align: left; font-weight: 600;">Header 3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid #d1d5db; padding: 8px 12px;">Data 1</td>
                                        <td style="border: 1px solid #d1d5db; padding: 8px 12px;">Data 2</td>
                                        <td style="border: 1px solid #d1d5db; padding: 8px 12px;">Data 3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `);
                }
            });

            // Custom button untuk quote
            editor.ui.registry.addButton('customquote', {
                text: 'Quote',
                tooltip: 'Tambah kutipan',
                onAction: function () {
                    editor.insertContent('<blockquote>Masukkan kutipan di sini...</blockquote>');
                }
            });
        },

        // Toolbar dengan custom buttons
        toolbar: '{{ $toolbar }} | responsivetable customquote',

        // Initialization callback
        init_instance_callback: function (editor) {
            console.log('TinyMCE Editor successfully initialized: ' + editor.id);

            // Show the editor container
            const container = editor.getContainer();
            if (container) {
                container.style.display = 'block';
                container.style.visibility = 'visible';
                container.style.pointerEvents = 'auto';
            }

            // Ensure editor body is clickable
            const editorBody = editor.getBody();
            if (editorBody) {
                editorBody.style.pointerEvents = 'auto';
                editorBody.style.cursor = 'text';
                editorBody.contentEditable = true;
            }

            // Force focus to make it interactive
            setTimeout(function() {
                editor.focus();
                console.log('Editor focused and ready for input');
            }, 200);

            // Auto-save functionality (opsional)
            setInterval(function() {
                if (editor.isDirty()) {
                    console.log('Content changed in editor: ' + editor.id);
                }
            }, 30000);
        },

        // Error handling
        setup_error_handler: function(error) {
            console.error('TinyMCE Error:', error);
        }
    });
}
</script>
@endpush
