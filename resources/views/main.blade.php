@extends('master')

@section('content')
    <div class="d-flex" style="min-height: 100vh">
        <div class="card p-2 ms-4 col-8 mb-3">
            <div id="" class="card-header d-flex justify-content-between">
                <h5>List Product</h5>
                <a href="/add-product" class="btn btn-primary">Tambah Product</a>
            </div>
            <div class="card-body">
                <table id="table-product" class="display w-100 table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Stok</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($product as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->nama_product}}</td>
                                <td>{{$item->stok}}</td>
                                <td>Rp. {{number_format($item->harga_jual)}}</td>
                                <td>
                                    <form action="/product/{{$item->id}}/edit" method="GET"class="d-inline">
                                        <input type="submit" value="Edit" class="btn btn-warning">
                                    </form>
                                    <button class="btn btn-success" onclick="addCart({{$item->id}})">Tambah Keranjang</button>
                                </td>
                            </tr>
                        @empty
                            Barang Kosong
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ms-3 me-3 mb-3 p-2 w-100 bg-white" >
            <div class="card">
                <div class="card-header">Cart</div>
            </div>
            <div class="card-body" style="min-height: 100vh" id="cart">
                
            </div>
            <div class="card-footer">
                <div class="header d-flex justify-content-between">
                    <p class=" fw-bold">Jumlah</p>
                    <p id="total" class=" fw-bold">Rp. <span id="qty"></span></p>
                </div>
                <button class="btn btn-primary btn-block  fw-bold" id="purchase" onclick="buy()">Purchase</button>
            </div>
        </div>
    </div>
@endsection

@push('datatables')
    <script>
        $(document).ready(function(){
            $('#table-product').DataTable({
                "columns": [
                    { "width": "5%" },
                    { "width": "40%" },
                    { "width": "15%" },
                    { "width": "15%" },
                    { "width": "25%" }
                ]
            });
        })
    </script>
    <script>
        var total = 0;
        var listItem = {
            'list':[]
        }

        function addCart(itemId){
            var itemCart = document.createElement('p')
            var qty = document.createElement('span')
            var cart = document.getElementById('cart')
            var index = false;
            // console.log(index)
            
            $.get("/product/"+itemId, function(data, status){
                if(data.stok-1 < 0){
                    return Swal.fire(
                        'Transaksi Gagal',
                        'Klik Tombol OK untuk lanjut',
                        'error'
                    )
                }else{
                    itemCart.setAttribute("id", itemId)
                    if(listItem.list.length==0){
                        listItem.list.push({
                            'id':data.id,
                            'qty':1
                        })
                        itemCart.innerHTML = data.nama_product
                        qty.innerHTML = " " + 1
                    }else{
                        index = listItem.list.findIndex(item => {
                            return data.id == item.id
                        })
                        if(index != -1){
                            if(data.stok < listItem.list[index].qty+1){
                                return Swal.fire(
                                    'Transaksi Gagal',
                                    'Klik Tombol OK untuk lanjut',
                                    'error'
                                )
                            }
                            else{
                                    listItem.list[index].qty++
                                }
                            document.getElementById(itemId).querySelector('span').innerHTML = listItem.list[index].qty
                        }else{
                            listItem.list.push({
                                'id':data.id,
                                'qty':1
                            })
                            itemCart.innerHTML = data.nama_product
                            qty.innerHTML = " " + 1
                        }
                    }
                    console.log(listItem)
                    total += data.harga_jual
                    document.getElementById('total').innerHTML = "Rp. " + total
                    itemCart.appendChild(qty)
                    cart.appendChild(itemCart)
                }
            });
        }

        function buy(){
            var item = JSON.stringify( listItem.list.map(item => {return item.id }))
            $.ajax({
                type: "POST",
                url: '/purchase/' + item,
                data: { 
                    pembeli: "unknown", 
                    _token: "{{csrf_token()}}",
                    qty: JSON.stringify( listItem.list.map(item => {return item.qty }))
                },
                success: function (data) {
                    // console.log(data)
                    Swal.fire(
                        'Transaksi Berhasil',
                        'Klik Tombol OK untuk lanjut',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "/"
                        }
                    })
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        }
    </script>
@endpush