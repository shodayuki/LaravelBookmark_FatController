<?php

namespace App\Bookmark\UseCase;

use App\Http\Requests\UpdateBookmarkRequest;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

final class UpdateBookmarkUseCase
{
    /**
     * ブックマーク更新
     * コメントとカテゴリのバリデーションは作成時のそれと合わせる
     * 本人以外は編集できない
     * ブックマーク後24時間経過したものは編集できない仕様
     *
     * @param UpdateBookmarkRequest $request
     * @param int $id
     * @throws ValidationException
     */
    public function handle(UpdateBookmarkRequest $request, int $id)
    {
        $model = Bookmark::query()->findOrFail($id);

        if ($model->can_not_delete_or_edit) {
            throw ValidationException::withMessages([
                'can_edit' => 'ブックマーク後24時間経過したものは編集できません'
            ]);
        }

        if ($model->user_id !== Auth::id()) {
            abort(403);
        }

        $model->category_id = $request->category;
        $model->comment = $request->comment;
        $model->save();
    }
}