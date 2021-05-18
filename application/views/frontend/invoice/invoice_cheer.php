<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice | Bukti Registrasi Gmedia Cheerleading Contest</title>
    <style>
        body {
            font-family: 'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;
            font-size: 13px;
        }
        .wrapper {
            width: 100%;
            padding: 5px;
        }

        .bold {
            font-weight: 700;
        }

        .logo {
            width: 100%;
            position: relative;
            height: 40px;
        }

        .logo .logo-left {
            top: 0;
            left: auto;
        }

        .logo .logo-right {
            top: 0;
            right: 0;
            position: absolute;
        }

        .wrapper .top-title {
            padding: 10px;
            font-weight: bold;
            width: 100%;
            text-align: center;
            font-size: 16px;
            text-transform: uppercase;
        }

        .footer {
            background-color: #f7f7f7;
            border-top:1px solid #d4d4d4;
            right: 0;
            bottom: 0;
            left: 0;
            padding:15px;
            text-align: center;
            color:#999;
            position: absolute;
        }

        .top-title {
            font-weight: bold;
            font-size: 32px;
            color:#334B9B;
        }

        .top-title-2 {
            margin-top: 10px;
            font-weight: 700;
            font-size: 16px;
            color: #666666;
            /* line-height:32px; */
        }

        .top-title-3 {
            font-size:14px;font-weight:300;line-height:24px;text-align:justify;color:#616161;
        }

        .table {
            margin:30px 0;color:rgba(0,0,0,0.70);font-size:14px;border-collapse:collapse;
        }

        .td-style {
            border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <table width="100%" style="margin-top:-10px;">
            <tr>
                <td width="15%" style="text-align:right">
                    <img width="135px" src="./frontend/images/logo-cheerleading.png" alt="logo right">
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td width="20%" style="text-align:right">
                    <img width="100px" src="./frontend/images/gmedia_warna.png" alt="logo right">
                </td>
            </tr>
        </table>
        <div class="top-title">
            <span style="font-size:24px;">Pendaftaran berhasil</span>
        </div>
        <div class="top-title-2">
            Invoice <u><?php echo isset($detail->nomor) ? $detail->nomor:'';?></u> <br>
            Gmedia Cheerleading Contest
        </div>
        <div class="top-title-3">
            <p>Halo! Terima kasih telah melakukan registrasi pendaftaran Gmedia Cheerleading Contest.</p>
            <br>
            <p>
                Proses registrasi pendaftaran anda telah sukses! <br> 
                Dengan jumlah biaya registrasi pendaftaran yang telah di bayarkan : 
            </p>
        </div>
        <div style="width:100%;text-align:center;margin-top:30px">
            <h4 style="font-size:12px;color:#666;font-weight:600">Total Pembayaran</h4>
            <p style="margin-top:10px;color:#000;font-size:24px;font-weight:bold;">
                Rp. 200.000,-
            </p>
        </div>
        <table width="100%" class="table">
            <tbody>
                <tr>
                    <td>
                        <h1 style="margin:0;font-size:16px;font-weight:bold;line-height:24px;color:rgba(0,0,0,0.70)">
                            Detail Data Pendaftaran
                        </h1>
                    </td>
                </tr>
                <tr>
                    <td class="td-style">No. Invoice</td>
                    <td class="td-style"><?php echo isset($detail->nomor) ? $detail->nomor:'';?></td>
                </tr>
                <tr>
                    <td class="td-style">Tanggal Registrasi</td>
                    <td class="td-style"><?php echo isset($detail->tanggal) ? $this->Main_model->tanggal_slash($detail->tanggal):'';?></td>
                </tr>
                <tr>
                    <td class="td-style">Nama Organisasi</td>
                    <td class="td-style"><?php echo isset($detail->nama_organisasi) ? $detail->nama_organisasi:'';?></td>
                </tr>
                <tr>
                    <td class="td-style">Nama Tim</td>
                    <td class="td-style"><?php echo isset($detail->nama_tim) ? $detail->nama_tim:'';?></td>
                </tr>
                <tr>
                    <td class="td-style">Divisi Group Stunt</td>
                    <td class="td-style"><?php echo isset($detail->divisi) ? $detail->divisi:'';?></td>
                </tr>
                <tr>
                    <td class="td-style">Email</td>
                    <td class="td-style"><?php echo isset($detail->email) ? $detail->email:'';?></td>
                </tr>
                <tr>
                    <td class="td-style bold">Total Anggota Official</td>
                    <td class="td-style"><?php echo isset($detail->jml_anggota) ? $detail->jml_anggota:'';?> Official</td>
                </tr>
                <tr>
                    <td class="td-style bold">Total Pelatih</td>
                    <td class="td-style"><?php echo isset($detail->jml_pelatih) ? $detail->jml_pelatih:'';?> Orang</td>
                </tr>
                <tr>
                    <td class="td-style bold">Total Atlet</td>
                    <td class="td-style"><?php echo isset($detail->jml_pemain) ? $detail->jml_pemain:'';?> Atlet</td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top:10px">
            <em style="color:red;">
                <strong>
                    Harap menunggu konfirmasi dan verifikasi pembayaran registrasi dari tim admin Gmedia. Untuk informasi lebih lanjut bisa hubungi nomor dibawah ini.
                </strong>
            </em>
        </div>
        <div style="margin-top:15px">
            <em style="color:#000">
                <strong>
                    Informasi : <br>
                    Lia - 0821-3676-9951
                </strong>
            </em>
        </div>
        <div style="margin-top:20px;font-size:14px;font-weight:300;line-height:24px;text-align:justify;color:#616161">
            Terima Kasih!
        </div>
        <div class="footer">
            &copy; 2019 - PT Media Sarana Data (Gmedia)
        </div>
    </div>
</body>
</html>