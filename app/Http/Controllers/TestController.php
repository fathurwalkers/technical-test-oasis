<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class TestController extends Controller
{
    public function index()
    {
        return view('index');
    }
    // FUNGSI - FUNGSI Soal 5 (CRUD Pegawai)
    public function soal_five()
    {
        $pegawai = Pegawai::all();
        return view('soal-five', [
            'pegawai' => $pegawai
        ]);
    }

    public function post_tambah_pegawai(Request $request)
    {
        $pegawai = new Pegawai;
        $validator = $request->validate([
            'name' => 'required|regex:/^[\p{L}\s]+$/u',
            'email' => 'required|email',
            'gender' => 'required',
            'nip' => 'required|numeric',
            'hobby' => 'required',
            'photo' => 'required|image|mimes:jpeg,png|max:1024',
        ]);

        // Menghandle upload foto
        // $photoPath = $request->file('photo')->store('photos', 'public');
        $randomNamaGambar = Str::random(10) . '.jpg';
        $photoPath = $request->file('photo')->move(public_path('photo'), strtolower($randomNamaGambar));

        // Membuat record pegawai baru
        $save_pegawai = $pegawai->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'nip' => $request->input('nip'),
            'hobby' => $request->input('hobby'),
            'photo' => $photoPath->getFilename(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $save_pegawai->save();

        return redirect()->route('soal-five')->with('status', 'Data pegawai berhasil ditambahkan.');
    }

    public function post_update_pegawai(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        if ($request->photo == null) {
            $photoName = $pegawai->photo;
            $validator = $request->validate([
                'name' => 'required|regex:/^[\p{L}\s]+$/u',
                'email' => 'required|email',
                'gender' => 'required',
                'nip' => 'required|numeric',
                'hobby' => 'required',
            ]);
        } else {
            $validator = $request->validate([
                'name' => 'required|regex:/^[\p{L}\s]+$/u',
                'email' => 'required|email',
                'gender' => 'required',
                'nip' => 'required|numeric',
                'hobby' => 'required',
                'photo' => 'required|image|mimes:jpeg,png|max:1024',
            ]);
            $randomNamaGambar = Str::random(10) . '.jpg';
            $photo = $request->file('photo')->move(public_path('photo'), strtolower($randomNamaGambar));
            $photoName = $photo->getFilename();
        }
        $ubah_pegawai = $pegawai->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
            'nip' => $request->input('nip'),
            'hobby' => $request->input('hobby'),
            'photo' => $photoName,
            'updated_at' => now()
        ]);
        return redirect()->route('soal-five')->with('status', 'Data pegawai berhasil diubah.');
    }

    public function post_hapus_pegawai(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $delete_pegawai = $pegawai->forceDelete();
        if ($delete_pegawai == true) {
            return redirect()->route('soal-five')->with('status', 'Data pegawai berhasil dihapus.');
        } else {
            return redirect()->route('soal-five')->with('status', 'Data pegawai gagal dihapus.');
        }
    }

    // FUNGSI - FUNGSI Soal 1 Sampai 4

    public function soal_one()
    {
        $input = 20;
        for ($i = 1; $i <= $input; $i++) {
            if ($i % 6 == 0) {
                echo "&nbsp; DIGITAL OASIS<br />";
            } else if ($i % 2 == 0) {
                echo "&nbsp; " . $i . " DI<br />";
            } else if ($i % 3 == 0) {
                echo "&nbsp; " . $i . " OS<br />";
            } else {
                echo "&nbsp; " . $i . " <br />";
            }
        }

        return view('soal-one', [
            'input' => $input,
        ]);
    }

    public function soal_two()
    {
        $query_1 = "SELECT * FROM pendaftaran WHERE id >= 20 AND <= 100";
        $query_2 = "UPDATE pendaftaran SET tahun = 2016 WHERE id >= 20 AND <= 100";
        return view('soal-two', [
            'query_1' => $query_1,
            'query_2' => $query_2,
        ]);
    }

    public function soal_three($teks1, $teks2)
    {
        if ($this->cekAnagram($teks1, $teks2)) {
            dump(true);
        } else {
            dump(false);
        }
    }

    public function soal_four($input)
    {
        $input = str_replace(".", "", $input); // Menghapus titik dalam angka
        $jumlah_satuan = str_split($input); // Memecah angka menjadi array digit

        $panjang_Satuan = count($jumlah_satuan);
        for ($i = 0; $i < $panjang_Satuan; $i++) {
            $output = $jumlah_satuan[$i];
            for ($j = $panjang_Satuan - 1; $j > $i; $j--) {
                $output .= '0';
            }
            echo $output . "<br />";
        }
    }

    public function cekAnagram($teks1, $teks2)
    {
        $teks1 = strtolower(str_replace(' ', '', $teks1));
        $teks2 = strtolower(str_replace(' ', '', $teks2));
        if (strlen($teks1) !== strlen($teks2)) {
            return false;
        }
        $jumlahKarakter = [];
        for ($i = 0; $i < strlen($teks1); $i++) {
            $char = $teks1[$i];
            if (isset($jumlahKarakter[$char])) {
                $jumlahKarakter[$char]++;
            } else {
                $jumlahKarakter[$char] = 1;
            }
        }
        for ($i = 0; $i < strlen($teks2); $i++) {
            $char = $teks2[$i];
            if (isset($jumlahKarakter[$char])) {
                $jumlahKarakter[$char]--;
                if ($jumlahKarakter[$char] === 0) {
                    unset($jumlahKarakter[$char]);
                }
            } else {
                return false;
            }
        }
        return empty($jumlahKarakter);
    }
}
