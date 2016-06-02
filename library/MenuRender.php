<?php
namespace library;
class MenuRender
{
    public static function render()
    {
        $loged = \library\Session::get('loged');
        $main = [[
            'Главная' => '/'
        ],[
            'Редактировать' => 'admin/pokemonselect',
            'loged' => true
        ], [
            'Регистрация' => 'security/registration',
            'loged' => false
        ], [
            'Войти' => 'security/login',
            'loged' => false
        ], [
            'Выйти' => 'security/logout',
            'loged' => true
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
                    echo "<a href='$href'>$k</a>";
                    continue;
                }
                if ($value['loged'] == $loged) {
                    if ($k != 'loged') {
                        $href = '/?route='.$d;
                        echo "<a href='$href'>$k</a>";
                    }
                }
            }
        }
    }
}