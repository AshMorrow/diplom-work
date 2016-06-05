<?php
use library\Request;

class AdminNewsController extends \library\Controller{

    public function newsCategortyAction(Request $request)
    {
        if($request->get('delited')){
            $this->newsCategortyDelite($request->get('delited'));
            \library\Router::redirect('/?route=adminnews/newscategorty');
        }
        if($request->isPost()){
            $this->newsCategortyAdd($request);
        }
        $model = new \model\NewsModel();
        $category_data = $model->findAllcategory();
        return $this->render('categorylist', $category_data);
    }

    public function newsCategortyEditAction(Request $request)
    {
        $model = new \model\NewsModel();
        $category_data = $model->getCategoy($request->get('categoryId'));
        if ($request->isPost()) {
            $this->newsCategortyUpdateAction($request);
        }
        return $this->render('categoryedit', $category_data);
    }

    public function newsCategortyUpdateAction(Request $request)
    {
        if ($request->isPost()) {
            $model = new \model\NewsModel();
            $id = $request->post('id');
            $category_data = [
                'name' => $request->post('name'),
                'loged' => $request->post('loged'),
                'delited' => $request->post('delited'),
            ];
            if($model->updateCategory($id,$category_data)){
                \library\Session::setFlash('Сохранено');
                \library\Router::redirect($_SERVER['REQUEST_URI']);
            }else{
                \library\Session::setFlash('что то нетак');
            }
        }

    }

    public function newsCategortyAdd(Request $request){
        $model = new \model\NewsModel();
        $category_data = [
            'name' => $request->post('name'),
            'loged' => $request->post('loged'),
        ];
        if (!$model->findCategoryByName($category_data['name'])) {
            if ($model->addCategory($category_data)) {
                \library\Router::redirect($_SERVER['REQUEST_URI']);
            } else {
                \library\Session::setFlash('что то не так');
            }
        }
        \library\Session::setFlash('Такой каталог уже существует');
    }
    public function newsCategortyDelite($id)
    {
        $model = new \model\NewsModel();
        $model->deliteCategory($id);
    }

    /********************Post Admin Actions********************/

    public function newsPostAddAction(Request $request)
    {
        $model = new \model\PostModel();
        if ($request->isPost()) {
            $post_data=[
                'cat_id'=>$request->post('cat_id'),
                'post_name'=>$request->post('post_name'),
                'post_text'=>$request->post('post_text'),
                'tags'=>$request->post('tags'),
                'author_id'=>\library\Session::get('userid'),
                'date'=> $request->post('date')
            ];
            if($model->addPost($post_data)){
                \library\Session::setFlash('Пост добавлен');
            }
        }
        return $this->render('newspostadd');
    }



}
