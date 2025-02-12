<?php
use App\Models\Comment;
use App\Models\User;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'note_id' => Note::factory(),
            'text' => $this->faker->sentence(),
        ];
    }
}
