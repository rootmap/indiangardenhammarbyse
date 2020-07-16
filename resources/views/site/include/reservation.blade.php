
  <div class="book-now-wrapper">
    <p class="toggle">{{ $social->book_table_button_content }}</p>
    <div class="book-now ">  
      <div class="book-form">
        <p>free & instant online restaurant reservations</p>
        <form  action="{{url('reservation/request')}}" method="post"  enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="col-xs-12 col-sm-12">
            <input class="form-control" type="text" name="name" placeholder="name">
          </div>
          <div class="col-xs-12 col-sm-12">
            <input id="email-sidebar" class="form-control" type="email" name="email" placeholder="E-mail">
          </div>
          <div class="col-xs-12 col-sm-12">
            <input id="phone-sidebar" class="form-control" type="text" name="phone" placeholder="Phone Number">
          </div>
          <div class="col-xs-12 col-sm-12">
            <input id="datepicker-sidebar" class="form-control" type="text" name="reservations_date"  placeholder="date">
          </div>
          <div class="col-xs-12 col-sm-12">
                <select name="reservations_time" class="form-control form-control-lg">
                  <option value="">Select Date First</option>
                </select>
          
          </div>
          <div class="col-xs-3 col-sm-3"><button type="button" class="form-control btn btn-block minusMorePerson"><i style="color: #000;" class="fa fa-minus"></i></button></div>
          <div class="col-xs-6 col-sm-6"><input class="form-control"  type="number" id="personPopAreaIn" name="person" placeholder="0 Person"></div>
          <div class="col-xs-3 col-sm-3"><button type="button" class="form-control btn btn-block addMorePerson"><i style="color: #000;" class="fa fa-plus"></i></button></div>
          <div class="col-xs-12 col-sm-12">

           <!-- <input class="form-control" type="text" name="person-no" placeholder="number of person"> 
            <select name="person" class="form-control form-control-lg">
                    <option value="">Select person</option>
                    <option value="1 person">1 person</option>
                    <option value="2 person">2 person</option>
                    <option value="3 person">3 person</option>
                    <option value="4 person">4 person</option>
                    <option value="5 person">5 person</option>
                    <option value="6 person">6 person</option>
                  </select> -->
          </div>
          <input type="hidden" name="reservations_status" value="Pending">
          <div class="col-xs-12 col-sm-12">
            <textarea class="form-control" rows="3" name="message" placeholder="message &amp; special request"></textarea>
          </div>
          <div class="form-group col-xs-12">
                <div id="sidebar_mail_success" class="success" style="display:none;">Your message has been sent successfully. </div>
                <div id="sidebar_mail_fail" class="error" style="display:none;"> Sorry, error occured this time sending your message. </div>
          </div>
          <div class="col-xs-12 col-sm-12">
            <button  class="btn" type="submit">make a reservation</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--===| Right Fixed Booking Form End|===