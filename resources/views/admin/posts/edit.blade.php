@extends('layouts.admin')

@section('header', 'Edit Article')

@section('content')
<form id="post-form"
      action="{{ route('admin.posts.update', $post->_id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white dark:bg-gray-800 shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
    @csrf
    @method('PUT')

    <div class="px-4 py-6 sm:p-8">
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

            <div class="sm:col-span-4">
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Article Title *</label>
                <div class="mt-2">
                    <input type="text" name="title" id="title" required value="{{ old('title', $post->title) }}"
                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                </div>
            </div>

            <div class="sm:col-span-2">
                <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Category</label>
                <div class="mt-2">
                    <select id="category_id" name="category_id"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->_id }}" {{ old('category_id', $post->category_id) == $category->_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-span-full">
                <label for="excerpt" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-100">Brief Description *</label>
                <div class="mt-2">
                    <textarea id="excerpt" name="excerpt" rows="6" required
                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Main content for the article.</p>
            </div>



            <div class="sm:col-span-3 border border-gray-200 dark:border-gray-700 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Upload New Image (optional)</label>
                @if($post->featured_image)
                    <p class="text-xs text-gray-500 mb-2">Current file: {{ $post->featured_image }}</p>
                @endif
                <input type="file" name="featured_image" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            </div>

            <div class="sm:col-span-3 border border-gray-200 dark:border-gray-700 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">OR Paste Image URL</label>
                <input type="url" name="image_url" placeholder="https://..." value="{{ old('image_url', $post->image_url) }}"
                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm">
            </div>

            <div class="col-span-full border border-gray-200 dark:border-gray-700 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Image Preview</label>
                <div class="relative w-full max-w-lg h-64 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden border-2 border-dashed border-gray-300 dark:border-gray-600">
                    @php
                        $existingSrc = $post->featured_image ? Storage::url($post->featured_image) : ($post->image_url ?? '');
                        $hasImage = !empty($existingSrc);
                    @endphp
                    <img id="image-preview" src="{{ $existingSrc }}" class="w-full h-full object-cover {{ $hasImage ? '' : 'hidden' }}">
                    <div id="preview-placeholder" class="text-center text-gray-400 dark:text-gray-500 {{ $hasImage ? 'hidden' : '' }}">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="mt-1 text-sm">No image selected or URL pasted</p>
                    </div>
                </div>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.querySelector('input[name="featured_image"]');
                const urlInput = document.querySelector('input[name="image_url"]');
                const previewImg = document.getElementById('image-preview');
                const placeholder = document.getElementById('preview-placeholder');

                function showPreview(src) {
                    previewImg.src = src;
                    previewImg.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }

                function hidePreview() {
                    previewImg.src = '';
                    previewImg.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                }

                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            showPreview(e.target.result);
                        };
                        reader.readAsDataURL(this.files[0]);
                        urlInput.value = '';
                    } else {
                        if (urlInput.value) {
                            showPreview(urlInput.value);
                        } else {
                            hidePreview();
                        }
                    }
                });

                function getThumbnailUrl(url) {
                    const ytMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i);
                    if (ytMatch && ytMatch[1]) {
                        return `https://img.youtube.com/vi/${ytMatch[1]}/maxresdefault.jpg`;
                    }
                    return url;
                }

                urlInput.addEventListener('input', function() {
                    if (this.value) {
                        const thumbnailUrl = getThumbnailUrl(this.value);
                        if (thumbnailUrl !== this.value) {
                            this.value = thumbnailUrl; // Auto-convert youtube link to thumbnail
                        }
                        showPreview(this.value);
                        fileInput.value = '';
                    } else {
                        if (fileInput.files && fileInput.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                showPreview(e.target.result);
                            };
                            reader.readAsDataURL(fileInput.files[0]);
                        } else {
                            hidePreview();
                        }
                    }
                });
            });
            </script>

            <div class="sm:col-span-3">
                <label for="tags" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Tags (comma separated)</label>
                <div class="mt-2">
                    <input type="text" name="tags" id="tags" placeholder="politics, bihar, news" value="{{ old('tags', is_array($post->tags) ? implode(', ', $post->tags) : $post->tags) }}"
                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="status" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Status *</label>
                <div class="mt-2">
                    <select id="status" name="status"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                        <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
            </div>

            <div class="col-span-full flex items-center gap-3">
                <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}
                       class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-600">
                <label for="is_featured" class="text-sm font-medium text-gray-900 dark:text-gray-100">Featured Article (show on homepage)</label>
            </div>

            {{-- SEO --}}
            <div class="col-span-full pt-6 border-t border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">SEO Settings</h3>
                <div class="grid grid-cols-1 gap-y-5">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}"
                               class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm">
                    </div>
                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="2"
                                  class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-white dark:bg-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm">{{ old('meta_description', $post->meta_description) }}</textarea>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 dark:border-gray-700 px-4 py-4 sm:px-8 bg-gray-50 dark:bg-gray-800/50">
        <button type="button" onclick="history.back()"
                class="text-sm font-semibold text-gray-900 dark:text-gray-300">Cancel</button>
        <button type="submit" id="submit-btn"
                class="rounded-md bg-primary-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 transition">
            Update Article
        </button>
    </div>
</form>


@endsection
