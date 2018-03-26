<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"includes/ajax.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.pickup_schedule_message').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#content').val() != '' && $('#full_name').val() != '' && $('#street').val() != '' && $('#district').val() != '' && $('#mobile_phone').val() != '' && $('#email').val() != '' && $('#laundry_quantity').val() != '' && $('#pickup_date').val() != '' && $('#delivery_date').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"includes/ajax.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
     alert("Message Sent Succesfully!");
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
 $(document).on('click', '.pickup_schedule_message', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>