<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Pemberitahuan Cuti</title>
</head>

<body>
    <p>Kepada Yang Terhormat Bapak/Ibu {{ $data['nama'] }}, anda mengajukan cuti untuk tanggal {{ $data['awal'] }}
        sampai dengan tanggal {{ $data['akhir'] }}</p>
    <p>Setelah melakukan oleh verifikator, ajuan Bapak/Ibu <b>{{ $data['st'] }}</b></p>
</body>

</html>
