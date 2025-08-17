<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFolderRequest;
use \Illuminate\Database\Eloquent\Collection;
use App\Models\Folder;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FolderController extends Controller
{
    private $document;
    private $folder;

    public function __construct(Folder $folder, Document $document)
    {
        $this->folder = $folder;
        $this->document = $document;
    }
    /**
     * フォルダ一覧
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        Log::info(__METHOD__);
        $parent_folder_id = $request->input('parent_folder_id');
        $folders = $this->folder->where('parent_folder_id', $parent_folder_id)->get();
        $documents = $this->document->where('folder_id', $parent_folder_id)->get();
        $items = $this->addType($folders, $documents);
        return view('folders.index', compact('items', 'parent_folder_id'));
    }

    /**
     * フォルダ作成画面表示
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        Log::info(__METHOD__);
        $parent_folder_id = $request->input('parent_folder_id');
        return view('folders.create', compact('parent_folder_id'));
    }

    /**
     * フォルダ保存
     * @param StoreFolderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFolderRequest $request)
    {
        Log::info(__METHOD__);
        $folder = Folder::create($request->all());
        $parent_folder_id = $folder->parent_folder_id;

        if (is_null($parent_folder_id)) {
            return redirect()->route('documents.index')->with('success', 'フォルダを作成しました');
        } else {
            return redirect()->route('folders.index', ['parent_folder_id' => $parent_folder_id])->with('success', 'フォルダを作成しました');
        }
    }

    /**
     * フォルダと書類にtypeを追加
     * @param Illuminate\Database\Eloquent\Collection $folders
     * @param Illuminate\Database\Eloquent\Collection $documents
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function addType(Collection $folders, Collection $documents)
    {
        Log::info(__METHOD__);

        $folders->transform(function ($folder) {
            $folder->type = 'folder';
            return $folder;
        });

        $documents->transform(function ($document) {
            $document->type = 'document';
            return $document;
        });

        $items = $folders->concat($documents);

        return $items;
    }
}
