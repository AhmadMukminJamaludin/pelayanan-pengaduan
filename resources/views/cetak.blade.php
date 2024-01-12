<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Daftar Laporan Pengaduan Masyarakat</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.6;
            margin: 20px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            padding: 5px;
            margin-bottom: 20px;
            border-bottom: 3px double #000;
            position: relative;
        }

        .header img {
            max-width: 100px;
            position: absolute;
            left: 20px;
            top: 0px;
        }

        .header h4 {
            color: #333;
            line-height: 1.2;
            margin: 0px;
            padding: 0px;
            font-size: 24px;
        }

        .header h6 {
            color: #333;
            line-height: 1.2;
            margin: 0px;
            padding: 0px;
            font-size: 17px;
        }

        .header p {
            line-height: 1.2;
            margin: 0;
        }

        .header p span {
            line-height: 1;
            font-size: 14px;
        }

        .kpd {
            margin: 0;
        }

        .tgl {
            display: flex;
            justify-content: end;
            font-size: 16px;
        }

        .content {
            text-align: justify;
            font-size: 16px;
        }

        .closing {
            display: flex;
            justify-content: end;
            margin-top: 5px;
            margin-right: 20px;
        }

        .closing p {
            text-align: center;
            font-size: 16px;
        }

        .ttd {
            display: flex;
            flex-direction: column;
            align-items: end;
        }

        .signature {
            width: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin: 30px 0px 0px 0px;
        }

        .signature p {
            margin: 0;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 0px 5px 0px 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('img/logo-karanganyar.png') }}" alt="Logo Perusahaan">
			<h6>PEMERINTAH KABUPATEN KARANGANYAR</h3>
			<h4>KECAMATAN GONDANGREJO</h4>
			<h4>DESA PLESUNGAN</h4>
            <p>
				<span>Jl. Mayor Achmadi No.37, Wirun, Plesungan, <br>Kec. Gondangrejo, Kabupaten Karanganyar, Jawa Tengah 57181</span>
				{{-- <span>Website: https://rsunimus.com, Email: humas@rsunimus.com</span> --}}
			</p>
		</div>

        <h3 style="text-transform: uppercase; text-align: center; margin: 0; text-decoration: underline; line-height: 1;">daftar laporan pengaduan masyarakat</h3>

        <div class="content">
            <p style="margin: 25px 0px 0px 0px;">
                Berikut adalah daftar laporan pengaduan masyarakat:
            </p>

            <table style="margin: 1;">
                <thead>
                    <tr>
                        <th style="text-align: center;">No.</th>
                        <th style="text-align: center;">No. Tracking</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Judul Keluhan</th>
                        <th style="text-align: center;">Tanggal Aduan</th>
                        <th style="text-align: center;">Kategori</th>
                        <th style="text-align: center;">Respon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aduan as $item)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td>{{ $item->no_tracking }}</td>
                            <td>{{ $item->createdBy->name }}</td>
                            <td>{{ $item->judul_keluhan }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->responLatest->status_respon }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="ttd">
            <div class="closing">
                <p>
                    Gondangrejo, {{ \Carbon\Carbon::now()->translatedFormat('j F Y') }}<br>
                    Kepala Desa
                </p>
            </div>

            <div class="signature">
                <p style="text-decoration: underline; line-height: 1;">
                    Waluyo
                </p>
            </div>
        </div>
    </div>
</body>
</html>
