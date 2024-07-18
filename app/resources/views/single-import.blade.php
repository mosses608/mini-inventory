@extends('dash-layout')

@section('content')

<br><br><br><br><br>
<center>
   <div class="container-ajax">
    <button class="delete-product-det" onclick="deleteHov()"><i class="fas fa-trash-alt"></i> <span>Delete</span></button>
   <button class="add-stock-button" onclick="showAddProductForm()"><i class="fa fa-edit"></i> <span>Edit</span></button>
   <button class="product-catalog-wrapper"><a href="/import-product"> &#8592; <span>Back</span></a></button>
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
            </tr>

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
            </tr>
            
        </table>    
       
    </div>
   </div>

   <form action="/products/edit/{{$product->id}}" method="POST" class="add-new-post-wrapper" enctype="multipart/form-data">
    @csrf
    <p>Add New Products</p><br>
    <div class="left-side">
    <label for="">Product Id:</label>
    <input type="text" name="product_id" id="" value="{{$product->product_id}}"><br><br>
    <label for="">Product Name:</label><br>
    <input type="text" name="product_name" id="" value="{{$product->product_name}}">
    <br>
    @error('product_name')
    <span>Product name is required!</span>
    @enderror
    <br>
    <label for="">Qunatity:</label><br>
    <input type="number" name="quantity" id="" value="{{$product->quantity}}"><br>
    @error('quantity')
    <span>Product qumatity required!</span>
    @enderror
    <br>
    <label for="">Description:</label><br>
    <input type="text" name="description" id="" value="{{$product->description}}"><br>
    @error('description')
    <span>Product description is required!</span>
    @enderror
    <br>
    <button type="submit" class="submit-form-button">Add Sales</button>
</div>

<div class="right-side">
    <label for="Price">Price:</label><br>
    <input type="number" name="price" id="" value="{{$product->price}}"><br>
    @error('price')
    <span>Product price required!</span>
    @enderror
    <br>
    <label for="">Brand:</label><br>
    <input type="text" name="brand" id="" value="{{$product->brand}}">
    <br>
    @error('brand')
    <span>Brand is required!</span>
    @enderror
    <br>
    <label for="">Product Image:</label><br>
    <input type="file" name="image" id="" style="border:none;" accept="image/*" value="{{$product->image}}"><br>
    @error('image')
    <span>Image is required!</span>
    @enderror
    <br><br><br><br>
    <button type="button" class="closePopUp" onclick="closeForm()">Close</button>
</div>
</form>

<form action="/delete-product/{{$product->id}}" method="POST" class="delete-product">
    @csrf
    @method('DELETE')
    <p>This action can not be undone!</p><br>
    <button type="submit" class="confirm-button">Confirm</button> <button class="close-form" type="button" onclick="closeForm()">Close</button>
</form>
<br><br>
</center>
@endsection