<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    private $document;
    private $folder;

    public function __construct(Document $document, Folder $folder)
    {
        $this->document = $document;
        $this->folder = $folder;
    }

    /**
     * 書類一覧
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        Log::info(__METHOD__);

        $folders = $this->folder->whereNull('parent_folder_id')->get();
        $documents = $this->document->whereNull('folder_id')->get();

        $folders->transform(function ($folder) {
            $folder->type = 'folder';
            return $folder;
        });

        $documents->transform(function ($document) {
            $document->type = 'document';
            return $document;
        });

        $items = $folders->concat($documents);

        return view('documents.index', compact('items'));
    }

    /**
     * 書類作成
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        Log::info(__METHOD__);
        $parent_folder_id = $request->input('parent_folder_id');
        return view('documents.create', compact('parent_folder_id'));
    }

    /**
     * 書類保存
     * @param StoreDocumentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDocumentRequest $request)
    {
        Log::info(__METHOD__);
        $parent_folder_id = $request->input('parent_folder_id');
        $document = Document::create($request->all());
        if(is_null($parent_folder_id)) {
            return redirect()->route('documents.index')->with('success', '書類を作成しました');
        } else {
            return redirect()->route('folders.index', ['parent_folder_id' => $parent_folder_id])->with('success', '書類を作成しました');
        }
        return redirect()->route('documents.show', $document->id)->with('success', '書類を作成しました');
    }

    /**
     * 書類詳細
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id)
    {
        Log::info(__METHOD__);
        $document = Document::find($id);
        return view('documents.show', compact('document'));
    }

    /**
     * 書類編集
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $id)
    {
        Log::info(__METHOD__);
        $document = Document::find($id);
        return view('documents.edit', compact('document'));
    }

    /**
     * 書類更新
     * @param UpdateDocumentRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateDocumentRequest $request, string $id)
    {
        Log::info(__METHOD__);
        try {
            $document = Document::find($id);
            $document->update($request->all());
            return redirect()->route('documents.show', $document->id)->with('success', '書類を更新しました');
        } catch (\Exception $e) {
            return redirect()->route('documents.show', $id)->with('error', '書類の更新に失敗しました');
        }
    }

    /**
     * 書類削除
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        Log::info(__METHOD__);
        try {
            $document = Document::find($id);
            $document->delete();
            return redirect()->route('documents.index')->with('success', '書類を削除しました');
        } catch (\Exception $e) {
            return redirect()->route('documents.index')->with('error', '書類の削除に失敗しました');
        }
    }
}
