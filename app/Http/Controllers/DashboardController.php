<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataUsers;
use App\Models\StandardDemands;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard() {
        //pie chart, bar chart, & line chart
        $sestama = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id')->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('data_users.status','=',1)->count();

        $sestama_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $sestama_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $pengembangan = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id')->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('data_users.status','=',1)->count();

        $pengembangan_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $pengembangan_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $penerapan = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id')->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('data_users.status','=',1)->count();

        $penerapan_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $penerapan_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $akreditasi = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id')->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('data_users.status','=',1)->count();

        $akreditasi_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $akreditasi_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $snsu = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id')->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('data_users.status','=',1)->count();

        $snsu_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $snsu_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $klt = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id')->where('unit_kerja.eselon_satu','=','KLT')
        ->where('data_users.status','=',1)->count();

        $klt_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        $klt_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('standard_demands.nomor_standar')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->count();

        /* Pie Chart Statistik Layanan Permintaan */
        $terlayani = DataUsers::where('status',1)->count();
        $tidak_terlayani = DataUsers::where('status',2)->count();

        /* Pie Chart Statistik Layanan Dokumen */
        $tersedia = DB::table('standard_demands')
        ->join('data_users','data_users.id','=','standard_demands.id_user')
        ->distinct('standard_demands.nomor_standar')
        ->where('standard_demands.blokir','=',0)
        ->where('data_users.status','=',1)->count();
        $tidak_tersedia = StandardDemands::distinct('nomor_standar')->where('blokir',1)->count();

        /* Untuk Chart */
        $sni_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.nomor_standar')
        ->where('standard_demands.jenis_standar','=','SNI')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('standard_demands.nomor_standar')->get();

        $sni_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.nomor_standar')
        ->where('standard_demands.jenis_standar','=','SNI')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->get();

        $astm_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.nomor_standar')
        ->where('standard_demands.jenis_standar','=','ASTM')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('standard_demands.nomor_standar')->get();

        $astm_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.nomor_standar')
        ->where('standard_demands.jenis_standar','=','ASTM')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->get();

        $iec_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.nomor_standar')
        ->where('standard_demands.jenis_standar','=','IEC')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('standard_demands.nomor_standar')->get();

        $iec_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.nomor_standar')
        ->where('standard_demands.jenis_standar','=','IEC')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->get();

        $iso_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.nomor_standar')
        ->where('standard_demands.jenis_standar','=','ISO')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('standard_demands.nomor_standar')->get();

        $iso_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.nomor_standar')
        ->where('standard_demands.jenis_standar','=','ISO')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->get();

        $lainnya_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.nomor_standar')
        ->where('standard_demands.jenis_standar','=','lainnya')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('standard_demands.nomor_standar')->get();

        $lainnya_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.nomor_standar')
        ->where('standard_demands.jenis_standar','=','lainnya')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)->get();

        //tabel unit kerja - jenis standar
        $data_tabel_unit = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('unit_kerja.eselon_satu')
        ->selectRaw('count(case when standard_demands.jenis_standar = "SNI" then 1 end) as sni')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ASTM" then 1 end) as astm')
        ->selectRaw('count(case when standard_demands.jenis_standar = "IEC" then 1 end) as iec')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ISO" then 1 end) as iso')
        ->selectRaw('count(case when standard_demands.jenis_standar = "Lainnya" then 1 end) as lainnya')
        ->selectRaw('count(standard_demands.nomor_standar) as total')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('unit_kerja.eselon_satu')->get();

        //tabel petugas
        $data_tabel_petugas = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('data_users.petugas',
        DB::raw('count(DISTINCT(data_users.id)) as permintaan'),
        DB::raw('count(DISTINCT(standard_demands.nomor_standar)) as judul'),
        DB::raw('count(standard_demands.nomor_standar) as eksemplar'))
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('data_users.petugas')->get();

        /* Untuk tabel permintaan standar | unit kerja Eselon II */
        $data_unit_kerja = DB::table('data_users')
        ->join('standard_demands','standard_demands.id_user','=','data_users.id')
        ->select('data_users.unit_kerja', DB::raw('count(DISTINCT(data_users.id)) as permintaan'),
        DB::raw('count(standard_demands.nomor_standar) as judul'))
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('data_users.unit_kerja')->orderBy('permintaan','desc')
        ->get();
        /*************END***************/


        $data_tabel_tujuan = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.tujuan_penggunaan')
        ->selectRaw('count(case when standard_demands.jenis_standar = "SNI" then 1 end) as sni')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ASTM" then 1 end) as astm')
        ->selectRaw('count(case when standard_demands.jenis_standar = "IEC" then 1 end) as iec')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ISO" then 1 end) as iso')
        ->selectRaw('count(case when standard_demands.jenis_standar = "Lainnya" then 1 end) as lainnya')
        ->selectRaw('count(standard_demands.nomor_standar) as total')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('data_users.tujuan_penggunaan')->get();

        //notifikasi navbar
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        return view('admin.dashboard', compact('permintaan_all','terkirim','belum_terkirim','gagal_proses',
        'sestama','sestama_judul','sestama_eks','pengembangan','pengembangan_judul','pengembangan_eks',
        'penerapan','penerapan_judul','penerapan_eks','akreditasi','akreditasi_judul','akreditasi_eks',
        'snsu','snsu_judul','snsu_eks','klt','klt_judul','klt_eks','terlayani','tidak_terlayani',
        'tersedia','tidak_tersedia','data_tabel_unit','data_tabel_petugas','data_tabel_tujuan','sni_judul',
        'sni_eks','astm_judul','astm_eks','iec_judul','iec_eks','iso_judul','iso_eks','lainnya_judul',
        'lainnya_eks','data_unit_kerja'));
    }

    public function filterData(Request $request){
        $from_date = (new Carbon($request->get('from_date')));
        $to_date = (new Carbon($request->get('to_date')))->addDay(1);

        $dari_tanggal = $from_date->format('Y-m-d');
        $sampai_tanggal = $to_date->format('Y-m-d');

        //dd($from_date,$to_date,$dari_tanggal,$sampai_tanggal, array($dari_tanggal,$sampai_tanggal));

        /* Pie Chart Statistik Layanan Dokumen */
        $tersedia_filter = DB::table('standard_demands')
        ->join('data_users','data_users.id','=','standard_demands.id_user')
        ->distinct('standard_demands.nomor_standar')
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $tidak_tersedia_filter = DB::table('standard_demands')
        ->join('data_users','data_users.id','=','standard_demands.id_user')
        ->distinct('standard_demands.nomor_standar')
        ->where('standard_demands.blokir','=',1)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();


        /* Pie Chart Statistik Layanan Permintaan */
        $terlayani_filter = DB::table('standard_demands')
        ->join('data_users','data_users.id','=','standard_demands.id_user')
        ->distinct('data_users.id')
        ->where('standard_demands.blokir','=',0)
        ->where('data_users.status','=',1)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))->count();

        $tidak_terlayani_filter = DataUsers::where('status',2)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        
        //pie chart, bar chart, & line chart
        $sestama = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('data_users.status','=',1)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $sestama_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $sestama_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Sestama')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $pengembangan = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('data_users.status','=',1)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $pengembangan_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $pengembangan_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi Pengembangan')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $penerapan = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('data_users.status','=',1)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $penerapan_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $penerapan_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi Penerapan')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $akreditasi = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('data_users.status','=',1)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $akreditasi_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $akreditasi_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi Akreditasi')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $snsu = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('data_users.status','=',1)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $snsu_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $snsu_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','Deputi SNSU')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $klt = DB::table('data_users')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('data_users.status','=',1)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $klt_judul = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->distinct('standard_demands.nomor_standar')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        $klt_eks = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.id','data_users.created_at')
        ->where('unit_kerja.eselon_satu','=','KLT')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->count();

        /* Untuk Chart */
        $sni_judul = DB::table('standard_demands')
                ->join('data_users','standard_demands.id_user','=','data_users.id')
                ->select('data_users.id','data_users.created_at')
                ->where('standard_demands.jenis_standar','=','SNI')
                ->where('standard_demands.blokir','=',0)
                ->where('data_users.status','=',1)
                ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
                ->groupBy('standard_demands.nomor_standar')->get();
        $sni_eks = DB::table('standard_demands')
                ->join('data_users','standard_demands.id_user','=','data_users.id')
                ->select('data_users.id','data_users.created_at')
                ->where('standard_demands.jenis_standar','=','SNI')
                ->where('standard_demands.blokir','=',0)
                ->where('data_users.status','=',1)
                ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
                ->get();
        $astm_judul = DB::table('standard_demands')
                ->join('data_users','standard_demands.id_user','=','data_users.id')
                ->select('data_users.id','data_users.created_at')
                ->where('standard_demands.jenis_standar','=','ASTM')
                ->where('standard_demands.blokir','=',0)
                ->where('data_users.status','=',1)
                ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
                ->groupBy('standard_demands.nomor_standar')->get();
        $astm_eks = DB::table('standard_demands')
                ->join('data_users','standard_demands.id_user','=','data_users.id')
                ->select('data_users.id','data_users.created_at')
                ->where('standard_demands.jenis_standar','=','ASTM')
                ->where('standard_demands.blokir','=',0)
                ->where('data_users.status','=',1)
                ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
                ->get();
        $iec_judul = DB::table('standard_demands')
                ->join('data_users','standard_demands.id_user','=','data_users.id')
                ->select('data_users.id','data_users.created_at')
                ->where('standard_demands.jenis_standar','=','IEC')
                ->where('standard_demands.blokir','=',0)
                ->where('data_users.status','=',1)
                ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
                ->groupBy('standard_demands.nomor_standar')->get();
        $iec_eks = DB::table('standard_demands')
                ->join('data_users','standard_demands.id_user','=','data_users.id')
                ->select('data_users.id','data_users.created_at')
                ->where('standard_demands.jenis_standar','=','IEC')
                ->where('standard_demands.blokir','=',0)
                ->where('data_users.status','=',1)
                ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
                ->get();
        $iso_judul = DB::table('standard_demands')
                ->join('data_users','standard_demands.id_user','=','data_users.id')
                ->select('data_users.id','data_users.created_at')
                ->where('standard_demands.jenis_standar','=','ISO')
                ->where('standard_demands.blokir','=',0)
                ->where('data_users.status','=',1)
                ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
                ->groupBy('standard_demands.nomor_standar')->get();
        $iso_eks = DB::table('standard_demands')
                ->join('data_users','standard_demands.id_user','=','data_users.id')
                ->select('data_users.id','data_users.created_at')
                ->where('standard_demands.jenis_standar','=','ISO')
                ->where('standard_demands.blokir','=',0)
                ->where('data_users.status','=',1)
                ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
                ->get();
        $lainnya_judul = DB::table('standard_demands')
                ->join('data_users','standard_demands.id_user','=','data_users.id')
                ->select('data_users.id','data_users.created_at')
                ->where('standard_demands.jenis_standar','=','Lainnya')
                ->where('standard_demands.blokir','=',0)
                ->where('data_users.status','=',1)
                ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
                ->groupBy('standard_demands.nomor_standar')->get();
        $lainnya_eks = DB::table('standard_demands')
                ->join('data_users','standard_demands.id_user','=','data_users.id')
                ->select('data_users.id','data_users.created_at')
                ->where('standard_demands.jenis_standar','=','Lainnya')
                ->where('standard_demands.blokir','=',0)
                ->where('data_users.status','=',1)
                ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
                ->get();

        //tabel unit kerja - jenis standar
        $data_tabel_unit = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('unit_kerja.eselon_satu','data_users.id','data_users.created_at')
        ->selectRaw('count(case when standard_demands.jenis_standar = "SNI" then 1 end) as sni')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ASTM" then 1 end) as astm')
        ->selectRaw('count(case when standard_demands.jenis_standar = "IEC" then 1 end) as iec')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ISO" then 1 end) as iso')
        ->selectRaw('count(case when standard_demands.jenis_standar = "Lainnya" then 1 end) as lainnya')
        ->selectRaw('count(standard_demands.nomor_standar) as total')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->groupBy('unit_kerja.eselon_satu')->get();

        //tabel petugas
        $data_tabel_petugas_filter = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('data_users.petugas',
        DB::raw('count(DISTINCT(data_users.id)) as permintaan'),
        DB::raw('count(DISTINCT(standard_demands.nomor_standar)) as judul'),
        DB::raw('count(standard_demands.nomor_standar) as eksemplar'))
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->groupBy('data_users.petugas')->get();

        /* Untuk tabel permintaan standar | unit kerja Eselon II */
        $data_unit_kerja = DB::table('data_users')
        ->join('standard_demands','standard_demands.id_user','=','data_users.id')
        ->select('data_users.unit_kerja','data_users.id','data_users.created_at',
        DB::raw('count(DISTINCT(data_users.id)) as permintaan'),
        DB::raw('count(standard_demands.nomor_standar) as judul'))
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->groupBy('data_users.unit_kerja')
        ->orderBy('permintaan','desc')->get();
        /*************END***************/


        $data_tabel_tujuan = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->join('unit_kerja','data_users.unit_kerja','=','unit_kerja.unit')
        ->select('data_users.tujuan_penggunaan','data_users.id','data_users.created_at')
        ->selectRaw('count(case when standard_demands.jenis_standar = "SNI" then 1 end) as sni')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ASTM" then 1 end) as astm')
        ->selectRaw('count(case when standard_demands.jenis_standar = "IEC" then 1 end) as iec')
        ->selectRaw('count(case when standard_demands.jenis_standar = "ISO" then 1 end) as iso')
        ->selectRaw('count(case when standard_demands.jenis_standar = "Lainnya" then 1 end) as lainnya')
        ->selectRaw('count(standard_demands.nomor_standar) as total')
        ->whereBetween('data_users.created_at',array($dari_tanggal,$sampai_tanggal))
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('data_users.tujuan_penggunaan')->get();

        //notifikasi navbar
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        $permintaan_all_filter = DataUsers::whereBetween('created_at',array($dari_tanggal,$sampai_tanggal))->count();
        $terkirim_filter = DataUsers::where('status','=',1)
        ->whereBetween('created_at',array($dari_tanggal,$sampai_tanggal))->count();
        $belum_terkirim_filter = DataUsers::where('status','=',0)
        ->whereBetween('created_at',array($dari_tanggal,$sampai_tanggal))->count();
        $gagal_proses_filter = DataUsers::where('status','=',2)
        ->whereBetween('created_at',array($dari_tanggal,$sampai_tanggal))->count();

        return view('admin.filter-data', compact('from_date','to_date','permintaan_all','terkirim',
            'belum_terkirim','gagal_proses','permintaan_all_filter','terkirim_filter','belum_terkirim_filter',
            'gagal_proses_filter','tersedia_filter','tidak_tersedia_filter','terlayani_filter','tidak_terlayani_filter',
            'sestama','sestama_judul','sestama_eks','pengembangan','pengembangan_judul','pengembangan_eks',
            'penerapan','penerapan_judul','penerapan_eks','akreditasi','akreditasi_judul','akreditasi_eks',
            'snsu','snsu_judul','snsu_eks','klt','klt_judul','klt_eks','data_tabel_unit','data_tabel_tujuan',
            'sni_judul','sni_eks','astm_judul','astm_eks','iec_judul','iec_eks','iso_judul','iso_eks',
            'lainnya_judul','lainnya_eks','data_unit_kerja','data_tabel_petugas_filter'));
    }

}
