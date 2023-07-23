<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class artikelModel extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = "id_artikel";
    protected $table = "artikel";
    protected $fillable = ['id_artikel', 'id_user', 'judul_artikel', 'isi_artikel', 'foto_artikel'];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }


    public function komentar(): HasMany
    {
        return $this->hasMany(komentarModel::class, 'id_artikel');
    }
}
