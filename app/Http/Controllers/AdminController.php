<?php

namespace App\Http\Controllers;
use App\Models\DataUsers;
use App\Models\DataPegawai;
use App\Models\JenisStandar;
use App\Models\StandardDemands;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tabelPermintaan(Request $request){
        //notifikasi navbar
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        //tabel-permintaan
        if($request->ajax())
        {
            $data_permintaan = DB::table('data_users')
            ->select('data_users.id','data_users.nama','unit_kerja.singkatan','data_users.created_at', 'data_users.petugas',
            DB::raw('count(standard_demands.nomor_standar) as permintaan'),
            DB::raw('sum(standard_demands.blokir) as blokir'),
            'data_users.updated_at',
            'data_users.status')->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja', 'data_users.unit_kerja','=','unit_kerja.unit')
            ->orderBy('data_users.created_at','desc')
            ->groupBy('data_users.created_at')->get();

            return DataTables::of($data_permintaan)
            ->addColumn('aksi', function($data){
                $button = '<a href="permintaan/cetak/'.$data->id.'" title="cetak" class="btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i></a>
                <a href="permintaan/lihat/'.$data->id.'" title="lihat" class="btn-sm btn-eye"><i class="fa fa-eye"></i></a>';
                $button .= '&nbsp;&nbsp;';
                if($data->blokir == $data->permintaan)
                {
                    $button .= '<a href="#" title="proses" class="btn-default btn-sm disabled"><i class="fa fa-ban"></i></a>';
                }
                elseif($data->status == 0)
                {
                    $button .= '<button type="button" id="'.$data->id.'" title="proses" class="proses btn btn-warning btn-sm" style="line-height: 5px; important: !important;"><i class="fa fa-bolt"></i></button>';
                }
                else
                {
                    $button .= '<a href="#" title="proses" class="btn-default btn-sm disabled"><i class="fa fa-ban"></i></a>';
                }
                return $button;
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('admin.tabel-permintaan', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses',
        ));
    }

    public function lihatFormulir(Request $request, $id){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        $data_signed = DataUsers::where('id','=',$id)->first();

        if($request->ajax()) {
            // $permintaan = DataUsers::findOrFail($id);
            $permintaan = DB::table('data_users')
            ->join('standard_demands', 'data_users.id', '=', 'standard_demands.id_user')
            ->select('standard_demands.id','standard_demands.id_user','data_users.status',
            'standard_demands.nomor_standar','standard_demands.jenis_standar',
            'standard_demands.format','standard_demands.blokir','data_users.status')
            ->where('data_users.id','=',$id)->get();
            // $standar_list = StandardDemands::select('id','id_user','nomor_standar','jenis_standar','format','blokir')->where('id_user','=',$id)->get();
        
            return DataTables::of($permintaan)
            ->addColumn('aksi', function($data){
                if($data->blokir == 0 && $data->status != 1) {
                    $button = '<button type="button" id="'.$data->id.'" title="klik apabila dokumen tidak tersedia" class="blokir btn btn-sm btn-danger"><i class="fa fa-ban"></i></a>';
                }
                elseif($data->blokir == 0 && $data->status == 1) {
                    $button = '<a href="#" class="btn-default btn-sm disabled"><i class="fa fa-ban"></i> Dokumen Terkirim</a>';
                }
                else {
                    $button = '<a href="#" class="btn-default btn-sm disabled"><i class="fa fa-ban"></i> Dokumen Tidak Tersedia</a>';
                }
                return $button;
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('admin.formulir-permintaan', compact(
            'data_signed','permintaan_all','terkirim','belum_terkirim','gagal_proses'
        ));
    }

    /* Generate PDF Start */
    public function printPDF($id){
        $standar_list = StandardDemands::select('nomor_standar','jenis_standar')->where('id_user','=',$id)->get();
        // dd($standar_list);
        $permintaan = DataUsers::findOrFail($id);
        $pdf = PDF::loadView('admin.cetakPDF', compact('permintaan','standar_list'));
        return $pdf->download(now()->format('YmdHis').'formulir.pdf');
    }
    /* Generate PDF End */

    public function prosesPermintaan($id){
        $data = DataUsers::findOrFail($id);
        $status_sekarang = $data->status;
        if($status_sekarang == 0){
            $proses = DataUsers::where('id',$id)->update([
                'status' => 1,
                'petugas' => Auth::user()->name
            ]);
        }
        return response()->json($proses);
    }

    public function blokirDokumen($id_user, $id){
        $data = StandardDemands::findOrFail($id);

        $blokir_sekarang = $data->blokir;

        if($blokir_sekarang == 0){
            $status_blokir = StandardDemands::where('id',$id)->where('id_user',$id_user)->update([
                'blokir' => 1
            ]);
        };

        $total_blokir = DB::table('standard_demands')
        ->select(DB::raw('count(CASE WHEN blokir = "1" THEN 1 END) as total_blokir'))
        ->where('id_user',$id_user)->get();
        $total_standar = StandardDemands::select('nomor_standar')->where('id_user',$id_user)->count();
        foreach($total_blokir as $tb) {
            $single_blokir = $tb->total_blokir;

            if($single_blokir == $total_standar) {
                DataUsers::where('id',$id_user)->update([
                    'status' => 2,
                    'petugas' => Auth::user()->name
                ]);
            }
        }

        return response()->json($status_blokir);
    }

    public function sniView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        if($request->ajax()) {
            $sni_dt = DB::table('data_users')
            ->select('standard_demands.nomor_standar')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
            ->selectRaw('count(standard_demands.nomor_standar) as total')
            ->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
            ->where('standard_demands.jenis_standar','=','SNI')
            ->where('data_users.status','=',1)
            ->groupBy('standard_demands.nomor_standar')
            ->orderBy('standard_demands.nomor_standar')->get();

            return DataTables::of($sni_dt)->addIndexColumn()->make(true);
        }

        $sni = DB::table('data_users')
        ->select('standard_demands.nomor_standar')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('standard_demands.jenis_standar','=','SNI')
        ->where('data_users.status','=',1)
        ->groupBy('standard_demands.nomor_standar')
        ->orderBy('standard_demands.nomor_standar')->get();

        $sestama_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('standard_demands.jenis_standar','=','SNI')
        ->where('data_users.status','=',1)
        ->count();

        $pengembangan_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('standard_demands.jenis_standar','=','SNI')
        ->where('data_users.status','=',1)
        ->count();

        $penerapan_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('standard_demands.jenis_standar','=','SNI')
        ->where('data_users.status','=',1)
        ->count();

        $akreditasi_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('standard_demands.jenis_standar','=','SNI')
        ->where('data_users.status','=',1)
        ->count();

        $snsu_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('standard_demands.jenis_standar','=','SNI')
        ->where('data_users.status','=',1)
        ->count();

        $klt_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('standard_demands.jenis_standar','=','SNI')
        ->where('data_users.status','=',1)
        ->count();

        $unit_kerja = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.unit_kerja','unit_kerja.eselon_satu')
        ->selectRaw('count(distinct(standard_demands.nomor_standar)) as judul')
        ->selectRaw('count(standard_demands.nomor_standar) as eksemplar')
        ->where('standard_demands.jenis_standar','=','SNI')
        ->where('data_users.status','=',1)
        ->groupBy('data_users.unit_kerja')
        ->get();

        // dd($unit_kerja);

        return view('admin.standar.sni', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','sestama_judul','pengembangan_judul',
            'sni','penerapan_judul','akreditasi_judul','snsu_judul','klt_judul', 'unit_kerja'
        ));
    }

    public function astmView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        if($request->ajax()) {
            $astm_dt = DB::table('data_users')
            ->select('standard_demands.nomor_standar')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
            ->selectRaw('count(standard_demands.nomor_standar) as total')
            ->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
            ->where('standard_demands.jenis_standar','=','ASTM')
            ->where('data_users.status','=',1)
            ->groupBy('standard_demands.nomor_standar')
            ->orderBy('standard_demands.nomor_standar')->get();

            return DataTables::of($astm_dt)->addIndexColumn()->make(true);
        }
        $astm = DB::table('data_users')
        ->select('standard_demands.nomor_standar')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('standard_demands.jenis_standar','=','ASTM')
        ->where('data_users.status','=',1)
        ->groupBy('standard_demands.nomor_standar')
        ->orderBy('standard_demands.nomor_standar')->get();

        $sestama_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('standard_demands.jenis_standar','=','ASTM')
        ->where('data_users.status','=',1)
        ->count();

        $pengembangan_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('standard_demands.jenis_standar','=','ASTM')
        ->where('data_users.status','=',1)
        ->count();

        $penerapan_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('standard_demands.jenis_standar','=','ASTM')
        ->where('data_users.status','=',1)
        ->count();

        $akreditasi_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('standard_demands.jenis_standar','=','ASTM')
        ->where('data_users.status','=',1)
        ->count();

        $snsu_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('standard_demands.jenis_standar','=','ASTM')
        ->where('data_users.status','=',1)
        ->count();

        $klt_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('standard_demands.jenis_standar','=','ASTM')
        ->where('data_users.status','=',1)
        ->count();

        $unit_kerja = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.unit_kerja','unit_kerja.eselon_satu')
        ->selectRaw('count(distinct(standard_demands.nomor_standar)) as judul')
        ->selectRaw('count(standard_demands.nomor_standar) as eksemplar')
        ->where('standard_demands.jenis_standar','=','ASTM')
        ->where('data_users.status','=',1)
        ->groupBy('data_users.unit_kerja')
        ->get();

        return view('admin.standar.astm', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','astm',
            'sestama_judul','pengembangan_judul','penerapan_judul',
            'akreditasi_judul','snsu_judul','klt_judul', 'unit_kerja'
        ));
    }

    public function iecView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        if($request->ajax()) {
            $iec_dt = DB::table('data_users')
            ->select('standard_demands.nomor_standar')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
            ->selectRaw('count(standard_demands.nomor_standar) as total')
            ->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
            ->where('standard_demands.jenis_standar','=','IEC')
            ->where('data_users.status','=',1)
            ->groupBy('standard_demands.nomor_standar')
            ->orderBy('standard_demands.nomor_standar')->get();

            return DataTables::of($iec_dt)->addIndexColumn()->make(true);
        }
        $iec = DB::table('data_users')
        ->select('standard_demands.nomor_standar')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('standard_demands.jenis_standar','=','IEC')
        ->where('data_users.status','=',1)
        ->groupBy('standard_demands.nomor_standar')
        ->orderBy('standard_demands.nomor_standar')->get();

        $sestama_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('standard_demands.jenis_standar','=','IEC')
        ->where('data_users.status','=',1)
        ->count();

        $pengembangan_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('standard_demands.jenis_standar','=','IEC')
        ->where('data_users.status','=',1)
        ->count();

        $penerapan_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('standard_demands.jenis_standar','=','IEC')
        ->where('data_users.status','=',1)
        ->count();

        $akreditasi_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('standard_demands.jenis_standar','=','IEC')
        ->where('data_users.status','=',1)
        ->count();

        $snsu_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('standard_demands.jenis_standar','=','IEC')
        ->where('data_users.status','=',1)
        ->count();

        $klt_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('standard_demands.jenis_standar','=','IEC')
        ->where('data_users.status','=',1)
        ->count();

        $unit_kerja = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.unit_kerja','unit_kerja.eselon_satu')
        ->selectRaw('count(distinct(standard_demands.nomor_standar)) as judul')
        ->selectRaw('count(standard_demands.nomor_standar) as eksemplar')
        ->where('standard_demands.jenis_standar','=','IEC')
        ->where('data_users.status','=',1)
        ->groupBy('data_users.unit_kerja')
        ->get();

        return view('admin.standar.iec', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','iec','sestama_judul','pengembangan_judul',
            'penerapan_judul','akreditasi_judul','snsu_judul','klt_judul','unit_kerja'
        ));
    }

    public function isoView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        if($request->ajax()) {
            $iso_dt = DB::table('data_users')
            ->select('standard_demands.nomor_standar')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
            ->selectRaw('count(standard_demands.nomor_standar) as total')
            ->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
            ->where('standard_demands.jenis_standar','=','ISO')
            ->where('data_users.status','=',1)
            ->groupBy('standard_demands.nomor_standar')
            ->orderBy('standard_demands.nomor_standar')->get();

            return DataTables::of($iso_dt)->addIndexColumn()->make(true);
        }

        $iso = DB::table('data_users')
        ->select('standard_demands.nomor_standar')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('standard_demands.jenis_standar','=','ISO')
        ->where('data_users.status','=',1)
        ->groupBy('standard_demands.nomor_standar')
        ->orderBy('standard_demands.nomor_standar')->get();

        $sestama_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('standard_demands.jenis_standar','=','ISO')
        ->where('data_users.status','=',1)
        ->count();

        $pengembangan_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('standard_demands.jenis_standar','=','ISO')
        ->where('data_users.status','=',1)
        ->count();

        $penerapan_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('standard_demands.jenis_standar','=','ISO')
        ->where('data_users.status','=',1)
        ->count();

        $akreditasi_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('standard_demands.jenis_standar','=','ISO')
        ->where('data_users.status','=',1)
        ->count();

        $snsu_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('standard_demands.jenis_standar','=','ISO')
        ->where('data_users.status','=',1)
        ->count();

        $klt_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('standard_demands.jenis_standar','=','ISO')
        ->where('data_users.status','=',1)
        ->count();

        $unit_kerja = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.unit_kerja','unit_kerja.eselon_satu')
        ->selectRaw('count(distinct(standard_demands.nomor_standar)) as judul')
        ->selectRaw('count(standard_demands.nomor_standar) as eksemplar')
        ->where('standard_demands.jenis_standar','=','ISO')
        ->where('data_users.status','=',1)
        ->groupBy('data_users.unit_kerja')
        ->get();

        return view('admin.standar.iso', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','iso','sestama_judul','pengembangan_judul',
            'penerapan_judul','akreditasi_judul','snsu_judul','klt_judul','unit_kerja'
        ));
    }

    public function lainnyaView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        if($request->ajax()) {
            $lainnya_dt = DB::table('data_users')
            ->select('standard_demands.nomor_standar')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
            ->selectRaw('count(standard_demands.nomor_standar) as total')
            ->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
            ->where('standard_demands.jenis_standar','=','Lainnya')
            ->where('data_users.status','=',1)
            ->groupBy('standard_demands.nomor_standar')
            ->orderBy('standard_demands.nomor_standar')->get();

            return DataTables::of($lainnya_dt)->addIndexColumn()->make(true);
        }

        $lainnya = DB::table('data_users')
        ->select('standard_demands.nomor_standar')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
        ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('standard_demands.jenis_standar','=','Lainnya')
        ->where('data_users.status','=',1)
        ->groupBy('standard_demands.nomor_standar')
        ->orderBy('standard_demands.nomor_standar')->get();

        $sestama_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('standard_demands.jenis_standar','=','Lainnya')
        ->where('data_users.status','=',1)
        ->count();

        $pengembangan_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('standard_demands.jenis_standar','=','Lainnya')
        ->where('data_users.status','=',1)
        ->count();

        $penerapan_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('standard_demands.jenis_standar','=','Lainnya')
        ->where('data_users.status','=',1)
        ->count();

        $akreditasi_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('standard_demands.jenis_standar','=','Lainnya')
        ->where('data_users.status','=',1)
        ->count();

        $snsu_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('standard_demands.jenis_standar','=','Lainnya')
        ->where('data_users.status','=',1)
        ->count();

        $klt_judul = DB::table('data_users')
        ->distinct('standard_demands.nomor_standar')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('standard_demands.jenis_standar','=','Lainnya')
        ->where('data_users.status','=',1)
        ->count();

        $unit_kerja = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.unit_kerja','unit_kerja.eselon_satu')
        ->selectRaw('count(distinct(standard_demands.nomor_standar)) as judul')
        ->selectRaw('count(standard_demands.nomor_standar) as eksemplar')
        ->where('standard_demands.jenis_standar','=','Lainnya')
        ->where('data_users.status','=',1)
        ->groupBy('data_users.unit_kerja')
        ->get();

        return view('admin.standar.lainnya', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','lainnya','sestama_judul','pengembangan_judul',
            'penerapan_judul','akreditasi_judul','snsu_judul','klt_judul','unit_kerja'
        ));
    }

    public function sestamaView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        $sestama = DB::table('data_users')
        ->select('unit_kerja.unit')
        ->selectRaw('count(case when standard_demands.jenis_standar = "SNI" then 1 end) as sni')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ASTM" then 1 end) as astm')
        ->selectRaw('count(case when standard_demands.jenis_standar = "IEC" then 1 end) as iec')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ISO" then 1 end) as iso')
        ->selectRaw('count(case when standard_demands.jenis_standar = "Lainnya" then 1 end) as lainnya')
        ->selectRaw('count(unit_kerja.unit) as total')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('data_users.status','=',1)
        ->groupBy('unit_kerja.unit')
        ->orderBy('unit_kerja.id')->get();

        if($request->ajax()) {
            $data_permintaan = DB::table('data_users')
            ->select('data_users.id','data_users.nama','unit_kerja.singkatan','data_users.created_at',
            DB::raw('count(standard_demands.nomor_standar) as permintaan'),'data_users.updated_at',
            'data_users.status')->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja', 'data_users.unit_kerja','=','unit_kerja.unit')
            ->where('unit_kerja.eselon_satu','=','Sestama')
            ->where('data_users.status','=',1)
            ->groupBy('data_users.created_at')->get();

            return DataTables::of($data_permintaan)->addIndexColumn()->make(true);
        }

        return view('admin.unit-kerja.sestama', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','sestama',
        ));
    }

    public function pengembanganView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        $pengembangan = DB::table('data_users')
        ->select('unit_kerja.unit')
        ->selectRaw('count(case when standard_demands.jenis_standar = "SNI" then 1 end) as sni')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ASTM" then 1 end) as astm')
        ->selectRaw('count(case when standard_demands.jenis_standar = "IEC" then 1 end) as iec')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ISO" then 1 end) as iso')
        ->selectRaw('count(case when standard_demands.jenis_standar = "Lainnya" then 1 end) as lainnya')
        ->selectRaw('count(unit_kerja.unit) as total')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('data_users.status','=',1)
        ->groupBy('unit_kerja.unit')
        ->orderBy('unit_kerja.id')->get();

        if($request->ajax()) {
            $data_permintaan = DB::table('data_users')
            ->select('data_users.id','data_users.nama','unit_kerja.singkatan','data_users.created_at',
            DB::raw('count(standard_demands.nomor_standar) as permintaan'),'data_users.updated_at',
            'data_users.status')->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja', 'data_users.unit_kerja','=','unit_kerja.unit')
            ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
            ->where('data_users.status','=',1)
            ->groupBy('data_users.created_at')->get();

            return DataTables::of($data_permintaan)->addIndexColumn()->make(true);
        }

        return view('admin.unit-kerja.pengembangan', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','pengembangan',
        ));
    }

    public function penerapanView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        $penerapan = DB::table('data_users')
        ->select('unit_kerja.unit')
        ->selectRaw('count(case when standard_demands.jenis_standar = "SNI" then 1 end) as sni')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ASTM" then 1 end) as astm')
        ->selectRaw('count(case when standard_demands.jenis_standar = "IEC" then 1 end) as iec')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ISO" then 1 end) as iso')
        ->selectRaw('count(case when standard_demands.jenis_standar = "Lainnya" then 1 end) as lainnya')
        ->selectRaw('count(unit_kerja.unit) as total')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('data_users.status','=',1)
        ->groupBy('unit_kerja.unit')
        ->orderBy('unit_kerja.id')->get();

        if($request->ajax()) {
            $data_permintaan = DB::table('data_users')
            ->select('data_users.id','data_users.nama','unit_kerja.singkatan','data_users.created_at',
            DB::raw('count(standard_demands.nomor_standar) as permintaan'),'data_users.updated_at',
            'data_users.status')->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja', 'data_users.unit_kerja','=','unit_kerja.unit')
            ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
            ->where('data_users.status','=',1)
            ->groupBy('data_users.created_at')->get();

            return DataTables::of($data_permintaan)->addIndexColumn()->make(true);
        }

        return view('admin.unit-kerja.penerapan', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','penerapan',
        ));
    }

    public function akreditasiView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        $akreditasi = DB::table('data_users')
        ->select('unit_kerja.unit')
        ->selectRaw('count(case when standard_demands.jenis_standar = "SNI" then 1 end) as sni')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ASTM" then 1 end) as astm')
        ->selectRaw('count(case when standard_demands.jenis_standar = "IEC" then 1 end) as iec')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ISO" then 1 end) as iso')
        ->selectRaw('count(case when standard_demands.jenis_standar = "Lainnya" then 1 end) as lainnya')
        ->selectRaw('count(unit_kerja.unit) as total')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('data_users.status','=',1)
        ->groupBy('unit_kerja.unit')
        ->orderBy('unit_kerja.id')->get();

        if($request->ajax()) {
            $data_permintaan = DB::table('data_users')
            ->select('data_users.id','data_users.nama','unit_kerja.singkatan','data_users.created_at',
            DB::raw('count(standard_demands.nomor_standar) as permintaan'),'data_users.updated_at',
            'data_users.status')->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja', 'data_users.unit_kerja','=','unit_kerja.unit')
            ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
            ->where('data_users.status','=',1)
            ->groupBy('data_users.created_at')->get();

            return DataTables::of($data_permintaan)->addIndexColumn()->make(true);   
        }

        return view('admin.unit-kerja.akreditasi', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','akreditasi',
        ));
    }

    public function snsuView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        $snsu = DB::table('data_users')
        ->select('unit_kerja.unit')
        ->selectRaw('count(case when standard_demands.jenis_standar = "SNI" then 1 end) as sni')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ASTM" then 1 end) as astm')
        ->selectRaw('count(case when standard_demands.jenis_standar = "IEC" then 1 end) as iec')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ISO" then 1 end) as iso')
        ->selectRaw('count(case when standard_demands.jenis_standar = "Lainnya" then 1 end) as lainnya')
        ->selectRaw('count(unit_kerja.unit) as total')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('data_users.status','=',1)
        ->groupBy('unit_kerja.unit')
        ->orderBy('unit_kerja.id')->get();

        if($request->ajax()) {
            $data_permintaan = DB::table('data_users')
            ->select('data_users.id','data_users.nama','unit_kerja.singkatan','data_users.created_at',
            DB::raw('count(standard_demands.nomor_standar) as permintaan'),'data_users.updated_at',
            'data_users.status')->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja', 'data_users.unit_kerja','=','unit_kerja.unit')
            ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
            ->where('data_users.status','=',1)
            ->groupBy('data_users.created_at')->get();

            return DataTables::of($data_permintaan)->addIndexColumn()->make(true); 
        }

        return view('admin.unit-kerja.snsu', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','snsu',
        ));
    }

    public function kltView(Request $request){
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        $klt = DB::table('data_users')
        ->select('unit_kerja.unit')
        ->selectRaw('count(case when standard_demands.jenis_standar = "SNI" then 1 end) as sni')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ASTM" then 1 end) as astm')
        ->selectRaw('count(case when standard_demands.jenis_standar = "IEC" then 1 end) as iec')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ISO" then 1 end) as iso')
        ->selectRaw('count(case when standard_demands.jenis_standar = "Lainnya" then 1 end) as lainnya')
        ->selectRaw('count(unit_kerja.unit) as total')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('data_users.status','=',1)
        ->groupBy('unit_kerja.unit')
        ->orderBy('unit_kerja.id')->get();

        if($request->ajax()) {
            $data_permintaan = DB::table('data_users')
            ->select('data_users.id','data_users.nama','unit_kerja.singkatan','data_users.created_at',
            DB::raw('count(standard_demands.nomor_standar) as permintaan'),'data_users.updated_at',
            'data_users.status')->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja', 'data_users.unit_kerja','=','unit_kerja.unit')
            ->where('unit_kerja.eselon_satu','=','KLT')
            ->where('data_users.status','=',1)
            ->groupBy('data_users.created_at')->get();

            return DataTables::of($data_permintaan)->addIndexColumn()->make(true);
        }

        return view('admin.unit-kerja.klt', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses','klt'
        ));
    }

    public function dataPegawaiView(Request $request)
    {
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        if($request->ajax()) {
            $data_pegawai = DataPegawai::orderBy('nama_pegawai','asc')->get();

            return DataTables::of($data_pegawai)
            ->addColumn('aksi', function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="tombol-edit btn btn-info btn-sm" title="edit"><i class="fa fa-pencil"></i></button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="hapus" id="'.$data->id.'" class="tombol-hapus btn btn-danger btn-sm" title="hapus"><i class="fa fa-trash"></i></button>';

                return $button;
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('admin.data-master.data-pegawai', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses',
        ));
    }

    public function tambahPegawai(Request $request)
    {
        $pegawai = new DataPegawai;
        $pegawai->nama_pegawai = $request->input('nama_pegawai');
        $pegawai->nip_pegawai = $request->input('nip_pegawai');
        $pegawai->jabatan_pegawai = $request->input('jabatan_pegawai');
        $pegawai->save();
    }

    public function editPegawai($id)
    {
        $pegawai = DataPegawai::find($id);

        return response()->json([
            'pegawai' => $pegawai,
        ]);
    }

    public function updatePegawai(Request $request, $id)
    {
        $pegawai = DataPegawai::find($id);
        $pegawai->nama_pegawai = $request->input('nama_pegawaiEdit');
        $pegawai->nip_pegawai = $request->input('nip_pegawaiEdit');
        $pegawai->jabatan_pegawai = $request->input('jabatan_pegawaiEdit');
        $pegawai->update();

        return response()->json($pegawai);
    }

    public function deletePegawai($id)
    {
        $pegawai = DataPegawai::find($id);
        $pegawai->delete();

        return response()->json([]);
    }

    public function tujuanPenggunaanView()
    {
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        return view('admin.data-master.tujuan-penggunaan', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses'
        ));
    }

    public function dokumenTidakTersedia(Request $request)
    {
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        if($request->ajax()) {
            $dokumen_tidak_tersedia = DB::table('data_users')
            ->select('standard_demands.nomor_standar','standard_demands.jenis_standar')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Sestama" then 1 end) as sestama')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Pengembangan" then 1 end) as pengembangan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Penerapan" then 1 end) as penerapan')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi Akreditasi" then 1 end) as akreditasi')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "Deputi SNSU" then 1 end) as snsu')
            ->selectRaw('count(case when unit_kerja.eselon_satu = "KLT" then 1 end) as klt')
            ->selectRaw('count(standard_demands.nomor_standar) as total')
            ->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
            ->where('standard_demands.blokir','=',1)
            ->groupBy('standard_demands.nomor_standar')
            ->orderBy('standard_demands.nomor_standar')->get();

            return DataTables::of($dokumen_tidak_tersedia)->addIndexColumn()->make(true);
        }

        /* Untuk Chart */
        $sni_judul = DB::table('standard_demands')->distinct('nomor_standar')
        ->where('jenis_standar','=','SNI')->where('blokir','=',1)
        ->count();
        $sni_eks = DB::table('standard_demands')->select('nomor_standar')
        ->where('jenis_standar','=','SNI')->where('blokir','=',1)
        ->count();
        $astm_judul = DB::table('standard_demands')->distinct('nomor_standar')
        ->where('jenis_standar','=','ASTM')->where('blokir','=',1)
        ->count();
        $astm_eks = DB::table('standard_demands')->select('nomor_standar')
        ->where('jenis_standar','=','ASTM')->where('blokir','=',1)
        ->count();
        $iec_judul = DB::table('standard_demands')->distinct('nomor_standar')
        ->where('jenis_standar','=','IEC')->where('blokir','=',1)
        ->count();
        $iec_eks = DB::table('standard_demands')->select('nomor_standar')
        ->where('jenis_standar','=','IEC')->where('blokir','=',1)
        ->count();
        $iso_judul = DB::table('standard_demands')->distinct('nomor_standar')
        ->where('jenis_standar','=','ISO')->where('blokir','=',1)
        ->count();
        $iso_eks = DB::table('standard_demands')->select('nomor_standar')
        ->where('jenis_standar','=','ISO')->where('blokir','=',1)
        ->count();
        $lainnya_judul = DB::table('standard_demands')->distinct('nomor_standar')
        ->where('jenis_standar','=','Lainnya')->where('blokir','=',1)
        ->count();
        $lainnya_eks = DB::table('standard_demands')->select('nomor_standar')
        ->where('jenis_standar','=','Lainnya')->where('blokir','=',1)
        ->count();

        return view('admin.dokumen-tidak-tersedia', compact(
            'permintaan_all','terkirim','belum_terkirim','gagal_proses',
            'sni_judul','sni_eks','astm_judul','astm_eks',
            'iec_judul','iec_eks','iso_judul','iso_eks','lainnya_judul','lainnya_eks',
        ));
    }
}
