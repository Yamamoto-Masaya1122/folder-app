@extends('layouts.app')

@section('title', '書類一覧')
@section('content')
<!-- ヘッダー -->
<div class="flex justify-end gap-2 ml-2 mr-2 mt-10 mb-10">
  <button class="btn btn-outline btn-info text-sky-600">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
    </svg>
    <a href="{{ route('documents.create', ['parent_folder_id' => $parent_folder_id]) }}">新規書類作成</a>
  </button>
  <button class="btn btn-outline btn-info text-sky-600">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 13.5H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
    </svg>
    <a href="{{ route('folders.create', ['parent_folder_id' => $parent_folder_id]) }}">新規フォルダ作成</a>
  </button>
</div>

<!-- コンテンツ -->
<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 ml-2 mr-2 shadow-md">
  <table class="table">
    <thead>
      <tr>
        <th>名前</th>
        <th>作成日</th>
        <th>更新日</th>
      </tr>
    </thead>
    <tbody>
      @if ($items->isEmpty())
      <tr>
        <td colspan="3" class="text-center">書類がありません</td>
      </tr>
      @endif
      @foreach ($items as $item)
      <tr>
        <td class="flex items-center gap-2">

          @if ($item->type === 'folder')
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13.5H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
          </svg>
          <a href="{{ route('folders.index', ['parent_folder_id' => $item->id]) }}" class="hover:underline hover:text-cyan-600">
            {{ $item->name }}
          </a>
          @elseif ($item->type === 'document')
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
          </svg>
          <a href="{{ route('documents.show', $item->id) }}" class="hover:underline hover:text-cyan-600">
            {{ $item->title }}
          </a>
          @endif
        </td>
        <td>{{ $item->created_at }}</td>
        <td>{{ $item->updated_at }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection