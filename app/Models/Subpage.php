<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subpage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'parent_id'];

    public function parentPage(): BelongsTo
    {
        return $this->belongsTo(Subpage::class, 'parent_id');
    }

    public function childrenPages(): HasMany
    {
        return $this->hasMany(Subpage::class, 'parent_id')->with('childrenPages');
    }

    /**
     * $self gibt an ob die subpage selber mit gelistet werden soll
     */
    public function allParentPages(bool $self = false)
    {
        $parentSubpages = collect();
        $currentPage = $this;

        if ($self) {
            $parentSubpages->push($currentPage);
        }

        // Schleife durch alle übergeordneten Subpages, bis wir keine mehr finden
        while ($currentPage->parentPage) {
            $parentSubpages->push($currentPage->parentPage);
            $currentPage = $currentPage->parentPage;
        }

        return $parentSubpages->reverse();
    }

    public function getUrlPath(): string
    {
        $basePath = $this->parent_id === null ? url()->to('/').'/verein' : $this->parentPage->getUrlPath();

        $path = $basePath.($this->parent_id === null ? '/' : $this->title.'/');

        return $path;
    }

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
