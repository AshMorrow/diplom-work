<?php
/**
 * Костыли для новостей
 */

namespace library;


class NewsHelper
{
    public static function selectListCatalog()
    {
        $model = new \model\NewsModel();
        $category_data = $model->findAllcategory(0);
        foreach ($category_data as $k => $v) {
            echo "<option value=" . $category_data[$k]['id'] . ">" . $category_data[$k]['name'] . "</option>";
        }
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
                    <div class="panel-heading"><?= $user_name['nick_name']?></div>
                    <div class="panel-body">
                        <?= $v['massage'] ?>
                    </div>
                </div>
                <?php
            }
        }else{
            ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4 class="text-center">Еще никто не комментировал.</h4>
                </div>
            </div>
<?php
        }
    }

}