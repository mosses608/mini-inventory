@extends('dash-layout')

@section('content')
<br><br><br><br><br>
<center>
   <div class="container-ajax">
    <!-- <form action="/dashboard" method="GET" class="search-single-component">
        @csrf
        <input type="text" name="search" id="" placeholder="Search Product..."><button type="submit"><em><i class="fa fa-search"></i></em><span>Search</span></button>
    </form>
   <button class="add-stock-button" onclick="showAddSalesForm()"><i class="fa fa-plus"></i> <span>Sale Product</span></button>
   <button class="product-catalog-wrapper"><a href="#"><i class="fa fa-eye"></i> <span>Product</span></a></button> -->
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
                <td>
                    <button type="button" class="edit-form-sale" onclick="showEdirForm()"><i class="fa fa-edit"></i></button>
                    <button type="button" class="delete-component" onclick="showDeleteMessage()"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        </table>    
    </div>
   </div>

   <form action="/sales/edit-sale/{{$sale->id}}" method="POST" class="add-new-post-wrapper" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <p>Update Sales Details</p><br>
    <div class="left-side">
    <label for="">Product Id:</label>
    <input type="text" name="product_id" id="" value="{{$sale->product_id}}"><br><br>
    <label for="">Product Name:</label><br>
    <select name="product_name" id="">
        <option value="{{$sale->product_name}}">Choose</option>
        <option value="Laptop">Laptop</option>
        <option value="Desktop">Desktop</option>
        <option value="Printer">Printer</option>
        <option value="Mouse">Mouse</option>
        <option value="USB Flash">USB Flash</option>
    </select><br><br>
    <label for="">Qunatity:</label><br>
    <input type="number" name="quantity" id="" value="{{$sale->quantity}}"><br>
    @error('quantity')
    <span>Product qumatity required!</span>
    @enderror
    <br>
</div>
<div class="right-side">
    <label for="Price">Price:</label><br>
    <input type="number" name="price" id="" value="{{$sale->price}}"><br>
    @error('price')
    <span>Product price required!</span>
    @enderror
    <br>
    <label for="">Brand:</label><br>
    <select name="brand" id="">
        <option value="{{$sale->brand}}">Choose brand</option>
        <option value="HP">HP</option>
        <option value="Microsoft">Microsoft</option>
        <option value="Dell">Dell</option>
    </select><br><br>
    <label for="">Product Image:</label><br>
    <input type="file" name="image" id="" style="border:none;" value="{{$sale->image}}"><br>
    @error('image')
    <span>Image is required!</span>
    @enderror
    <br>
</div>
    <button type="submit" class="submit-form-button">Add Sales</button> <button type="button" class="closePopUp" onclick="closeForm()">Close</button><br><br>
   </form>

   <div class="dialog-message-builder">
    <p>Thsi action can not be undone!</p><br>
    <form action="/sales/delete/{{$sale->id}}" method="POST" class="delete-product-sale">
        @method('DELETE')
        @csrf
        <button type="submit" class="confirm-delete">Confirm!</button> <button class="exit-delete" onclick="exitPop()" type="button">Exit</button>
    </form>
   </div>
</center>

@endsection