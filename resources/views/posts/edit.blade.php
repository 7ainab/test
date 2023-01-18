@extends('layouts.app')

@section('content')






<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post {{$posts->title}}</div>

                <div class="card-body">




                    @if(count($errors)>0)
                    <ul class="navbar-nav mr-auto">
                            @foreach ($errors->all() as $error)
                            <li class="nav-item active">
                                     {{$error}}
                                  </li>
                            @endforeach
                            
                          </ul>
                          @endif

                    

                    <form action="{{route('post.update',['id' => $posts->id ])}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field()}}

   
                               <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" name="category_id" id="category">
                                     
                                     @foreach ($categories as $category)
                                     @if ($category->id == $posts->category_id)
                                     <option value="{{$category->id}}" selected>{{$category->Name}}</option>

                                     @else
                                     <option value="{{$category->id}}" >{{$category->Name}}</option>
                                     @endif
                                     
                                     @endforeach
                                       
                                     
                                    </select>
                                  </div>


                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" name="title"  value="{{$posts->title}}">
                         </div>
                         <div class="form-group">
                            <label for="content">Description</label>
                            <textarea class="form-control" name="content" id="content" rows="8" cols="8">
                                    {!! $posts->content !!} 
                            </textarea>
                          </div>
                          <div class="form-group">
                            <label for="featured">Photo</label>
                            <br/>
                            <input type="file" class="form-control-file" name="featured">
                          </div>
                       
                         <br/>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </form>      
                    







                </div>
            </div>
        </div>
    </div>
</div>
@endsection


