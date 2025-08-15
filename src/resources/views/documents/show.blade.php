@extends('layouts.app')

@section('title', '書類詳細')

@section('content')
<div class="flex justify-center">
  <div class="card shadow-md bg-base-100 w-1/3 ml-2 mr-2 mt-10 mb-10">
    <div class="card-body">
      <h2 class="card-title">{{ $document->title }}</h2>
      <span class="text-sm text-gray-500">作成日時：{{ $document->created_at->format('Y-m-d H:i:s') }}</span>
      <span class="text-sm text-gray-500">更新日時：{{ $document->updated_at->format('Y-m-d H:i:s') }}</span>
      <p class="mt-4">内容：{{ $document->content }}</p>
      <div class="card-actions justify-end mt-4">
        <button class="btn btn-outline text-gray-600 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
          </svg>
          <a href="{{ route('documents.index') }}">一覧へ戻る</a>
        </button>
        <button class="btn btn-outline btn-info text-sky-600 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
          </svg>
          <a href="{{ route('documents.edit', $document->id) }}">編集</a>
        </button>
        <form action="{{ route('documents.destroy', $document->id) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-outline btn-error text-red-600 flex items-center gap-2" onclick="return confirm('削除しますか？')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
            削除
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection