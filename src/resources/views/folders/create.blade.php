@extends('layouts.app')

@section('title', 'フォルダ作成')
@section('content')
<div class="flex justify-center">
  <div class="card shadow-md bg-base-100 w-1/3 ml-2 mr-2 mt-10 mb-10">
    <div class="card-body">
      <h2 class="card-title">フォルダ作成</h2>
      <form action="{{ route('folders.store') }}" method="post">
        @csrf
        <fieldset class="fieldset">
          <legend class="fieldset-legend">フォルダ名</legend>
          <input type="text" class="input w-full" name="name" value="{{ old('name') }}" placeholder="フォルダの名前を入力してください" />
          @error('name')
          <p class="text-error mt-1">{{ $message }}</p>
          @enderror
          <input type="hidden" name="parent_folder_id" value="{{ $parent_folder_id ?? null }}" />
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