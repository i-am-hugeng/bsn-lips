<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JenisStandar;
use Illuminate\Http\Request;
use App\Models\DataUsers;
use App\Models\DataPegawai;
use App\Models\UnitKerja;
use App\Models\StandardDemands;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class FormController extends Controller
{
    public function index()
    {
        $jenis_standar_list = JenisStandar::orderBy('id')->get();
        return view('frontend.user-form', compact('jenis_standar_list'));

    }

    public function store(Request $request)
    {
        /* Menyimpan data permintaan ke database */
        $data = $request->all();
        //dd($data);

        $dataUser = new DataUsers();
        $dataUser->nama = $data['nama'];
        $dataUser->nip = $data['nip'];
        $dataUser->email = $data['email'];
        $dataUser->pejabat = $data['pejabat'];
        $dataUser->jabatan = $data['jabatan'];
        $dataUser->unit_kerja = $data['unit_kerja'];
        $dataUser->tujuan_penggunaan = $data['tujuan_penggunaan'];
        $dataUser->status = $data['status'];
        $dataUser->watermark = $data['watermark'];
        /* Upload ttd */
        // $folderPath = public_path('signupload/');
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = date('YmdHis').'.'.$image_type;
        file_put_contents(public_path('signupload/'.$file), $image_base64);
        // $request->file('signed')->move($folderPath,$file);
        $dataUser->signed = $file;
        /* Save data */
        $dataUser->save();

        $nomor_standar = $request->get('nomor_standar');
        foreach($nomor_standar as $item => $value){
            $data2 = array(
                'id_user'       => $dataUser->id,
                'nomor_standar' => $data['nomor_standar'][$item],
                'jenis_standar' => $data['jenis_standar'][$item],
                'format'        => $data['format'][$item],
                'blokir'        => $data['blokir'][$item],
            );
               //dd($data2);
            StandardDemands::insert($data2);
        };


        /* Mengirim email */
        // $data = [
        //     'nama'              => $request-> nama,
        //     'nip'               => $request->nip,
        //     'email'             => $request->email,
        //     'pejabat'           => $request->pejabat,
        //     'jabatan'           => $request->jabatan,
        //     'unitEs1'           => $request->unitEs1,
        //     'unitEs2'           => $request->unitEs2,
        //     'unitEs3'           => $request->unitEs3,
        //     'tujuan_penggunaan' => $request->tujuan_penggunaan,
        //     'watermark'         => $request->watermark,
        //     'pejabat'           => $request->pejabat,
        //     'jabatan'           => $request->jabatan,
        //     'nomor_standar'     => $request->nomor_standar,
        //     'jenis_standar'     => $request->jenis_standar,
        //     'signed'            => $request->$file
        // ];

        // $id = $dataUser->id;
        // // dd($id);
        // $standar_list = StandardDemands::select('nomor_standar','jenis_standar')->where('id_user','=',$id)->get();
        // $permintaan = DataUsers::findOrFail($id);
        // $pdf = PDF::loadView('frontend.cetakPDF', compact('permintaan','standar_list'));

        // Mail::send('emails.mail', $data, function($message) use($request,$pdf){
        //     $message->to('setokuncoro@bsn.go.id','Admin Layanan Internal')
        //             ->subject('Permintaan Standar a.n. '.$request->nama)
        //             ->attachData($pdf->output(), now()->format('YmdHis').'_'.$request->nama."_formulir.pdf");
        //     $message->from('perpus.bsn@gmail.com','LIPS');
        // });

        Alert::success('Formulir Terkirim','Mohon menunggu, permintaan anda sedang diproses.');
        return redirect('tabel-permintaan');
    }

    /* Autocomplete Start */
    public function searchPemohon(Request $request){
        $search = $request->search;
        if($search == ''){
            $daftar_pegawai = DataPegawai::orderby('nama_pegawai','asc')->select('nama_pegawai','nip_pegawai')->limit(10)->get();
        }
        else{
            $daftar_pegawai = DataPegawai::orderby('nama_pegawai','asc')->select('nama_pegawai','nip_pegawai')->
            where('nama_pegawai','like','%'.$search.'%')->limit(10)->get();
        }
        return $daftar_pegawai->map(function($item){
           return[
               'label' => $item->nama_pegawai,
               'value' => $item->nip_pegawai,
           ];
        });
    }

    public function searchUnitKerja(Request $request){
        $search = $request->search;

        if($search == ''){
            $unit_kerja = UnitKerja::orderby('id','asc')->select('unit')/*->limit(5)*/->get();
        }else{
            $unit_kerja = UnitKerja::orderby('id','asc')->select('unit')->where('unit', 'like', '%' .$search . '%')/*->limit(5)*/->get();
        }

        $response = array();
        foreach($unit_kerja as $unit){
            $response[] = array(
                "id"=>$unit->unit,
                "text"=>$unit->unit
            );
      }

      return response()->json($response);

    }

    public function searchPejabat(Request $request){
        $search = $request->search;
        if($search == ''){
            $daftar_pegawai = DataPegawai::orderby('nama_pegawai','asc')->select('nama_pegawai','jabatan_pegawai')->limit(10)->get();
        }
        else{
            $daftar_pegawai = DataPegawai::orderby('nama_pegawai','asc')->select('nama_pegawai','jabatan_pegawai')->
            where('nama_pegawai','like','%'.$search.'%')->limit(10)->get();
        }
        return $daftar_pegawai->map(function($item){
            return[
                'label' => $item->nama_pegawai,
                'value' => $item->jabatan_pegawai,
            ];
        });
    }
    /* Autocomplete End */

    /* Tabel Permintaan */
    public function tabelPermintaan(Request $request){
            // $data = DataUsers::all();

        if($request->ajax())
        {
            $data_permintaan = DB::table('data_users')
            ->select('data_users.nama','unit_kerja.singkatan','data_users.created_at',
            DB::raw('count(standard_demands.nomor_standar) as permintaan'),'data_users.updated_at',
            'data_users.status')->join('standard_demands','data_users.id','=','standard_demands.id_user')
            ->join('unit_kerja', 'data_users.unit_kerja','=','unit_kerja.unit')
            ->groupBy('data_users.created_at')
            ->orderBy('data_users.created_at','desc')->get();

            return DataTables::of($data_permintaan)->addIndexColumn()->make(true);
        }
            

        return view('frontend.tabel-permintaan');
    }

    /* Statistik */
    public function statistik() {
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

        $data_tabel_standar = DB::table('data_users')
        ->join('standard_demands','data_users.id','=','standard_demands.id_user')
        ->select('standard_demands.jenis_standar')
        ->selectRaw('count(distinct(standard_demands.nomor_standar)) as judul')
        ->selectRaw('count(standard_demands.nomor_standar) as eksemplar')
        ->where('data_users.status','=',1)
        ->where('standard_demands.blokir','=',0)
        ->groupBy('standard_demands.jenis_standar')
        ->orderBy('judul','desc')->get();
        
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
        ->groupBy('unit_kerja.eselon_satu')
        ->orderBy('total','desc')->get();

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
        ->groupBy('data_users.tujuan_penggunaan')
        ->orderBy('total','desc')->get();

        //notifikasi navbar
        $permintaan_all = DataUsers::all()->count();
        $terkirim = DataUsers::where('status','=',1)->count();
        $belum_terkirim = DataUsers::where('status','=',0)->count();
        $gagal_proses = DataUsers::where('status','=',2)->count();

        return view('frontend.statistik', compact('permintaan_all','terkirim','belum_terkirim','gagal_proses',
        'sestama','sestama_judul','sestama_eks','pengembangan','pengembangan_judul','pengembangan_eks',
        'penerapan','penerapan_judul','penerapan_eks','akreditasi','akreditasi_judul','akreditasi_eks',
        'snsu','snsu_judul','snsu_eks','klt','klt_judul','klt_eks','terlayani','tidak_terlayani',
        'tersedia','tidak_tersedia','data_tabel_unit','data_tabel_tujuan','sni_judul','data_tabel_standar',
        'sni_eks','astm_judul','astm_eks','iec_judul','iec_eks','iso_judul','iso_eks','lainnya_judul',
        'lainnya_eks','data_unit_kerja'));
    }

    /* Video Tutorial */
    public function videoTutorial(){
        return view('frontend.tutorial');
    }
}
