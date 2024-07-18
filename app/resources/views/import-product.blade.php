@extends('dash-layout')

@section('content')

<br><br><br><br><br>
<center>
   <div class="container-ajax">
    <form action="/import-product" method="GET" class="search-single-component">
        @csrf
        <input type="text" name="search" id="" placeholder="Search Product..."><button type="submit"><em><i class="fa fa-search"></i></em><span>Search</span></button>
    </form>
   <button class="add-stock-button" onclick="showAddProductForm()"><i class="fa fa-plus"></i> <span>Import</span></button>
   <button class="product-catalog-wrapper"><a href="/"> &#8592; <span>Back</span></a></button>
   <br><br>
    <div class="table-wrapper-container">
        <table>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Product Id</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Description</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>

            @foreach($products as $product)
            <tr>
                <td>#</td>
                <td><img src="{{asset('storage/' . $product->image)}}" alt="Image"></td>
                <td>{{$product->product_id}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->quantity}}</td>
                <td>
                    @if($product->status == 'Good')
                    <span id="good-status">{{$product->status}}</span>
                    @elseif($product->status == 'Less')
                    <span id="poor-less">{{$product->status}}</span>
                    @endif
                </td>
                <td>{{$product->price}}</td>
                <td>{{$product->brand}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->created_at}}</td>
                <td><a href="/single-import/{{$product->id}}"><i class="fa fa-eye"></i></a></td>
            </tr>
            @endforeach
            
        </table>    
        <div class="paginate-builder-wrapper">
            {{$products->links()}}
        </div>
       
    </div>
   </div>

   <form action="/products" method="POST" class="add-new-post-wrapper" enctype="multipart/form-data">
    @csrf
    <p>Add New Products</p><br>
    <div class="left-side">
    <label for="">Product Id:</label>
    <input type="text" name="product_id" id="" placeholder="Product Id . . ."><br><br>
    <label for="">Product Name:</label><br>
    <input type="text" name="product_name" id="" placeholder="Product name...">
    <br>
    @error('product_name')
    <span>Product name is required!</span>
    @enderror
    <br>
    <label for="">Qunatity:</label><br>
    <input type="number" name="quantity" id="" placeholder="Quantity . . ."><br>
    @error('quantity')
    <span>Product qumatity required!</span>
    @enderror
    <br>
    <label for="">Description:</label><br>
    <input type="text" name="description" id="" placeholder="Description . . ."><br>
    @error('description')
    <span>Product description is required!</span>
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
    <input type="text" name="brand" id="" placeholder="Brand name . . .">
    <br>
    @error('brand')
    <span>Brand is required!</span>
    @enderror
    <br>
    <label for="">Product Image:</label><br>
    <input type="file" name="image" id="" style="border:none;" accept="image/*"><br>
    @error('image')
    <span>Image is required!</span>
    @enderror
    <br><br><br><br>
    <button type="button" class="closePopUp" onclick="closeForm()">Close</button>
</div>
<br><br>
   </form>
</center>
@endsection