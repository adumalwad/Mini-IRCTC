 $(document).ready(function() 
      {
        $("#show_hide_password a").on('click', function(event)
        {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text")
            {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-lock text-dark" );
                $('#show_hide_password i').removeClass( "fa-unlock text-dark" );
            }
            else if($('#show_hide_password input').attr("type") == "password")
            {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-lock text-dark" );
                $('#show_hide_password i').addClass( "fa-unlock text-dark" );
            }
        });
    });