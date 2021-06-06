<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(5,true),
            'author'=>$this->faker->name(),
            'category_id'=>2,
            'content'=>$this->faker->sentences(10,true),
            'created_at'=>now(),
        ];
    }
}
