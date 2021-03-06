function get (URL,auth_id,asset){
    $.ajax({
        url: URL,
        type: "GET",
        success: function(response) {
            // console.log("fetch", response);

            var data = response.sorted;
            var contents = "";
            var datalength = data.length
            
            $.each(data, function(i, r) {
                if (i == 0 || r.created_at.toString().slice(0, 10) != data[i - 1].created_at.toString().slice(0, 10)) {
                    contents += `
                        <div class="row my-1">
                            <div class="col"></div>
                                <div class="text-center text-white-50 p1 rounded p-1 bg-dark">
                                    ${moment(r.created_at).format('D MMMM YYYY')}
                                </div>
                            <div class="col"></div>
                        </div>
                        `
                }
                if (r.user_id == auth_id) {
                    contents += `
                        <div class="row m-2">
                            <div class="col"></div>
                            <div class="col-auto bg-success p-2" style="border-radius: 10px">
                        `
                    if (r.picture.length != 0) {
                        contents += `
                                <div style="height:200px;">
                                    <img src="${asset}/${r.picture}" class="h-100">
                                </div>
                            `
                    }
                        contents+=`
                                <p class = "text-dark">${r.chat}</p> 
                                <small class ="text-muted float-right" >${moment(r.created_at).format('HH:mm')} </small>
                            </div>
                        </div>
                        `
                } 
                else {
                    contents+=`
                        <div class="row m-2">
                            <div class="col-auto bg-info p-2" style="border-radius: 10px">
                            `
                    if (r.picture != ''){
                        contents+=`
                                <div style="height:200px;">
                                    <img src="${asset}/${r.picture}" class="h-100">
                                </div>`
                    }
                        contents+=`
                                <p> ${r.chat} </p>
                                <small class="text-white-50 float-right">${moment(r.created_at).format('HH:MM')} </small>
                            </div>
                            <div class="col"></div>
                        </div>
                        `
                }
                
            })
            // contents+=data;
            $(".conversation").html(contents);
            
            var overflow = $('#conversation');

            $('#chat_container').scrollTop(overflow[0].scrollHeight);

        },
        error: function(error) {
            console.log("error", error.responseJSON.errors);
        }
    });  
}