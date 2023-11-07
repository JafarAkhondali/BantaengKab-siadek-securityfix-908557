<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dtks;
use App\Penduduk;
use App\Wilayah;
use App\WilayahKepala;
use App\ProfilWilayah;
use App\PerangkatDesa;
use App\RencanaPemb;
use App\RealisasiPemb;
use App\Regulasi;
use App\Aspirasi;
use App\Bantuan;
use App\Blog;
use App\BlogCategory;
use App\Disabilitas;
use DB;
use Illuminate\Support\Facades\Validator;
class MainController extends Controller
{
    public function dtks()
    {
        $posts = Dtks::all();
        return response([
            'success' => true,
            'message' => 'List Semua Dtks',
            'data' => $posts
        ], 200);
    }
    public function penduduk()
    {
        $posts = Penduduk::all();
        return response([
            'success' => true,
            'message' => 'List Semua Penduduk',
            'data' => $posts
        ], 200);
    }
    public function wilayah()
    {
        $posts = Wilayah::all();
        return response([
            'success' => true,
            'message' => 'List Semua Wilayah',
            'data' => $posts
        ], 200);
    }
    public function wilayahKepala()
    {
        $posts = WilayahKepala::all();
        return response([
            'success' => true,
            'message' => 'List Semua Kepala Desa',
            'data' => $posts
        ], 200);
    }
    public function profilewilayah()
    {
        $posts = ProfilWilayah::all();
        return response([
            'success' => true,
            'message' => 'List Semua Profil Wilayah',
            'data' => $posts
        ], 200);
    }
    public function perangkatdesa()
    {
        $posts = PerangkatDesa::all();
        return response([
            'success' => true,
            'message' => 'List Semua Perangkat Desa',
            'data' => $posts
        ], 200);
    }
    public function rencana()
    {
        $posts = RencanaPemb::all();
        return response([
            'success' => true,
            'message' => 'List Semua Rencana Pembangunan',
            'data' => $posts
        ], 200);
    }
    public function realisasi()
    {
        $posts = RealisasiPemb::all();
        return response([
            'success' => true,
            'message' => 'List Semua Rencana Realisasi',
            'data' => $posts
        ], 200);
    }
    public function regulasi()
    {
        $posts = Regulasi::all();
        return response([
            'success' => true,
            'message' => 'List Semua Regulasi',
            'data' => $posts
        ], 200);
    }
    public function aspirasi()
    {

        $posts = DB::table('tbl_aspirasi')
            ->leftjoin('penduduk_real', 'tbl_aspirasi.nik', '=', 'penduduk_real.nik')
            ->select('tbl_aspirasi.*', 'penduduk_real.nama')
            ->get();
        // $posts = Aspirasi::all();
        return response([
            'success' => true,
            'message' => 'List Semua Aspirasi',
            'data' => $posts
        ], 200);
    }
    public function bantuan()
    {
        $posts = Bantuan::all();
        return response([
            'success' => true,
            'message' => 'List Semua Bantuan Sosial',
            'data' => $posts
        ], 200);
    }
    public function blog()
    {
        $posts = Blog::all();
        return response([
            'success' => true,
            'message' => 'List Semua Blog',
            'data' => $posts
        ], 200);
    }
    public function blogcategori()
    {
        $posts = BlogCategory::all();
        return response([
            'success' => true,
            'message' => 'List Semua Blog Category',
            'data' => $posts
        ], 200);
    }
     public function disabilitas()
    {
        $posts = Disabilitas::all();
        return response([
            'success' => true,
            'message' => 'List Semua Disabilitas',
            'data' => $posts
        ], 200);
    }

    public function store(Request $request)
    {

        //validate data
        $validator = Validator::make($request->all(), [
            'kd_wilayah'     => 'required',
            'nik'   => 'required',
            'kd_wilayah' => 'required',
            
            

        ],
            [
                'kd_wilayah.required' => 'Masukkan Wilayah !',
                'nik.required' => 'Masukkan NIK !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {
            $nik = $request->nik;
            $penduduk = Penduduk::where('nik',$nik)->first();

            if ($penduduk->count() > 0) {
                
            $aspirasi= new Aspirasi;
            $aspirasi->kd_wilayah = $request->kd_wilayah;
            $aspirasi->nik = $nik;
            $aspirasi->keterangan = $request->keterangan;
            $aspirasi->nama = $penduduk->nama;
            $aspirasi->creation_date = now();
            $aspirasi->last_updated_date = now();
            $aspirasi->jenis_aduan = $request->jenis_aduan;
            $aspirasi->no_hp = $request->no_hp;




            if ($aspirasi->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Aduan Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Aduan Gagal Disimpan!',
                ], 400);
            }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda Bukan Penduduk di Desa Ini',
                ], 400);
            }
            
            
        }

    }
}
