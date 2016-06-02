<?php
namespace model;


use library\Request;

class PokemonForm
{
    public $name;
    public $pokemon_id;
    public $descriptionX;
    public $descriptionY;
    public $weaknesses;
    public $type;
    public $evolutions;
    public $hp;
    public $attack;
    public $defense;
    public $special_attack;
    public $special_defense;
    public $speed;
    public $height;
    public $weight;
    public $gender;
    public $category;
    public $abilities;

    public function __construct(Request $request)
    {
        $this->name = $request->get('name');
        $this->pokemon_id = $request->get('pokemon_id');
        $this->descriptionX = $request->get('descriptionX');
        $this->descriptionY = $request->get('descriptionY');
        $this->weaknesses = $request->get('weaknesses');
        $this->type = $request->get('type');
        $this->evolutions = $request->get('evolutions');
        $this->hp = $request->get('hp');
        $this->attack = $request->get('attack');
        $this->defense = $request->get('defense');
        $this->special_attack = $request->get('special_attack');
        $this->special_defense = $request->get('special_defense');
        $this->speed = $request->get('speed');
        $this->height = $request->get('height');
        $this->weight = $request->get('weight');
        $this->gender = $request->get('gender');
        $this->category = $request->get('category');
        $this->abilities = $request->get('abilities');
    }

    /***
     * Эта вся ересь задумывалась для валидации
     * но.... в общем валидации не будет...
     */
}