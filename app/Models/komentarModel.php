<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class komentarModel extends Model
{
    use HasFactory, HasUuids;


    protected $primaryKey = "id_komentar";
    protected $table = "komentar";
    protected $fillable = ['id_komentar', 'id_artikel', 'nama', 'email', 'komentar'];


    public function artikel(): BelongsTo
    {
        return $this->belongsTo(artikelModel::class, 'id_artikel', 'id_artikel');
    }
}
