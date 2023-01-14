@extends('master')
@section('content')
    <div class="card p-2 container-fluid">
        <div id="" class="card-header d-flex justify-content-between">
            <h5>Add Product</h5>
        </div>
        <div class="card-body">
            <form action="/product" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Product</label>
                    <input type="text" name="namaProduct" class="form-control" id="namaProduct" placeholder="Masukkan nama product" autofocus>
                    @error('namaProduct')
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Nama Product Belum Diisi
                            </div>
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stokProduct" class="form-control" id="stok" placeholder="Masukkan Stok Product">
                    @error('stokProduct')
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Stok Product Belum Diisi
                            </div>
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Beli</label>
                    <input type="harga" name="hargaBeliProduct" class="form-control" id="harga" placeholder="Masukkan Harga product">
                    @error('hargaBeliProduct')
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Harga Beli Product Belum Diisi
                            </div>
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Jual</label>
                    <input type="harga" name="hargaJualProduct" class="form-control" id="harga" placeholder="Masukkan Harga product">
                    @error('hargaJualProduct')
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Harga Jual Product Belum Diisi
                            </div>
                        </div>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select class="form-select mb-5" name="kategoriProduct" aria-label="Default select example">
                        <option selected>Kategori</option>
                        <option value="1">Lampu</option>
                    </select>
                    @error('kategoriProduct')
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Kategori Product Belum Diisi
                            </div>
                        </div>
                    @enderror
                </div> --}}
                
                <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
            </form>
@endsection