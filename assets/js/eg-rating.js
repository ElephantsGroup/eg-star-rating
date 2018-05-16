var post_rate = function (addr, token, in_service_id, in_item_id, rate) {
    $.ajax({
        url: addr,
        method: "POST",
        data: {
            item_id: in_item_id,
            service_id: in_service_id,
            rating: rate,
            _frontendCsrf: token
        }
    })
    .done(function (response)
    {
        response_array = JSON.parse(response);
        if(response_array['status'] == 200) {
            $.notify(
                {
                    message: response_array['message'],
                    icon: 'glyphicon glyphicon glyphicon-ok-circle'
                },
                {
                    type: 'success',
                    allow_dismiss: false,
                    placement: {
                        from: "bottom",
                        align: "right"
                    }
                }
            );
        }
        else
            $.notify({ message: response_array['message']},{type: 'warning'});
    })
    .fail(function( req, status, err )
    {
        console.log('like error', req, status, err);
    })
}
