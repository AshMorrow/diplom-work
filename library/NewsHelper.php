<?php
/**
 * Костыли для новостей
 */

namespace library;


class NewsHelper
{
    public static function selectListCatalog($id = null)
    {
        $model = new \model\NewsModel();
        $category_data = $model->findAllcategory(0);
        foreach ($category_data as $k => $v) {
            if ($id == $category_data[$k]['id']) {
                echo "<option selected value=" . $category_data[$k]['id'] . ">" . $category_data[$k]['name'] .
                    "</option>";
            } else {
                echo "<option value=" . $category_data[$k]['id'] . ">" . $category_data[$k]['name'] .
                    "</option>";
            }
        }
    }

    public static function slider()
    {
        $model = new \model\PostModel();
        $post_data = $model->selectLast();
        foreach ($post_data as $k => $v) {
            echo "<p class='text-center'><a href=/?route=news/newspost&postId=" . $post_data[$k]['id'] . "><img
src=\"http://placehold.it/350x150&text=FooBar1\">
" .
                $post_data[$k]['post_name'] .
                "</a></p>";
        }
    }

    public static function menuListCatalog()
    {
        $model = new \model\NewsModel();
        $post_model = new \model\PostModel();
        $category_data = $model->findAllcategory();
        echo '<h4>Категории</h4><hr>';
        echo "<ul class='nav nav-stacked'>";
        foreach ($category_data as $k => $v) {
            if ($post_model->selectPostByCatId($category_data[$k]['id'])) {
                echo "<li><a href=/?route=adminnews/newspostlist&catId=" . $category_data[$k]['id'] . ">"
                    . $category_data[$k]['name'] . "</a></li>";
            }
        }
        echo "</ul>";
    }

    public static function menuCatalog()
    {
        $model = new \model\NewsModel();
        $post_model = new \model\PostModel();
        if (\library\Session::get('loged')) {
            $loged = null;
        } else {
            $loged = 0;
        }
        if ($loged === null) {
            $category_data = $model->findAllcategory(0);
        } else {
            $category_data = $model->findAllcategory(0, $loged);
        }
        echo '<h4>Категории</h4><hr>';
        echo "<ul class='nav nav-stacked'>";
        foreach ($category_data as $k => $v) {
            if ($post_model->selectPostByCatId($category_data[$k]['id'])) {
                echo "<li><a href=/?route=news/newscategory&catId=" . $category_data[$k]['id'] . ">"
                    . $category_data[$k]['name'] . "</a></li>";
            }
        }
        echo "</ul>";
    }

    public static function showComment($post_id)
    {
        $comment_model = new \model\CommentModel();
        $user_model = new \model\UserModel();
        $helper_model = new \model\HelperModel();
        $comments = $comment_model->getComment($post_id);
        if ($comments) {
            foreach ($comments as $v) {
                $user_name = $user_model->selectById($v['user_id']);
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading"><?= $user_name['nick_name'] ?></div>
                    <div class="panel-body">
                        <?= $v['massage'] ?>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="text-center">Еще никто не комментировал.</h4>
                </div>
            </div>
            <?php
        }
    }


    public static function subscribe()
    {
        /***
         * Это костыль... 3 утра ... нехочу делать еще модель контролер шаблон...
         */
        $reqelst = new \library\Request();
        if($reqelst->isPost()){
            $name = $reqelst->post('name');
            $last_name = $reqelst->post('last_name');
            $email = $reqelst->post('email');
            $db = DbConnection::getInstance()->getPdo();
            $sth = $db->prepare("INSERT INTO subscribe(`name`,last_name,email)
            values ('{$name}','{$last_name}','{$email}')");
            $data = $sth->execute();
            if($data){
                Cookie::set('subscribe','1');
            }
            return 0;
        }
        ?>
        <script>
            function subscribe() {
                $("#subscribeBtn").click();
            }
            setTimeout(subscribe, 15000);
        </script>
        <button id="subscribeBtn" class="hidden" data-toggle="modal" data-target="#subscribe"></button>
        <div class="modal fade" id="subscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Подписадся на рассылку</h4>
                    </div>
                    <form method="post" action="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input id="name" placeholder="Название" class="form-control" type="text" name="name"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Фамилия</label>
                                <input id='last_name' type="text" placeholder="Фамилия" name="last_name"
                                       class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id='email' type="email" placeholder="emal@test.ru" name="email"
                                       class="form-control"
                                       required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Подписатся</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

}