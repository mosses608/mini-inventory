@extends('dash-layout')

@section('content')
<br><br><br><br><br>
<center>
   <div class="container-ajax">
    <!-- <div class="left-container-sider">
        <p>Sales</p><br>
        <span>120</span>
    </div>
    <div class="Profit-sale-componet">
        <p>Price</p><br>
        <span>Tsh 1000000</span>
    </div>
    <br><br> -->
    <form action="/dashboard" method="GET" class="search-single-component">
        @csrf
        <input type="text" name="search" id="" placeholder="Search Product..."><button type="submit"><em><i class="fa fa-search"></i></em><span>Search</span></button>
    </form>
   <button class="add-stock-button" onclick="showAddSalesForm()"><i class="fa fa-plus"></i> <span>Sale Product</span></button>
   <button class="product-catalog-wrapper">{{count($sales)}} <span>Sales</span></button>
   <button type="button" class="profit-button">Tsh {{$profit}}</button>
   <br><br>
    <div class="table-wrapper-container">
        <table>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Product Id</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
            @foreach($sales as $sale)
            <tr>
                <td>#</td>
                @foreach($products as $product)
                @if($product->product_id == $sale->product_id)
                <td><img src="{{asset('storage/' . $product->image)}}" alt="Image"></td>
                @endif
                @endforeach
                <td>{{$sale->product_id}}</td>
                <td>{{$sale->product_name}}</td>
                <td>{{$sale->quantity}}</td>
                <td>{{$sale->price}}</td>
                <td>{{$sale->brand}}</td>
                <td>{{$sale->created_at}}</td>
                <td><a href="/single-product/{{$sale->id}}"><i class="fa fa-eye"></i></a></td>
            </tr>
            @endforeach
        </table>    
        <div class="paginate-builder-wrapper">
            {{$sales->links()}}
        </div>
        @if(count($sales) == 0)
        <br>
        <p>No product found here!</p>
        <br>
        @endif
    </div>
   </div>

   <form action="/sales" method="POST" class="add-new-post-wrapper" enctype="multipart/form-data">
    @csrf
    <p>Record Sales Details</p><br>
    <div class="left-side">
    <label for="">Product Id:</label>
    <select name="product_id" id="">
        <option value="//">Select Id</option>
        @foreach($products as $product)
        <option value="{{$product->product_id}}">{{$product->product_id}}</option>
        @endforeach
    </select>
    <br><br>
    <label for="">Product Name:</label><br>
    <select name="product_name" id="">
        <option value="//">Choose</option>
        @foreach($products as $product)
        <option value="{{$product->product_name}}">{{$product->product_name}}</option>
        @endforeach
    </select><br><br>
    <label for="">Qunatity:</label><br>
    <input type="number" name="quantity" id="" placeholder="Quantity . . ."><br>
    @error('quantity')
    <span>Product qumatity required!</span>
    @enderror
    <br>
    <button type="submit" class="submit-form-button">Add Sales</button> 
</div>
<div class="right-side">
    <label for="Price">Price:</label><br>
    <input type="number" name="price" id="" placeholder="Product price . . ."><br>
    @error('price')
    <span>Product price required!</span>
    @enderror
    <br>
    <label for="">Brand:</label><br>
    <select name="brand" id="">
        <option value="//">Choose brand</option>
        @foreach($products as $product)
        <option value="{{$product->brand}}">{{$product->brand}}</option>
        @endforeach
    </select><br><br>
    <!-- <label for="">Product Image:</label><br>
    <input type="file" name="image" id="" style="border:none;"><br>
    @error('image')
    <span>Image is required!</span>
    @enderror
    <br> -->
    <button type="button" class="closePopUp" onclick="closeForm()">Close</button><br><br>
</div>
   </form>
</center>

@endsection