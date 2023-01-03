@include('admin.layouts.headers.category.index')

@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @if (Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
                
            </div>
                
            @endif
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All categories</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Num.</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($categories as $category)
                    <tr>
                      <td>{{$category->id}}</td>
                      <td>{{$category->name}}
                      </td>
                      <td>
                        {{-- <a href="{{route('products.edit',)}}"> --}}
                          <button type="button" class="btn btn-warning"><a href="{{route('category.edit',['category'=>$category->id])}}">Edit</a> </button> 
                        <form
                        action="{{route('category.destroy',['category'=>$category->id])}}"
                        method="post">
                            @csrf
                            @method('DELETE')
                             <button class=""><a href="#" id="delete" class="btn btn-danger" ><i class="nav-icon fas fa-trash"></i></a></button> 
                              
                        </form>
                      
                      </td>
                    </tr>  
                    @empty
                              <p>No category available</p>
                    @endforelse
                  
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Num.</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>   
@endsection
@include('admin.layouts.footer.category.add')

<script>
 $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>