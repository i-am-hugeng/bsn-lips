class DropDown{
    constructor(data){
        this.data = data;
        this.targets = [];
    }

    filterData(filtersAsArray){
        return this.data.filter(r => filtersAsArray.every((item,i) => item === r[i]));
    }

    getUniqueValues(dataAsArray,index){
        const uniqueOptions = new Set();
        dataAsArray.forEach(r => uniqueOptions.add(r[index]));
        return [...uniqueOptions];
    }

    populateDropDown(el,listAsArray){
        var innerData = "<option value='' selected><span>--Isi Data--</span></option>";
        el.innerHTML = innerData;
        listAsArray.forEach(item => {
            const option = document.createElement("option");
            option.textContent = item;
            el.appendChild(option);
        });
    }

    createPopulateDropDownFunction(el,elsDependsOn) {
        return () => {
            const elsDependsOnValues = elsDependsOn.length === 0 ? null : elsDependsOn.map(depEl => depEl.value);
            const dataToUse = elsDependsOn.length === 0 ? this.data : this.filterData(elsDependsOnValues);
            const listToUse = this.getUniqueValues(dataToUse, elsDependsOn.length);
            this.populateDropDown(el,listToUse);
        }
    }

    add(options){
        const el = document.getElementById(options.target);
        const elsDependsOn = options.dependsOn.length === 0 ? [] : options.dependsOn.map(id => document.getElementById(id));
        const eventFunction = this.createPopulateDropDownFunction(el,elsDependsOn);
        const targetObject = {el:el, elsDependsOn:elsDependsOn, func:eventFunction};
        targetObject.elsDependsOn.forEach(depEl => depEl.addEventListener("change",eventFunction));
        this.targets.push(targetObject);
        return this;
    }

    initialize(){
        this.targets.forEach(t => t.func());
        return this;
    }

    easyDropDown(arrayOfIds){
        arrayOfIds.forEach((item,i) => {
            const option = {target: item, dependsOn: arrayOfIds.slice(0,i)};
            this.add(option);
        });
        this.initialize();
    }
}

var unitKerja = [
    ['Sekretariat Utama','Biro Perencanaan Keuangan dan Umum','Bagian Perencanaan'],
    ['Sekretariat Utama','Biro Perencanaan Keuangan dan Umum','Bagian Keuangan'],
    ['Sekretariat Utama','Biro Perencanaan Keuangan dan Umum','Bagian Umum'],
    ['Sekretariat Utama','Biro Sumber Daya Manusia, Organisasi, dan Hukum','Bagian Sumber Daya Manusia'],
    ['Sekretariat Utama','Biro Sumber Daya Manusia, Organisasi, dan Hukum','Bagian Organisasi dan Tata Laksana'],
    ['Sekretariat Utama','Biro Sumber Daya Manusia, Organisasi, dan Hukum','Bagian Hukum'],
    ['Sekretariat Utama','Biro Humas, Kerja Sama, dan Layanan Informasi','Bagian Hubungan Masyarakat'],
    ['Sekretariat Utama','Biro Humas, Kerja Sama, dan Layanan Informasi','Bagian Kerja Sama'],
    ['Sekretariat Utama','Biro Humas, Kerja Sama, dan Layanan Informasi','Bagian Layanan Informasi dan Perpustakaan'],
    ['Sekretariat Utama','Pusat Riset dan Pengembangan Sumber Daya Manusia','Bidang Riset Standardisasi dan Penilaian Kesesuaian'],
    ['Sekretariat Utama','Pusat Riset dan Pengembangan Sumber Daya Manusia','Bidang Diseminasi Hasil Riset Standardisasi dan Penilaian Kesesuaian'],
    ['Sekretariat Utama','Pusat Riset dan Pengembangan Sumber Daya Manusia','Bidang Pengembangan Sumber Daya Manusia, Standardisasi dan Penilaian Kesesuaian'],
    ['Sekretariat Utama','Pusat Riset dan Pengembangan Sumber Daya Manusia','Bagian Umum'],
    ['Sekretariat Utama','Pusat Data dan Sistem Informasi','Bidang Infrastruktur dan Keamanan Informasi'],
    ['Sekretariat Utama','Pusat Data dan Sistem Informasi','Bidang Sistem Informasi dan Tata Kelola Data'],
    ['Sekretariat Utama','Inspektorat','Tata Usaha'],
    ['Sekretariat Utama','Inspektorat','Kelompok Jabatan Fungsional'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Agro, Kimia, Kesehatan, dan Halal','Subdit Pengembangan Standar Pertanian dan Halal'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Agro, Kimia, Kesehatan, dan Halal','Subdit Pengembangan Standar Lingkungan, Kehutanan, Perikanan, dan Kelautan'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Agro, Kimia, Kesehatan, dan Halal','Subdit Pengembangan Standar Kimia'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Agro, Kimia, Kesehatan, dan Halal','Subdit Pengembangan Standar Kesehatan'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Mekanika, Energi, Elektronika, Transportasi, dan Teknologi Informasi','Subdit Pengembangan Standar Mekanika dan Material'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Mekanika, Energi, Elektronika, Transportasi, dan Teknologi Informasi','Subdit Pengembangan Standar Energi'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Mekanika, Energi, Elektronika, Transportasi, dan Teknologi Informasi','Subdit Pengembangan Standar Elektronika'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Mekanika, Energi, Elektronika, Transportasi, dan Teknologi Informasi','Subdit Pengembangan Standar Transportasi dan Teknologi Informasi'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Infrastruktur, Penilaian Kesesuaian, Personal, dan Ekonomi Kreatif','Subdit Pengembangan Standar Infrastruktur'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Infrastruktur, Penilaian Kesesuaian, Personal, dan Ekonomi Kreatif','Subdit Pengembangan Standar Sistem Manajemen dan Penilaian Kesesuaian'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Infrastruktur, Penilaian Kesesuaian, Personal, dan Ekonomi Kreatif','Subdit Pengembangan Standar Jasa, Personal, dan Ekonomi Kreatif'],
    ['Deputi Bidang Pengembangan Standar','Direktorat Pengembangan Standar Infrastruktur, Penilaian Kesesuaian, Personal, dan Ekonomi Kreatif','Subdit Pengembangan Standar Teknologi Khusus dan Inovasi Baru'],
    ['Deputi Bidang Penerapan Standar dan Penilaian Kesesuaian','Direkorat Sistem Penerapan Standar dan Penilaian Kesesuaian','Subdit Pengembangan Skema Penerapan Standar Sukarela dan Penilaian Kesesuaian'],
    ['Deputi Bidang Penerapan Standar dan Penilaian Kesesuaian','Direkorat Sistem Penerapan Standar dan Penilaian Kesesuaian','Subdit Sistem Pemberlakuan Standar Wajib dan Penilaian Kesesuaian'],
    ['Deputi Bidang Penerapan Standar dan Penilaian Kesesuaian','Direkorat Sistem Penerapan Standar dan Penilaian Kesesuaian','Subdit Pengendalian Penerapan Standar dan Penilaian Kesesuaian'],
    ['Deputi Bidang Penerapan Standar dan Penilaian Kesesuaian','Direkorat Sistem Penerapan Standar dan Penilaian Kesesuaian','Subdit Pemenuhan Kewajiban Internasional Bidang Standar dan Penilaian Kesesuaian'],
    ['Deputi Bidang Penerapan Standar dan Penilaian Kesesuaian','Direktorat Penguatan Penerapan Standar dan Penilaian Kesesuaian','Subdit Diseminasi Standar dan Penilaian Kesesuaian'],
    ['Deputi Bidang Penerapan Standar dan Penilaian Kesesuaian','Direktorat Penguatan Penerapan Standar dan Penilaian Kesesuaian','Subdit Fasilitasi Pelaku Usaha'],
    ['Deputi Bidang Penerapan Standar dan Penilaian Kesesuaian','Direktorat Penguatan Penerapan Standar dan Penilaian Kesesuaian','Subdit Fasilitasi Lembaga Penilaian Kesesuaian'],
    ['Deputi Bidang Akreditasi','Direktorat Sistem dan Harmonisasi Akreditasi','Subdit Sistem dan Harmonisasi Akreditasi Laboratorium'],
    ['Deputi Bidang Akreditasi','Direktorat Sistem dan Harmonisasi Akreditasi','Subdit Sistem dan Harmonisasi Lembaga Inspeksi dan Lembaga Sertifikasi'],
    ['Deputi Bidang Akreditasi','Direktorat Akreditasi Laboratorium','Subdit Akreditasi Laboratorium Pengujian Pangan, Pertanian, Perikanan, Kehutanan, Kesehatan, dan Lingkungan'],
    ['Deputi Bidang Akreditasi','Direktorat Akreditasi Laboratorium','Subdit Akreditasi Laboratorium Pengujian Mekanika, Energi, Elektronika, Konstruksi, dan Teknologi Khusus'],
    ['Deputi Bidang Akreditasi','Direktorat Akreditasi Laboratorium','Subdit Akreditasi Laboratorium Kalibrasi'],
    ['Deputi Bidang Akreditasi','Direktorat Akreditasi Laboratorium','Subdit Akreditasi Laboratorium Medik, Penyelenggaraan Uji Profisiensi, dan Produsen Bahan Acuan'],
    ['Deputi Bidang Akreditasi','Direktorat Akreditasi Lembaga Inspeksi dan Lembaga Sertifikasi','Subdit Akreditasi Lembaga Inspeksi, Lembaga Verifikasi, dan Lembaga Validasi'],
    ['Deputi Bidang Akreditasi','Direktorat Akreditasi Lembaga Inspeksi dan Lembaga Sertifikasi','Subdit Akreditasi Lembaga Sertifikasi Produk, Proses, dan Jasa'],
    ['Deputi Bidang Akreditasi','Direktorat Akreditasi Lembaga Inspeksi dan Lembaga Sertifikasi','Subdit Akreditasi Lembaga Sertifikasi Personal dan Pembangunan Berkelanjutan'],
    ['Deputi Bidang Standar Nasional Satuan Ukuran','Direktorat Standar Nasional Satuan Ukuran Mekanika, Radiasi, dan Biologi','Subdit SNSU Massa'],
    ['Deputi Bidang Standar Nasional Satuan Ukuran','Direktorat Standar Nasional Satuan Ukuran Mekanika, Radiasi, dan Biologi','Subdit SNSU Panjang'],
    ['Deputi Bidang Standar Nasional Satuan Ukuran','Direktorat Standar Nasional Satuan Ukuran Mekanika, Radiasi, dan Biologi','Subdit SNSU Akustik dan Vibrasi'],
    ['Deputi Bidang Standar Nasional Satuan Ukuran','Direktorat Standar Nasional Satuan Ukuran Mekanika, Radiasi, dan Biologi','Subdit SNSU Radiasi dan Biologi'],
    ['Deputi Bidang Standar Nasional Satuan Ukuran','Direktorat Standar Nasional Satuan Ukuran Termoelektrik dan Kimia','Subdit SNSU Suhu'],
    ['Deputi Bidang Standar Nasional Satuan Ukuran','Direktorat Standar Nasional Satuan Ukuran Termoelektrik dan Kimia','Subdit SNSU Fotometri dan Radiometri'],
    ['Deputi Bidang Standar Nasional Satuan Ukuran','Direktorat Standar Nasional Satuan Ukuran Termoelektrik dan Kimia','Subdit SNSU Kelistrikan dan Waktu'],
    ['Deputi Bidang Standar Nasional Satuan Ukuran','Direktorat Standar Nasional Satuan Ukuran Termoelektrik dan Kimia','Subdit SNSU Kimia']
];

var tujuanPenggunaan = [
    ['Perumusan SNI'],
    ['Kaji Ulang SNI'],
    ['Pengembangan Skema Akreditasi'],
    ['Pengembangan Skema Sertifikasi'],
    ['Penerapan Standar'],
    ['Sosialisasi dan Promosi SPK'],
    ['Pembinaan UMK / UKM'],
    ['Pemetaan LPK'],
    ['Layanan Kalibrasi (SNSU)'],
    ['Pelatihan SPK'],
    ['Penelitian SPK'],
    ['Dokumen Kerja']
];


// var dd_unitKerja = new DropDown(unitKerja).easyDropDown(["level1","level2","level3"]);

var dd_tujuanPenggunaan = new DropDown(tujuanPenggunaan).easyDropDown(["tujuan_penggunaan"]);








