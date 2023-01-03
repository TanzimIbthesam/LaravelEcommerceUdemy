@include('admin.layouts.headers.sliders.all')

@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sliders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sliders</li>
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
                <h3 class="card-title">All Sliders</h3>
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                    
                </div>
                    
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Description one</th>
                    <th>Description Two</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($sliders as $slider)
                    <tr>
                      <td>{{$slider->id}}</td>
                      <td>
                          {{-- <img src="storage/product_images/{{$product->image}}" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="User Image"> --}}
                          <img src="{{ url('storage/all_images/slider_images/'.$slider->slider_image) }}" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="User Image">
                      </td>
                      <td>{{$slider->descriptionone}}</td>
                      <td>{{$slider->descriptiontwo}}</td>
                      {{-- <td>{{$slider->status}}</td> --}}
                      <td>
                        @if ($slider->status==0)
                        <form
                        action="{{url('/activate_slider/'.$slider->id)}}" 
                        
                         
                         method="post">
                            @csrf
                            @method('PATCH')
                        <button class="btn btn-success">Activate</button></a>
                      </form>
                         @else
                         <form
                         route()
                         action="{{url('/deactivate_slider/'.$slider->id)}}"
                         method="post">
                             @csrf
                             @method('PATCH')
                         <button class="btn btn-danger">Deactivate</button></a>
                       </form> 
                         @endif
                        
                        
                       <a href={{route('slider.edit',['slider'=>$slider->id])}} class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a> 
                        <form
                        action="{{route('slider.destroy',['slider'=>$slider->id])}}"
                        method="post">
                            @csrf
                            @method('DELETE')
                             <button class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></button> 
                              
                        </form>
                      </td>
                    </tr>   
                    @empty
                        <p>Sliders not available</p>
                    @endforelse
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Description one</th>
                    <th>Description Two</th>
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

@include('admin.layouts.footer.sliders.index')
<script>
$(document).on("click", "#delete", function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    bootbox.confirm("Do you really want to delete this element ?", function(confirmed){
      if (confirmed){
          window.location.href = link;
        };
      });
    });

  

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