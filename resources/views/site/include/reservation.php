<!--===| Right Fixed Booking Form Start|===-->
  <div class="book-now-wrapper">
    <p class="toggle">book a table now</p>
    <div class="book-now ">  
      <div class="book-form">
        <p>free & instant online restaurant reservations</p>
        <form id="sidebar_form" action="php/reservation.php" method="post" name="sidebarForm">
          <div class="col-xs-12 col-sm-12">
            <input class="form-control" type="text" name="name" placeholder="name">
          </div>
          <div class="col-xs-12 col-sm-12">
            <input id="email-sidebar" class="form-control" type="email" name="email" placeholder="E-mail">
          </div>
          <div class="col-xs-12 col-sm-12">
            <input id="datepicker-sidebar" class="form-control" type="text" name="date"  placeholder="date">
          </div>
          <div class="col-xs-12 col-sm-12">
            <input class="form-control" type="text" name="person-no" placeholder="number of person">
          </div>
          <div class="col-xs-12 col-sm-12">
            <textarea class="form-control" rows="3" name="message" placeholder="message &amp; special request"></textarea>
          </div>
          <div class="form-group col-xs-12">
                <div id="sidebar_mail_success" class="success" style="display:none;">Your message has been sent successfully. </div>
                <div id="sidebar_mail_fail" class="error" style="display:none;"> Sorry, error occured this time sending your message. </div>
          </div>
          <div class="col-xs-12 col-sm-12">
            <button id="send-message-sidebar" class="btn" type="submit">make a reservation</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--===| Right Fixed Booking Form End|===-->