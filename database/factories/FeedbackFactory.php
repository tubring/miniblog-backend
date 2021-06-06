<?php

namespace Database\Factories;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'content'=>$this->faker->sentence(3,true),
            'topic'=>'fake topic-'.mt_rand(1,99),
            'user_id'=>1,
            'create_at'=>now()
        ];
    }
}
