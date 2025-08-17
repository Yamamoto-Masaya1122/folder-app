@extends('layouts.app')

@section('title', '書類作成')
@section('content')
<div class="flex justify-center">
  <div class="card shadow-md bg-base-100 w-1/3 ml-2 mr-2 mt-10 mb-10">
    <div class="card-body">
      <h2 class="card-title">書類新規作成</h2>
      <form action="{{ route('documents.store') }}" method="post">
        @csrf
        <fieldset class="fieldset">
          <legend class="fieldset-legend">書類タイトル</legend>
          <input type="text" class="input w-full" name="title" value="{{ old('title') }}" placeholder="書類のタイトルを入力してください" />
          @error('title')
          <p class="text-error mt-1">{{ $message }}</p>
          @enderror
          <input type="hidden" name="parent_folder_id" value="{{ $parent_folder_id ?? null }}" />
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">内容</legend>
          <textarea class="textarea h-24 w-full" name="content" value="{{ old('content') }}" placeholder="内容を入力してください"></textarea>
        </fieldset>
        <div class="card-actions justify-end mt-4">
          <button class="btn btn-outline text-gray-600">
            <a href="{{ route('documents.index') }}">キャンセル</a>
          </button>
          <button type="submit" class="btn btn-outline btn-info text-sky-600">作成</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection