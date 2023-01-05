<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Kepensiunan Pegawai PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    
</head>
<body>
    <h5 class="text-center">Laporan Pegawai Periode ({{ $date[0] }} - {{ $date[1] }})</h5>
    <hr>
    <table width="100%" class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>NPK</th>
                <th>Nama Pegawai</th>
                <th>Status</th>
                <th>Tanggal Pensiun</th>
            </tr>
        </thead>
        <tbody>
         
            @forelse ($pegawai as $row)
                <tr>
                    <td><strong>{{ $row->npk }}</strong></td>
                    <td>
                        <strong>{{ $row->nama }}</strong><br>
                       
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->created_at->format('d-m-Y') }}</td>
                </tr>

           
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
       
    </table>
</body>
</html>