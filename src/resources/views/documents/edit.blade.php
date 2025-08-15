@extends('layouts.app')

@section('title', '書類編集')
@section('content')
<div class="flex justify-center">
  <div class="card shadow-md bg-base-100 w-1/3 ml-2 mr-2 mt-10 mb-10">
    <div class="card-body">
      <h2 class="card-title">書類編集</h2>
      <form action="{{ route('documents.update', $document->id) }}" method="post">
        @csrf
        <fieldset class="fieldset">
          <legend class="fieldset-legend">書類タイトル</legend>
          <input type="text" class="input w-full" name="title" value="{{ $document->title }}" placeholder="書類のタイトルを入力してください" />
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">内容</legend>
          <textarea class="textarea h-24 w-full" name="content" placeholder="内容を入力してください">{{ $document->content }}</textarea>
        </fieldset>
        <div class="card-actions justify-end mt-4">
          <button class="btn btn-outline text-gray-600">
            <a href="{{ route('documents.show', $document) }}">キャンセル</a>
          </button>
          <button type="submit" class="btn btn-outline btn-info text-sky-600">更新</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection