<section class="content">
 
<div class="row">
  <div class="col-md-12">
    <a data-toggle="modal" data-target="#myModalPaper" href="#" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }}</a>
    <br>
    <br>
    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('adminstaticword.Title') }}</th>
            <th>{{ __('adminstaticword.Detail') }}</th>
            <th>{{ __('adminstaticword.Status') }}</th>
            <th>{{ __('adminstaticword.Edit') }}</th>
            <th>{{ __('adminstaticword.Delete') }}</th>
          </tr>
        </thead>

        <tbody>
          <?php $i=0;?>
          @foreach($papers as $paper)
            <tr>
              <?php $i++;?>
              <td><?php echo $i;?></td>
              <td>{{$paper->title}}</td>
              <td>{{ strip_tags($paper->detail) }}</td> 
              <td>
                @if($paper->status==1)
                  {{ __('adminstaticword.Active') }}
                @else
                  {{ __('adminstaticword.Deactive') }}
                @endif
                
              </td>
              <td>
                  <a class="btn btn-success btn-sm" href="{{url('previous-paper/'.$paper->id)}}">
                    <i class="glyphicon glyphicon-pencil"></i></a>
              </td>              

              <td>
                <form  method="post" action="{{url('previous-paper/'.$paper->id)}}
                     "data-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button  type="submit"  class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i></button>
                </form>
              </td>

            </tr>
                   
          @endforeach
                   
                
        </tbody>
      </table>
    </div>
  </div>
</div>

<!--Model start-->
<div class="modal fade" id="myModalPaper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ __('adminstaticword.Add') }} {{ __('adminstaticword.PreviousPaper') }}</h4>
      </div>
       <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <form id="demo-form2" method="post" action="{{ route('previous-paper.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                {{ csrf_field() }}
     
                <select class="display-none" name="course_id" class="form-control">
                  <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                </select>

                <div class="row">
                  <div class="col-md-6">
                    <label for="">{{ __('adminstaticword.Title') }}:<sup class="redstar">*</sup></label>
                    <input type="text" name="title" class="form-control" autocomplete="off" required>
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:<sup class="redstar">*</sup></label>
                    <textarea rows="1" name="detail" class="form-control" placeholder="Enter Your Detail"></textarea>
                  </div>
                </div>
                <br>


                <div class="row">
                  <div class="col-md-6">
                  
                      <label for="exampleInputDetails">{{ __('adminstaticword.PaperUpload') }}</label> - <p class="inline info">eg: zip or pdf files</p>
                      <br>
                      <input type="file" name="file" id="file" class="{{ $errors->has('file') ? ' is-invalid' : '' }} inputfile inputfile-1"/>
                      <label for="file"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.Chooseafile') }}</span></label>
                      <span class="text-danger invalid-feedback" role="alert"></span>
                    
                  </div>
                </div>
                <br>

                <div class="col-md-6">
                  <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                  <li class="tg-list-item">              
                    <input class="tgl tgl-skewed" id="statuspaper" type="checkbox" name="status" >
                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="statuspaper"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="statuspaper" id="statuspaper">
                </div>
                <br>
                <br>
                <br>
                <div class="box-footer">
                  <button type="submit" class="btn btn-lg col-md-3 btn-primary">{{ __('adminstaticword.Submit') }}</button>
                </div>
               
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Model close -->    

</section>


