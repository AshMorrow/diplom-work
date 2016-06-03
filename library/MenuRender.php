<?php
namespace library;
class MenuRender
{
    public static function render()
    {
        $loged = \library\Session::get('loged');
        $admin = \library\Session::get('admin');
        $main = [[
            'Главная' => '/'
        ],[
            'Пользователи' => 'admin/userlist',
            'loged' => true,
            'admin' => true
          ],[
            'Редактировать' => 'admin/pokemonselect',
            'loged' => true,
            'admin' => true
        ], [
            'Регистрация' => 'security/registration',
            'loged' => false,
            'admin' => false
        ], [
            'Войти' => 'security/login',
            'loged' => false,
            'admin' => false
        ], [
            'Выйти' => 'security/logout',
            'loged' => true,
            'admin' => false
        ]
        ];

        foreach ($main as $value) {
            foreach ($value as $k => $d) {
                if (!isset($value['loged'])) {
                    if($d == '/'){
                        $href = '/';
                    }else{
                        $href = '/?route='.$d;
                    }
                    echo "<li><a href='$href'>$k</a></li>";
                    continue;
                }
                if ($value['loged'] == $loged && $value['admin'] == true && $admin == true) {
                    if ($k != 'loged' && $k != 'admin') {
                        $href = '/?route='.$d;
                        echo "<li><a href='$href'>$k</a></li>";
                    }
                }elseif ($value['loged'] == $loged && $value['admin'] == false) {
                    if ($k != 'loged' && $k != 'admin') {
                        $href = '/?route='.$d;
                        echo "<li><a href='$href'>$k</a></li>";
                    }
                }
            }
        }
    }
}