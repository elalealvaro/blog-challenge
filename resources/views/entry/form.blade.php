<div class="form-group row">
    <label for="title" class="col-12 col-md-2 col-form-label">Title</label>
    <div class="col-12 col-md-10">
        <input
            type="text"
            class="form-control"
            id="title"
            name="title"
            value="{{ old('title', isset($entry) ? $entry->title : '') }}">
        @if ($errors->has('title'))
            <span class="text-danger">{{ $errors->first('title') }}</span>
        @endif
    </div>
</div>
<div class="form-group row">
    <label for="content" class="col-12 col-md-2 col-form-label">Content</label>
    <div class="col-12 col-md-10">
        <textarea
            class="form-control"
            id="content"
            name="content"
            rows="10">{{ old('content', isset($entry) ? $entry->content : '') }}</textarea>
        @if ($errors->has('content'))
            <span class="text-danger">{{ $errors->first('content') }}</span>
        @endif
    </div>
</div>
