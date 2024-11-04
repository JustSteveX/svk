<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subpage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    public function parseMarkdown(): string
    {
        $parsedContent = preg_replace([
            '/<span class="tab"><\/span>/',
            '/<br\s*\/?>/',  // RegEx für <br> oder <br />
        ], [
            "\t",
            "\n",
        ], $this->content);

        // Gib den umgewandelten Text zurück
        return $parsedContent;
    }
}
