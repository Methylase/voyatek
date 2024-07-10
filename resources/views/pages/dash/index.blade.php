@extends('layouts.dash')
  @section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

            <!-- Number Of Users -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Number Of Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800 number_of_users">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Number Of Locked Users -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number Of Lock Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800 number_of_locked_users">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Number Of Blog Post -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Number Of Blog Post</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800 number_of_blog_post">0</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Number Of Deleted Post -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Number Of Deleted Post</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 number_of_deleted_post">0</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold"> All Blog Post </h6>
              <div class="float-right text-default" id="blogPostsToggle"><i class="fas fa-plus" id="close"></i></div>
            </div>
            <div class="card-body" id="blog-posts-body">
              <div class="text-right">
                <a href="{{route('create-post')}}" class="btn btn-sm btn-warning float-right mb-3">Create Blog Post</a>
              </div> 
              <div class="table-responsive">
                
                @if(isset($posts) && $posts != '')
                  <table class="table table-bordered border-bottom-info table-striped" id="dataTablePost"  style="width:100%" cellspacing="0">
                    
                    
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Link Title</th>
                          <th>Post Title</th>
                          <th>Post Description</th>
                          <th>Post Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                        @php $i=1
                        @endphp
                        <tbody>
                        @foreach($posts as $post)
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>{{ucfirst($post->link_post_title)}}</td>
                                  <td>{{ucfirst($post->post_title)}}</td>
                                  <td>{{ucfirst($post->post_description)}}</td>
                                  <td>{{date('d D F Y',strtotime($post->created_at))}}</td>
                                  <td>
                                    @can('update',$post) 
                                    <a href="{{route('post',$post->id)}}" class="btn btn-sm btn-info" title="Edit"><span class="fa fa-edit"></span></a> 
                                    @endcan
                                    @can('delete',$post)                                        
                                    <a href="" class="btn btn-sm btn-danger deletePost"  id='del {{$post->id}}' data-title="Delete" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash" title="Delete"></span></a>
                                    @endcan
                                  </td>  
                              </tr>
                            
                        @php $i++
                        @endphp
                        @endforeach
                  
                    </tbody>
                  </table>
                @else
                  <p class="text-center">No blog post found</p>
                @endif
                <!-- modal for delete post -->
                <div class="modal col-md-10 offset-md-2  col-sm-10 offset-sm-2 " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">                  
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                      <h4 class="modal-title text-info" id="Heading">Delete this post</h4>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-danger  format"><span class="fa fa-warning text-danger"></span> Are you sure you want to delete this post?</div>
                      </div>
                      <div class="modal-footer">
                        <button  class="btn btn-sm btn-info del_post"><span class="fa fa-check-circle"></span> Yes</button>
                        <button type="button" class="btn-sm btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span> No</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end of modal for delete post -->
              </div>                  
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
  @endsection
 