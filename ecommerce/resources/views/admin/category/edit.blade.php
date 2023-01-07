@include('admin.layouts.headers.category.add');



@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="container">
             
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add category</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form action="{{ route('category.update', $category->id)}}" method="POST">
                @csrf
                @method('PUT') 
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category name</label>
                    <input type="text" value={{$category->name}} name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter category">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                  <input type="submit" class="btn btn-primary" value="Save" >
                </div>
              </form>
              @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
      @endif
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@include('admin.layouts.footer.category.add')

<script>

</script>