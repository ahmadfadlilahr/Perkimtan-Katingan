@props([
    'label' => '',
    'id' => '',
    'name' => '',
    'value' => '',
    'required' => false,
    'placeholder' => '',
    'help' => ''
])

<div class="form-group">
    @if($label)
        <x-input-label for="{{ $id }}" :value="$label" />
    @endif

    <div class="tinymce-simple-wrapper mt-1">
        <x-tinymce-editor
            :id="$id"
            :name="$name"
            :value="$value"
            :required="$required"
            height="400"
            plugins="advlist autolink lists link image charmap anchor searchreplace visualblocks code insertdatetime media table help wordcount"
            toolbar="undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | link image media | removeformat help"
            {{ $attributes }}
        />
    </div>

    @if($help)
        <p class="mt-1 text-sm text-gray-600">{{ $help }}</p>
    @endif
</div>
