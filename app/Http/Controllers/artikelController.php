<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\artikelModel;
use Illuminate\Http\Request;
use App\Models\komentarModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class artikelController extends Controller

{
    //user
    public function beranda()
    {
        $artikels = artikelModel::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('beranda', \compact('artikels'));
    }


    public function bacaArtikel($id_artikel)
    {
        $bacaArtikels =  artikelModel::with('user', 'komentar')->find($id_artikel);
        return view('bacaartikel', \compact('bacaArtikels'));
    }

    public function tambahKomentar(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|min:1|max:25|string',
            'email' => 'required|string|email|min:1|max:100',
            'komentar' => 'required|string|min:1'
        ]);

        komentarModel::create(
            [
                'id_komentar' => Str::uuid(),
                'id_artikel' => $request->id_artikel,
                'nama' =>  $request->nama,
                'email' => $request->email,
                'komentar' => $request->komentar
            ]
        );
        toast('Komentar Anda Berhasil ', 'success');
        return \redirect()->route('baca-artikel', ['id_artikel' => $request->id_artikel]);
    }

    public function pencarian(Request $request)
    {
        $validated = $request->validate([
            'input' => 'required|min:1|max:255|string'
        ]);
        $pencarian = $request->input('input');
        $hasilPencarian = artikelModel::where('judul_artikel', 'like', '%' . $pencarian . '%')->get();
        return \view('hasilpencarian', \compact('hasilPencarian'));
    }
    //end user

    //admin
    public function dashboard()
    {
        $artikels = artikelModel::count();
        return view('admin.dashboard', \compact('artikels'));
    }

    public function dataArtikel()
    {
        $artikels = artikelModel::with('user', 'komentar')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dataartikel', \compact('artikels'));
    }


    public function postArtikel()
    {

        return view('admin.postArtikel');
    }

    public function addPostArtikel(Request $request)
    {
        $validated = $request->validate([
            'judul_artikel' => 'required|min:1|max:50|string',
            'foto_artikel' => 'required|mimes:png,jpg,jpeg|max:12000',
            'isi_artikel' => 'required|min:1|max:255|string',
        ]);

        if ($request->hasFile('foto_artikel')) {
            $file = $request->file('foto_artikel');
            $path = $file->store('foto_artikel');
        }

        artikelModel::create(
            [
                'id_artikel' => Str::uuid(),
                'id_user' => Auth::user()->id_user,
                'judul_artikel' => $request->judul_artikel,
                'isi_artikel' => $request->isi_artikel,
                'foto_artikel' =>  $path,
            ]
        );
        Alert::success('Sukses Menambahkan Artikel');
        return redirect()->route('data-artikel')->with('success', 'Sukses Menambahkan Artikel');
    }

    public function hapusArtikel($id_artikel)
    {
        $artikel = artikelModel::find($id_artikel);

        if (!$artikel) {
            return redirect()->route('data-artikel')->with('error', 'Artikel not found');
        }

        if ($artikel->foto_artikel) {
            Storage::disk('public')->delete($artikel->foto_artikel);
        }

        $artikel->delete();
        Alert::success('Artikel Berhasil Dihapus');
        return redirect()->route('data-artikel')->with('hapusSuccess', 'Artikel Berhasil Dihapus');
    }

    public function ubahArtikel($id_artikel)
    {
        $artikels = artikelModel::findOrFail($id_artikel)->first();
        return view('admin.ubah-artikel', \compact('artikels'));
    }

    public function laporanArtikel()
    {
        $laporanArtikels = artikelModel::with('komentar')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.laporan-artikel', compact('laporanArtikels'));
    }

    public function kelolaKomentar($id_artikel)
    {
        $artikels = artikelModel::with('komentar')->find($id_artikel);
        return view('admin.komentar', \compact('artikels'));
    }

    public function hapusKomentar($id_komentar)
    {
        $hapusKomentar = komentarModel::find($id_komentar);
        $hapusKomentar->delete();
        Alert::success('Komentar Berhasil Dihapus');
        return \redirect()->route('komentar', ['id_artikel' => $hapusKomentar->artikel->id_artikel]);
    }
    //end admin

}
