@extends('site.layout.master')
@section('title','Reservation')
@section('content')
<section class="events cl-block">
    <div class="container  header-block">
      <div class="row justify-content-center">
        <div class="common_layout_title">
          <h2>{{$reservation->page_name}}</h2>
        </div>
      </div>
    </div>
    <!-- Common Layout Hero -->
    <div class="cl-hero" data-parallax="scroll" style="background-image: url({{ url('upload/reservation/'.$reservation->fore_ground_image) }}); background-size: cover;">
    <div class="container">
      <div class="row">

        @if (\Session::has('success'))
        <script type="text/javascript">
          Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Your message has been sent successfully',
            showConfirmButton: false,
            timer: 5000
          })
        </script>
          
      @endif
        <div class="col-md-5 col-md-offset-6">
          <div class="hero-inner-block" style="padding: 35px 60px;">
              <h2>{{$reservation->reservation_form_title}}</h2>
              <form action="{{url('reservation/request')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                  <input id="name" name="name" class="form-control form-control-lg" type="text" placeholder="Enter your name">
                </div>
                <div class="form-group">
                  <input id="email" name="email" class="form-control form-control-lg" type="email" placeholder="Enter your email address">
                </div>
                <div class="form-group">
                  <input id="phone" name="phone" class="form-control form-control-lg" type="text" placeholder="Enter your phone number">
                </div>
                <div class="form-group">
                  <input id="datepicker" class="form-control form-control-lg" name="reservations_date" type="text" placeholder="Select Date">
                </div>
                <div class="form-group">
                  <select name="reservations_time"  class="form-control form-control-lg">
                    <option value="">Select Date First</option>
                  </select>
                </div>
                <input type="hidden" name="reservations_status" value="Pending">

                <div class="col-xs-2 col-sm-2 mb-1" style="padding-left: 0;">
                  <button type="button" class="form-control btn btn-block minusMorePersonres" style="padding: 0;">
                    <i  class="fa fa-minus"></i>
                  </button>
                </div>
                <div class="col-xs-4 col-sm-4">
                  <input class="form-control"  type="number" id="respersonPopAreaIn" name="person" value="1" placeholder="0">
                </div>
                <div class="col-xs-2 col-sm-2" style="padding-left: 0;">
                  <button type="button" class="form-control btn btn-block addMorePersonres" style="padding: 0;">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
                <div class="col-xs-4 col-sm-4" style="padding-right: 0;">
                    <input class="form-control" style="background: none;
    border: 0px;
    box-shadow: none;" disabled="disabled"  type="number" value="Person" placeholder="Person">
                </div>
                
                <div class="form-group">
                  <button class="btn btn-block btn-form">{{$reservation->reservation_button_title}}</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
    <!-- /Common Layout Hero -->
  </section>
<section class="section-padding contact-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="form-wrapper">
        <h2>{{$reservation->contact_form_title}}</h2>
        <form id='contact_form' name="enqueryForm" method="post" action="{{ url('contact/request') }}">
          {{csrf_field()}}
            <div class="row">
              <div class="col-xs-12 col-sm-12">
                <input type="text" class="form-control" name="name" placeholder="name">
              </div>
              
              <div class="col-xs-12 col-sm-12">
                <input id="email" type="email" class="form-control" name="email" placeholder="e-mail">
              </div>
              <div class="col-xs-12 col-sm-12">
                <input type="text" class="form-control" name="subject" placeholder="subject">
              </div>
              <div class="col-xs-12 col-sm-12">
                <textarea id="message" class="form-control" rows="4" name="message" placeholder="message"></textarea>
              </div>
              
              <div class="col-xs-12 col-sm-12">
                <button class="btn" name="submit" type="submit">{{$reservation->contact_button_title}}</button>
                <input type="hidden" value="Unseen" name="contact_status" />
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <iframe
            src="{{$setting[0]->contact_map_source_url}}"
            width="100%" height="470" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
      </div>
    </div>
        <div class="address-wrapper">
          <div class="row">
            <div class="col-xs-12 col-sm-4">
              <div class="left">
                <h3>location</h3>
                <p>{{$setting[0]->address}}</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-4">
              <div class="middle">
                <h3>table booking</h3>
                <p><a href="tel:{{$setting[0]->phone}}">{{$setting[0]->phone}}</a><br>
                  <a href="mailto:{{$setting[0]->email_address}}">{{$setting[0]->email_address}}</a></p>  
              </div>
            </div>
            <div class="col-xs-12 col-sm-4">
              <div class="right">
                <h3>get directions</h3>
                <p>{{$reservation->get_directions}}</p>  
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
@endsection
@section('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
@section('js')

<script type="text/javascript">
  
  
</script>

{{-- <script type="text/javascript">
  Swal.fire({
    position: 'top-center',
    icon: 'success',
    title: 'Your message has been sent successfully',
    showConfirmButton: false,
    timer: 2000
  })
</script> --}}
@endsection