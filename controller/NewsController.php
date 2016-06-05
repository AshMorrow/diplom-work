<?php

use \library\Request;

class NewsController extends \library\Controller
{
    public function newsMainAction(Request $request)
    {
        $model = new \model\NewsModel();
        $page_model = new \model\PostModel();
        $news = [];
        if (\library\Session::get('loged')) {
            $loged = null;
        } else {
            $loged = 0;
        }
        $news_category = $model->findAllcategory($loged, $loged);
        foreach ($news_category as $k => $v) {
            $news_post = $page_model->selectPostByCatId($v['id']);
            if ($news_post) {
                $news[$v['name']] = $news_post;
            }
        }
        return $this->render('index', $news);
    }

    public function newsCategoryAction(Request $request)
    {
        $model = new \model\NewsModel();
        $page_model = new \model\PostModel();
        $cat_id = $request->get('catId');
        $offset = $request->get('offset');
        if(!$offset){
            $offset = 0;
        }
        if ($cat_id) {

            $news = [];
            if (\library\Session::get('loged')) {
                $loged = null;
            } else {
                $loged = 0;
            }
            $news_category = $model->getCategoy($cat_id, $loged);
            foreach ($news_category as $k => $v) {
                $news_post = $page_model->selectPostByCatId($news_category['id'],10,$offset);
                if ($news_post) {
                    $news[$news_category['name']] = $news_post;
                }
            }
            return $this->render('category', $news);
        }
    }

    public function newsPostAction(Request $request)
    {
        $model = new \model\NewsModel();
        $page_model = new \model\PostModel();
        $post_id = $request->get('postId');
        if ($post_id) {
            if($request->isPost()){
                $comment_model = new \model\CommentModel();
                $comment = [
                    'user_id' => \library\Session::get('userid'),
                    'post_id' => $post_id,
                    'massage' => $request->post('massage')
                ];
                if($comment_model->addComment($comment)){
                    \library\Session::setFlash('Коментарий добавлен');
                }

            }
            if (\library\Session::get('loged')) {
                $loged = null;
            } else {
                $loged = 0;
            }
            $news_post = $page_model->selectPostBytId($post_id);
            if ($loged == null) {
                return $this->render('post', $news_post);
            } elseif ($model->getCategoy($news_post['cat_id'], $loged)) {
                \library\Router::redirect('/?route=security/login');
            }
        }
    }
}