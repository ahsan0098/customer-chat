// $(document).on("click", "#dltbtn", function(e) {
            // e.preventDefault();
            // var id = $(this).closest('tr').find('.action_id').val();
            // // alert(id);
            // Swal.fire({
                // title: 'Are you sure?',
                // text: "You won't be able to revert this!",
                // icon: 'warning',
                // showCancelButton: true,
                // confirmButtonColor: '#3085d6',
                // cancelButtonColor: '#d33',
                // confirmButtonText: 'Yes, delete it!'
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         Livewire.emit('deleteChat');
            //     }
            // })
            // Livewire.emit('deleteChat');
        // });
        window.addEventListener('swal:confirmDelete',function(e){
            swal.fire(e.detail).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('confirmDelete',e.detail.id);
                }
            });
        });

        window.addEventListener('swal:confirmDeactivate',function(e){
            swal.fire(e.detail).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('confirmDeactivate',e.detail.id);
                }
            });
        });


$(document).on("click", "#replybtn", function(e) {
            $('.replybox').toggleClass("active");
        });
        $(document).on("click", "#replyboxclose", function(e) {
            $('.replybox').toggleClass("active");
        });
        $(document).on("click", "#chatboxclose", function(e) {
            $('.chatbox').toggleClass("active");
        });
        $(document).on("click", "#chatbtn", function(e) {
            $('.chatmessage').toggleClass("active");
            $('.chatbox').toggleClass("active");
        });
        $(document).on("click", "#chatmsg", function(e) {
            $('.chatmessage').toggleClass("active");
        });
