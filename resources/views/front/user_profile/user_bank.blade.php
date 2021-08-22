@extends('theme.master')
@section('title', 'Profile & Setting')
@section('content')

@include('admin.message')

<!-- about-home start -->
<section id="blog-home" class="blog-home-main-block">
    <div class="container">
        <h1 class="blog-home-heading text-white">{{ __('frontstaticword.BankDetails') }}</h1>
    </div>
</section> 
<!-- profile update start -->
<section id="profile-item" class="profile-item-block">
    <div class="container">

        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="dashboard-author-block text-center">
                    <div class="author-image">
					    <div class="avatar-upload">
					        <div class="avatar-preview">
					        	@if(Auth::User()->user_img != null || Auth::User()->user_img !='')
						            <div class="avatar-preview-img" id="imagePreview" style="background-image: url({{ url('/images/user_img/'.Auth::User()->user_img) }});">
						            </div>
						        @else
						        	<div class="avatar-preview-img" id="imagePreview" style="background-image: url({{ asset('images/default/user.jpg')}});">
						            </div>
						        @endif
					        </div>
					    </div>
                    </div>
                    <div class="author-name">{{ Auth::User()->fname }}&nbsp;{{ Auth::User()->lname }}</div>
                </div>
                <div class="dashboard-items">
                    <ul>
                        <li><i class="fa fa-bookmark"></i><a href="{{ route('mycourse.show') }}" title="Dashboard">{{ __('frontstaticword.MyCourses') }}</a></li>
                        <li><i class="fa fa-heart"></i><a href="{{ route('wishlist.show') }}" title="Profile Update">{{ __('frontstaticword.MyWishlist') }}</a></li>
                        <li><i class="fa fa-history"></i><a href="{{ route('purchase.show') }}" title="Followers">{{ __('frontstaticword.PurchaseHistory') }}</a></li>
                        <li><i class="fa fa-user"></i><a href="{{route('profile.show',Auth::User()->id)}}" title="Upload Items">{{ __('frontstaticword.UserProfile') }}</a></li>
                        @if(Auth::User()->role == "user")
                        <li><i class="fas fa-chalkboard-teacher"></i><a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">

                <div class="profile-info-block user-bank-button">


                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalBank">{{ __('frontstaticword.AddBank') }}
                                        </button>


                  <div class="modal fade" id="myModalBank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">

                          <h4 class="modal-title" id="myModalLabel">{{ __('frontstaticword.AddBankDetails') }}</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="box box-primary">
                          <div class="panel panel-sum">
                            <div class="modal-body">

                              <form  method="post" action="{{url('bankdetail/')}}" data-parsley-validate class="form-horizontal form-label-left">
                                  {{ csrf_field() }} 



                                  <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="account_holder_name">Account Holder Name:<sup class="redstar">*</sup></label>
                                        <input type="text" class="form-control" name="account_holder_name" id="title" placeholder="Please Enter Acc. Holder Name"  required>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="bank_name">Bank Name:<sup class="redstar">*</sup></label>
                                        <input type="text" class="form-control" name="bank_name" id="title" placeholder="Please Enter Bank Name"  required>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="account_number">Account Number:<sup class="redstar">*</sup></label>
                                        <input type="text" class="form-control" name="account_number" id="title" placeholder="Please Enter Account Number"  required>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="ifcs_code">IFSC Code:<sup class="redstar">*</sup></label>
                                        <input type="text" class="form-control" name="ifcs_code" id="title" placeholder="Please Enter IFSC Code"  required>
                                      </div>
                                    </div>
                                  </div>



                                  <div class="cancel-button" style="text-align:center">
                                  <button type="submit" class="btn btn-primary"> Add</button>
                                </div>
                              </form>
                             
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   
                </div>


                <div id="purchase-block" class="purchase-main-block user-bank-block">
                 
                    <div class="purchase-table table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="purchase-text">{{ __('frontstaticword.A/CHolderName') }}</th>
                            <th class="purchase-text">{{ __('frontstaticword.Bankname') }}</th>
                            <th class="purchase-text">{{ __('frontstaticword.A/CNo') }}</th>
                            <th class="purchase-text">{{ __('frontstaticword.IFSCCode') }}s</th>
                            <th class="purchase-text">{{ __('frontstaticword.Actions') }}</th>
                            
                          </tr>
                        </thead>
                          @foreach($banks as $bank)
                        
                            <div class="purchase-history-table">
                              <tbody>
                                <tr>
                                  <td>
                                    <div class="purchase-text"> {{ $bank['account_holder_name'] }}</div>                         
                                  </td>
                                  <td>
                                    <div class="purchase-text"> {{ $bank['bank_name'] }}</div>                         
                                  </td>
                                  <td>
                                    <div class="purchase-text"> {{ $bank['account_number'] }}</div>                         
                                  </td>
                                  <td>
                                    <div class="purchase-text"> {{ $bank['ifcs_code'] }}</div>                         
                                  </td>
                                     
                                  <td>
                                    <div class="invoice-btn">
                                      <a type="button" href="{{route('invoice.show',$bank->id)}}"  class="btn btn-secondary" data-toggle="modal" data-target="#myModalBankEdit{{ $bank->id }}">{{ __('frontstaticword.Edit') }}</a>


                                   

                                      <div class="modal fade" id="myModalBankEdit{{ $bank->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">

                                              <h4 class="modal-title" id="myModalLabel">{{ __('frontstaticword.EditBankDetails') }}</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="box box-primary">
                                              <div class="panel panel-sum">
                                                <div class="modal-body">

                                                  <form  method="post" action="{{route('bankdetail.update',$bank->id)}}" data-parsley-validate class="form-horizontal form-label-left">
                                                      {{ csrf_field() }} 
                                                      {{ method_field('PUT') }}



                                                      <input type="hidden" name="user_id"  value="{{Auth::User()->id}}" />

                                                      <div class="row">
                                                        <div class="col-md-6">
                                                          <div class="form-group">
                                                            <label for="account_holder_name">Account Holder Name:<sup class="redstar">*</sup></label>
                                                            <input type="text" class="form-control" name="account_holder_name" id="title" value="{{ $bank->account_holder_name  }}" placeholder="Please Enter Acc. Holder Name"  required>
                                                          </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                          <div class="form-group">
                                                            <label for="bank_name">Bank Name:<sup class="redstar">*</sup></label>
                                                            <input type="text" class="form-control" name="bank_name" id="title" value="{{ $bank->bank_name  }}" placeholder="Please Enter Bank Name"  required>
                                                          </div>
                                                        </div>
                                                      </div>

                                                      <div class="row">
                                                        <div class="col-md-6">
                                                          <div class="form-group">
                                                            <label for="account_number">Account Number:<sup class="redstar">*</sup></label>
                                                            <input type="text" class="form-control" name="account_number" id="title" value="{{ $bank->account_number  }}" placeholder="Please Enter Account Number"  required>
                                                          </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                          <div class="form-group">
                                                            <label for="ifcs_code">IFSC Code:<sup class="redstar">*</sup></label>
                                                            <input type="text" class="form-control" name="ifcs_code" id="title" value="{{ $bank->ifcs_code  }}" placeholder="Please Enter IFSC Code"  required>
                                                          </div>
                                                        </div>
                                                      </div>



                                                      <div class="cancel-button">
                                                      <button type="submit" class="btn btn-primary"> Edit</button>
                                                    </div>
                                                  </form>
                                                 
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>


                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </div>

                          @endforeach
                      </table>
                    </div>
                  
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- profile update end -->
@endsection

@section('custom-script')

<script>
(function($) {
  "use strict";
	tinymce.init({selector:'textarea#detail'});
})(jQuery);
</script>

@endsection
