<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Products - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('/storage/products/'.$product->foto) }}" class="rounded" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>{{ $product->nama_lengkap }}</h3>
                        <hr/>
                        <p>{{ $product->alamat_lengkap }}</p>
                        <hr/>
                        <p>{{ $product->tempat_lahir }}</p>
                        <hr/>
                        <p>{{ $product->tanggal_lahir }}</p>
                        <hr/>
                        <p>{{ $product->jenis_kelamin }}</p>
                        <hr/>
                        <p>{{ $product->jabatan }}</p>
                        <hr/>
                        <p>{{ $product->mulai_masuk_kerja }}</p>
                        <hr/>
                        <code>
                        <p>{{ $product->job_desc }}</p>
                        </code>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
