<section class="content">
 
  <div class="row">
    <div class="col-md-12">
      <a data-toggle="modal" data-target="#myModalab" href="#" class="btn btn-info btn-sm">+ {{ __('adminstaticword.Add') }}</a>
      <br>
      <br>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped db">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('adminstaticword.CourseChapter') }}</th>
              <th>{{ __('adminstaticword.Title') }}</th>
              <th>{{ __('adminstaticword.Status') }}</th>
              <th>{{ __('adminstaticword.Featured') }}</th>
              <th>{{ __('adminstaticword.Edit') }}</th>
              <th>{{ __('adminstaticword.Delete') }}</th>
            </tr>
          </thead>
          <tbody id="sortable">
            <?php $i=0;?>
            @foreach($courseclass as $cat)
              <tr class="sortable row1" data-id="{{ $cat->id }}">
                <?php $i++;?>
                <td><?php echo $i;?></td>
                @php
                $chname = App\CourseChapter::where('id','=',$cat->coursechapter_id)->get();
                @endphp
                <td>
                  @foreach($chname as $cc)
                  {{ $cc->chapter_name }}
                  @endforeach
                </td>
                <td>{{$cat->title}}</td>
                <td>
                  @if($cat->status==1)
                   {{ __('adminstaticword.Active') }}
                  @else
                   {{ __('adminstaticword.Deactive') }}
                  @endif
                </td>
                <td>
                  @if($cat->featured==1)
                    {{ __('adminstaticword.Yes') }}
                  @else
                    {{ __('adminstaticword.No') }}
                  @endif
                </td>
                <td>
                  <a class="btn btn-success btn-sm" href="{{url('courseclass/'.$cat->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
                </td> 
                <td>
                  <form  method="post" action="{{url('courseclass/'.$cat->id)}}"data-parsley-validate class="form-horizontal form-label-left">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
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
  <div class="modal fade" id="myModalab" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">{{ __('adminstaticword.Add') }} {{ __('adminstaticword.CourseClass') }}</h4>
        </div>
        <div class="box box-primary">
          <div class="panel panel-sum">
            <div class="modal-body">
              <form enctype="multipart/form-data" id="demo-form2" method="post" action="{{ route('courseclass.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                {{ csrf_field() }}
                          

                <select class="display-none" name="course_id" class="form-control">
                  <option value="{{ $cor->id }}">{{ $cor->title }}</option>
                </select>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.ChapterName') }}:<sup class="redstar">*</sup></label>
                    <select name="course_chapters" class="form-control col-md-7 col-xs-12 js-example-basic-single" required>
                      @foreach($coursechapters as $c)
                      <option value="{{ $c->id }}">{{ $c->chapter_name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <br>

                




                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Title') }}:<sup class="redstar">*</sup></label>
                    <input type="text" class="form-control " name="title" id="exampleInputTitle"   placeholder="Enter Your Title"value="" required>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-12">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Detail') }}:</label>
                    <textarea id="detail2" name="detail" rows="3" class="form-control"></textarea>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-12 btm-20">
                    <label for="type">{{ __('adminstaticword.Type') }}:<sup class="redstar">*</sup></label>
                    <select name="type" id="filetype" class="form-control js-example-basic-single" required>
                      <option>{{ __('adminstaticword.ChooseFileType') }}</option>
                      <option value="video">{{ __('adminstaticword.Video') }}</option>
                      <option value="audio">{{ __('adminstaticword.Audio') }}</option>
                      <option value="image">{{ __('adminstaticword.Image') }}</option>
                      <option value="zip">{{ __('adminstaticword.Zip') }}</option>
                      <option value="pdf">{{ __('adminstaticword.Pdf') }}</option>
                    </select>
                  </div>
                  <br>



                  <!--for audio -->
                  <div class="col-md-12 display-none btm-20" id="audioChoose">
                    <input type="radio" name="checkAudio" id="ch11" value="audiourl"> {{ __('adminstaticword.URL') }}
                    <input type="radio" name="checkAudio" id="ch12" value="uploadaudio"> {{ __('adminstaticword.UploadAudio') }}
                  </div>
                  
                  <div class="col-md-12 display-none" id="audioURL">
                    <label for="">{{ __('adminstaticword.URL') }}: </label>
                    <input type="text" name="audiourl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="audioUpload">
                    <label for="">{{ __('adminstaticword.UploadAudio') }}: </label>
                    <input type="file" name="audioupload" class="form-control">
                  </div>



                  <!--for image -->
                  <div class="col-md-12 display-none" id="imageChoose">
                    <input type="radio" name="checkImage" id="ch3" value="url"> {{ __('adminstaticword.URL') }}
                    <input type="radio" name="checkImage" id="ch4" value="uploadimage"> {{ __('adminstaticword.UploadImage') }}
                  </div>
                  
                  <div class="col-md-12 display-none" id="imageURL">
                    <label for="">{{ __('adminstaticword.URL') }}: </label>
                    <input type="text" name="imgurl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="imageUpload">
                    <label for="">{{ __('adminstaticword.UploadImage') }}: </label>
                    <input type="file" name="image" class="form-control">
                  </div>
                  <br>





                  <!--video-->
                  <div class="col-md-12 display-none btm-20" id="videotype">
                    <input type="radio" name="checkVideo" id="ch1" value="url">&nbsp;{{ __('adminstaticword.URL') }}
                    &emsp;
                    <input type="radio" name="checkVideo" id="ch2" value="uploadvideo">&nbsp;{{ __('adminstaticword.UploadVideo') }}
                    &emsp;
                    <input type="radio" name="checkVideo" id="ch9" value="iframeurl">&nbsp;{{ __('adminstaticword.IframeURL') }}
                    &emsp;
                    <input type="radio" name="checkVideo" id="ch10" value="liveurl">&nbsp;{{ __('adminstaticword.LiveClass') }}
                    &emsp;
                    
                    @if($gsetting->aws_enable == 1)
                    <input type="radio" name="checkVideo" id="ch13" value="aws_upload">&nbsp;{{ __('adminstaticword.AWSUpload') }}
                    @endif

                    @if($gsetting->youtube_enable == 1)
                    <input type="radio" name="checkVideo" id="youtubeurl" value="youtube">&nbsp;{{ __('Youtube API') }}
                    &emsp;
                    @endif

                    @if($gsetting->vimeo_enable == 1)
                    <input type="radio" name="checkVideo" id="vimeourl" value="vimeo">&nbsp;{{ __('Vimeo API') }}
                    &emsp;
                    @endif

                     <br>
                  </div>



                  

                  <div class="col-md-12 display-none" id="videoURL">
                    <label for="">{{ __('adminstaticword.URL') }}: </label>
                    <input type="text" id="apiUrl" name="vidurl"  placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="videoUpload">
                    <label for="">{{ __('adminstaticword.UploadVideo') }}: </label>
                    <input type="file" name="video_upld" class="form-control">
                  


                  </div>

                  <div class="col-md-12 display-none" id="iframeURLBox">
                    <label for="">{{ __('adminstaticword.IframeURL') }}: </label>
                    <input type="text" name="iframe_url"  placeholder="Enter Your Iframe URL" class="form-control">
                  </div>
                  

                  <div class="col-md-12 display-none" id="liveclassBox">
                    <label for="appt">Select a Date & Time:</label>
                    <input type="datetime-local" id="date_time" name="date_time" class="form-control">
                  </div>
                  
                  <!-- aws insert -->
                  @if($gsetting->aws_enable == 1)
                  <div class="col-md-12 display-none" id="awsBox">
                    <label for="appt">{{ __('adminstaticword.AWSUpload') }}</label>
                    <input type="file" name="aws_upload" class="form-control">
                  </div>
                  @endif


                  <!-- zip -->
                  <div class="col-md-12 display-none btm-20" id="zipChoose">
                    <input type="radio" value="zipURLEnable" name="checkZip" id="ch5"> {{ __('adminstaticword.URL') }}
                    <input type="radio" value="zipEnable" name="checkZip" id="ch6"> {{ __('adminstaticword.UploadZip') }}
                  </div>
                  
                  <div class="col-md-12 display-none" id="zipURL">
                    <label for="">{{ __('adminstaticword.URL') }}: </label>
                    <input type="text" name="zipurl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="zipUpload">
                    <label for="">{{ __('adminstaticword.UploadZip') }}: </label>
                    <input type="file" name="uplzip" class="form-control">
                  </div>


                  <!-- pdf -->
                  <div class="col-md-12 display-none btm-20" id="pdfChoose">
                    <input type="radio" value="pdfURLEnable" name="checkPdf" id="ch7"> {{ __('adminstaticword.URL') }}
                    <input type="radio" value="pdfEnable" name="checkPdf" id="ch8"> {{ __('adminstaticword.UploadPdf') }}
                  </div>
                  
                  <div class="col-md-12 display-none" id="pdfURL">
                    <label for=""> {{ __('adminstaticword.URL') }}: </label>
                    <input type="text" name="pdfurl" placeholder="Enter Your URL" class="form-control">
                  </div>

                  <div class="col-md-12 display-none" id="pdfUpload">
                    <label for=""> {{ __('adminstaticword.UploadPdf') }}: </label>
                    <input type="file" name="pdf" class="form-control">
                  </div>
                  <br>


                  <div class="col-md-12 display-none" id="duration_video">
                    <label for=""> {{ __('adminstaticword.Duration') }}:</label>
                    <input type="text" name="duration" placeholder="Enter class duration in (mins) Eg:160" class="form-control">
                  </div>
                  <br> 

                  <div class="col-md-12 display-none" id="size">
                    <label for="">{{ __('adminstaticword.Size') }}:</label>
                    <input type="text" name="size" placeholder="Enter Your Size" class="form-control">
                  </div>
                </div>
                <br>

               
                <!-- preview video -->
                <div class="row"> 
                  <div class="col-md-12 display-none" id="previewUrl">
                    <label for="exampleInputDetails">{{ __('adminstaticword.PreviewVideo') }}:</label>
                    <li class="tg-list-item">              
                      <input name="preview_type" class="tgl tgl-skewed" id="previewvid" type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="URL" data-tg-on="Upload" for="previewvid"></label>                
                    </li>
                    <input type="hidden" name="free" value="0" id="cxv">
                 
                    <div class="display-none" id="document11">
                      <label for="exampleInputSlug">Preview {{ __('adminstaticword.UploadVideo') }}:</label>
                      <input type="file" name="video" id="video" value="" class="form-control">
                    </div> 
                    <div id="document22">
                      <label for="">Preview {{ __('adminstaticword.URL') }}: </label>
                      <input type="text" name="url" id="url"  placeholder="Enter Your URL" class="form-control" >
                    </div>
                  </div>
                </div>
                </br>
                <!-- end preview video -->

                <div class="row"> 
                  <div class="col-md-6">
                  
                      <label for="exampleInputDetails">{{ __('adminstaticword.LearningMaterial') }}</label> - <p class="inline info">eg: zip or pdf files</p>
                      <br>
                      <input type="file" name="file" id="file3" class="{{ $errors->has('file') ? ' is-invalid' : '' }} inputfile inputfile-1"/>
                      <label for="file3"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>{{ __('adminstaticword.Chooseafile') }}</span></label>
                      <span class="text-danger invalid-feedback" role="alert"></span>
                    
                  </div>
                </div>

                <br>


                <div class="row">  
                  <div class="col-md-4">    
                    <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                    <li class="tg-list-item">
                      <input name="status" class="tgl tgl-skewed" id="sec_one1" type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="sec_one1"></label>
                    </li>
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputDetails">{{ __('adminstaticword.Featured') }}:</label>    
                    <li class="tg-list-item">
                      <input name="featured" class="tgl tgl-skewed" id="sec_one2" type="checkbox"/>
                      <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="sec_one2"></label>
                    </li>
                  </div>
                </div> 
                <br>
                <br>
               
                <div id="subtitle" class="display-none">
                  <label>{{ __('adminstaticword.Subtitle') }}:</label>
                  <table class="table table-bordered" id="dynamic_field">  
                    <tr> 
                        <td>
                           <div class="{{ $errors->has('sub_t') ? ' has-error' : '' }} input-file-block">
                            <input type="file" name="sub_t[]"/>
                            <p class="info">Choose subtitle file ex. subtitle.srt, or. txt</p>
                            <small class="text-danger">{{ $errors->first('sub_t') }}</small>
                          </div>
                        </td>

                        <td>
                          <input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" />
                        </td>  
                        <td><button type="button" name="add" id="add" class="btn btn-xs btn-success">
                          <i class="fa fa-plus"></i>
                        </button></td>  
                    </tr>  
                  </table>
                </div>


                @if($cor->drip_enable == 1)
                <hr>
                
                <div class="row"> 
                  <div class="col-md-6">
                    <label  for="married_status">{{ __('Drip Content Type') }}: </label>
                    <select class="form-control js-example-basic-single" id="drip_type2" name="drip_type">
                      <option value="" selected hidden> 
                        {{ __('Select an Option ') }}
                      </option>
                      <option value="date">{{ __('Specific Date') }}</option>
                      <option value="days">{{ __('Days After Enrollment') }}</option>
                    </select>
                    <br>
                  </div>

                  <div class="col-md-6" style="display: none;" id="dripdate2">
                    <label>{{ __('Specific Date') }} :</label>
                    <input type="text" id="date_specific4" class="form-control"  name="drip_date">
                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('When section should be unlock') }}.</small>
                  </div>

                  <div class="col-md-6" style="display: none;" id="dripdays2">
                    <label>{{ __('Days After Enrollment') }} :</label>
                    <input type="number" min="1" class="form-control" value="{{ old('drip_days') }}" name="drip_days">
                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __('Enter days') }}.</small>
                  </div>
                </div>
                <br>

                @endif
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



  <!--youtube API Modal -->
  <div id="myyoutubeModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!--youtube API Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h1 class="modal-title">Search From Youtube API</h1>
        </div>
        <div class="modal-body">
          @if(is_null(env('YOUTUBE_API_KEY')))
          <p>Make Sure You Have Added Youtube API Key in <a href="{{url('admin/api-settings')}}">API Settings</a></p>
          @endif
         
            <div id="hyv-page-container" style="clear:both;">
                  <div class="hyv-content-alignment">
                      <div id="hyv-page-content" class="" style="overflow:hidden;">
                          <div class="container-4">
                              <form action="" method="post" name="hyv-yt-search" id="hyv-yt-search">
                                  <input type="search" name="hyv-search" id="hyv-search" placeholder="Search..." class="ui-autocomplete-input" autocomplete="off">
                                  <button class="icon" id="hyv-searchBtn"></button>
                              </form>
                          </div>
                          <div>
                              <input type="hidden" id="pageToken" value="">
                              <div class="btn-group" role="group" aria-label="...">
                                <button type="button" id="pageTokenPrev" value="" class="btn btn-default">Prev</button>
                                <button type="button" id="pageTokenNext" value="" class="btn btn-default">Next</button>
                              </div>
                          </div>
                          <div id="hyv-watch-content" class="hyv-watch-main-col hyv-card hyv-card-has-padding">
                              <ul id="hyv-watch-related" class="hyv-video-list">
                              </ul>
                          </div>

                      </div>
                  </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div> 


  <!--vimeo API Modal -->
<div id="myvimeoModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!--vimeo API Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1 class="modal-title">Search From Vimeo API</h1>
      </div>
      <div class="modal-body">
        @if(is_null(env('VIMEO_ACCESS')))
        <p>Make Sure You Have Added Vimeo API Key in <a href="{{url('admin/api-settings')}}">API Settings</a></p>
        @endif
       
          <div id="vimeo-page-container" style="clear:both;">
                <div class="vimeo-content-alignment">
                    <div id="vimeo-page-content" class="" style="overflow:hidden;">
                        <div class="container-4">
                            <form action="" method="post" name="vimeo-yt-search" id="vimeo-yt-search">
                                <input type="search" name="vimeo-search" id="vimeo-search" placeholder="Search..." class="ui-autocomplete-input" autocomplete="off">
                                <button class="icon" id="vimeo-searchBtn"></button>
                            </form>
                        </div>
                        <div>
                            <input type="hidden" id="vpageToken" value="">
                            <div class="btn-group" role="group" aria-label="...">
                              <button type="button" id="vpageTokenPrev" value="" class="btn btn-default">Prev</button>
                              <button type="button" id="vpageTokenNext" value="" class="btn btn-default">Next</button>
                            </div>
                        </div>
                        <div id="vimeo-watch-content" class="vimeo-watch-main-col vimeo-card vimeo-card-has-padding">
                            <ul id="vimeo-watch-related" class="vimeo-video-list">
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




</section> 

 

@section('script')
<!--courseclass.js is included -->

<script type="text/javascript">
 $('#previewvid').on('change',function(){

  if($('#previewvid').is(':checked')){
    $('#document11').show('fast');
    $('#document22').hide('fast');
  }else{
    $('#document22').show('fast');
    $('#document11').hide('fast');
  }

});

</script>

<script>
    
    $( "#sortable" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
          sendOrderToServer();
      }
    });

    function sendOrderToServer() {

      var order = [];
      var token = $('meta[name="csrf-token"]').attr('content');
      $('tr.row1').each(function(index,element) {
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });

      $.ajax({
        type: "POST", 
        dataType: "json", 
        url: "{{ route('class-sort') }}",
        data: {
           order: order,
          _token: "{{ csrf_token() }}",
        },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
        }
      });
    }
</script>



@endsection

@section('stylesheets')

<style type="text/css">
.modal {
  overflow-y:auto;
}


 body{
      background-color: #efefef;
  }
  .container-4 input#hyv-search {
      width: 500px;
      height: 30px;
      border: 1px solid #c6c6c6;
      font-size: 10pt;
      float: left;
      padding-left: 15px;
      -webkit-border-top-left-radius: 5px;
      -webkit-border-bottom-left-radius: 5px;
      -moz-border-top-left-radius: 5px;
      -moz-border-bottom-left-radius: 5px;
      border-top-left-radius: 5px;
      border-bottom-left-radius: 5px;
  }
    .container-4 input#vimeo-search {
      width: 500px;
      height: 30px;
      border: 1px solid #c6c6c6;
      font-size: 10pt;
      float: left;
      padding-left: 15px;
      -webkit-border-top-left-radius: 5px;
      -webkit-border-bottom-left-radius: 5px;
      -moz-border-top-left-radius: 5px;
      -moz-border-bottom-left-radius: 5px;
      border-top-left-radius: 5px;
      border-bottom-left-radius: 5px;
  }
  .container-4 button.icon {
      height: 34px;
      background: #F0F0EF url(../../images/icons/searchicon.png) 10px 1px no-repeat;
      background-size: 24px;
      -webkit-border-top-right-radius: 5px;
      -webkit-border-bottom-right-radius: 5px;
      -moz-border-radius-topright: 5px;
      -moz-border-radius-bottomright: 5px;
      border-top-right-radius: 5px;
      border-bottom-right-radius: 5px;
      border: 1px solid #c6c6c6;
      width: 50px;
      margin-left: -44px;
      color: #4f5b66;
      font-size: 10pt;
  }

  button#pageTokenNext {
    margin-left: 5px;
    border-radius: 3px;
    margin-bottom: 20px;
  }

  button#vpageTokenNext {
    margin-left: 5px;
    border-radius: 3px;
    margin-bottom: 20px;
  }



</style>



@endsection
