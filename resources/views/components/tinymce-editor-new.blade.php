@props([
    'id' => 'tinymce-editor',
    'name' => 'content',
    'value' => '',
    'height' => 400,
    'plugins' => 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
    'toolbar' => 'undo redo | blocks fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | charmap | removeformat | code | fullscreen',
    'required' => false
])

<div {{ $attributes->merge(['class' => 'tinymce-wrapper']) }}>
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        class="tinymce-textarea"
        style="width: 100%; min-height: {{ $height }}px;"
        {{ $required ? 'data-required="true"' : '' }}
    >{{ old($name, $value) }}</textarea>
</div>

@once
@push('styles')
<style>
    .tinymce-wrapper {
        position: relative;
        width: 100%;
        margin: 8px 0;
    }

    .tinymce-textarea {
        display: block !important;
        width: 100% !important;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.75rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        background-color: white;
    }

    /* Hide textarea when TinyMCE is active */
    .tox-tinymce + .tinymce-textarea {
        display: none !important;
    }

    /* TinyMCE Container Styling */
    .tox-tinymce {
        border: 1px solid #d1d5db !important;
        border-radius: 0.375rem !important;
    }

    .tox-editor-header {
        border-bottom: 1px solid #e5e7eb !important;
    }

    .tox .tox-toolbar__primary {
        background-color: #f9fafb !important;
    }

    .tox-edit-area {
        background: white !important;
    }

    .tox-edit-area iframe {
        background: white !important;
    }

    /* Status bar */
    .tox-statusbar {
        border-top: 1px solid #e5e7eb !important;
        background: #f9fafb !important;
    }
</style>
@endpush
@endonce

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded, attempting to initialize TinyMCE for: {{ $id }}');

    // Wait for a moment to ensure all elements are ready
    setTimeout(function() {
        initTinyMCE('{{ $id }}');
    }, 100);
});

function initTinyMCE(editorId) {
    console.log('Starting TinyMCE initialization for:', editorId);

    // Check if element exists
    const element = document.getElementById(editorId);
    if (!element) {
        console.error('Element not found:', editorId);
        return;
    }

    console.log('Element found:', element);
    console.log('Element type:', element.tagName);
    console.log('Element classes:', element.className);

    // Check if TinyMCE is loaded
    if (typeof tinymce === 'undefined') {
        console.error('TinyMCE not loaded');
        return;
    }

    // Destroy existing instance if exists
    const existingEditor = tinymce.get(editorId);
    if (existingEditor) {
        console.log('Destroying existing editor instance');
        existingEditor.destroy();
    }

    // Initialize TinyMCE with error handling
    try {
        tinymce.init({
            selector: '#' + editorId,
            height: {{ $height }},
            menubar: false,
            plugins: '{{ $plugins }}',
            toolbar: '{{ $toolbar }}',

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

        // Promise-based upload handler for TinyMCE 6 compatibility
        images_upload_handler: function (blobInfo, success, failure, progress) {
            console.log('=== TinyMCE Upload Started ===');
            console.log('File:', blobInfo.filename(), 'Size:', blobInfo.blob().size);
            console.log('Callback types:', typeof success, typeof failure, typeof progress);

            return new Promise(function(resolve, reject) {
                console.log('Promise created, starting XHR request...');
                const xhr = new XMLHttpRequest();
                const formData = new FormData();

                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.open('POST', '{{ route("admin.upload.image") }}');

                // Add CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken.getAttribute('content'));
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                }

                xhr.onload = function() {
                    console.log('Upload response received:', xhr.status, xhr.responseText);

                    if (xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            console.log('Parsed response:', response);

                            if (response.location) {
                                console.log('Success - calling callbacks with URL:', response.location);
                                success(response.location);
                                resolve(response.location);
                            } else {
                                const errorMsg = 'Invalid response format';
                                console.error(errorMsg, response);
                                failure(errorMsg);
                                reject(new Error(errorMsg));
                            }
                        } catch (e) {
                            const errorMsg = 'Failed to parse response';
                            console.error(errorMsg, e, xhr.responseText);
                            failure(errorMsg);
                            reject(new Error(errorMsg));
                        }
                    } else {
                        const errorMsg = 'HTTP Error: ' + xhr.status;
                        console.error(errorMsg, xhr.responseText);
                        failure(errorMsg);
                        reject(new Error(errorMsg));
                    }
                };

                xhr.onerror = function() {
                    const errorMsg = 'Network error';
                    failure(errorMsg);
                    reject(new Error(errorMsg));
                };

                if (typeof progress === 'function') {
                    xhr.upload.onprogress = function(e) {
                        if (e.lengthComputable) {
                            progress((e.loaded / e.total) * 100);
                        }
                    };
                }

                xhr.send(formData);
            });
        },        // Setup function
        setup: function(editor) {
            editor.on('init', function() {
                console.log('TinyMCE Editor initialized:', editor.id);

                // Handle form validation for required fields
                const textarea = document.getElementById(editor.id);
                if (textarea && textarea.hasAttribute('data-required')) {
                    // Add custom validation on form submit
                    const form = textarea.closest('form');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            // Sync content to textarea
                            textarea.value = editor.getContent();

                            // Check if required field is empty
                            const content = editor.getContent();
                            if (!content.trim()) {
                                e.preventDefault();
                                alert('Isi berita harus diisi');
                                editor.focus();
                                return false;
                            }
                        });
                    }
                }
            });

            // Auto-sync content on change
            editor.on('change keyup', function() {
                const textarea = document.getElementById(editor.id);
                if (textarea) {
                    textarea.value = editor.getContent();
                }
            });

            // Custom button untuk responsive table
            editor.ui.registry.addButton('responsivetable', {
                text: 'Tabel Responsif',
                tooltip: 'Buat tabel responsif',
                onAction: function () {
                    editor.insertContent(`
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; margin: 16px 0; border: 1px solid #d1d5db;">
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
        },

        // Enhanced toolbar dengan custom button
        toolbar: '{{ $toolbar }} | responsivetable',

        // Initialization callback
        init_instance_callback: function (editor) {
            console.log('TinyMCE Editor successfully initialized: ' + editor.id);
        },

        // Media configuration untuk YouTube
        media_live_embeds: true,
        media_dimensions: false,
        media_poster: false,
        media_alt_source: false,

        // Table configuration
        table_default_attributes: {
            'border': '1',
            'style': 'border-collapse: collapse; width: 100%;'
        },
        table_default_styles: {
            'border-collapse': 'collapse',
            'width': '100%'
        },

        // Paste configuration
        paste_data_images: true,
        paste_as_text: false,
        paste_merge_formats: true,
        paste_auto_cleanup_on_paste: true,
        paste_remove_styles: false,
        paste_remove_styles_if_webkit: false,

        // Error handling
        setup_error_handler: function(error) {
            console.error('TinyMCE Error:', error);
        }
        });

        console.log('TinyMCE initialization completed for:', editorId);

    } catch (error) {
        console.error('Failed to initialize TinyMCE:', error);
        console.error('Error details:', error.message);
    }
}
</script>
@endpush
