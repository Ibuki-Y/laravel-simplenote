<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Memo;
use App\Tag;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        // 前処理
        view()->composer('*', function ($view) {
            $user = \Auth::user();

            $memoModel = new Memo();
            $memos = $memoModel->myMemo(\Auth::id());

            $tagModel = new Tag();
            $tags = $tagModel->where('user_id', \Auth::id())->get();

            $view->with('user', $user)->with('memos', $memos)->with('tags', $tags);
        });
    }
}
