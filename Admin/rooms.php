<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - user queries</title>
    <?php require('inc/links.php');?>
</head>
<body class="bg-light">
    <?php require('inc/header.php') ?>
    
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Rooms</h3>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                    <div class="text-end mb-4">
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                            <i class="bi bi-plus-square"></i>Add
                        </button>
                    </div>

                        <div class="table-responsive-md" style="height:450px; overflow-y:scroll;">
                            <table class="table table-hover border">
                            <thead class="sticky-top">
                                <tr class="bg-light">
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">department</th>
                                <th scope="col">status</th>
                                <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody id="room-data">
                          
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- add room model -->
<!-- Modal -->
<div class="modal fade" id="add-room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="add_room_form" autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add room</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-6">
            <label class="form-label fw-bold">Name</label>
            <input type="text" name="name" class="form-control shadow-none">
        </div>

        <div class="col-md-6">
            <label class="form-label fw-bold">Department</label>
            <input type="text" name="department" class="form-control shadow-none">
        </div>
        <div class="col-12 mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="desc" class="form-control shadow-none" required></textarea>
        </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn custom-bg text-white shadow-none">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>



    <?php require ('inc/scripts.php')?>
    <script>
        let add_room_form =document.getElementById('add_room_form');
        add_room_form.addEventListener('submit',function(e){
             e.preventDefault();
                add_room(); 
        });
        function add_room()
        {
            let data = new FormData();
            data.append('add_room');
            data.append('name',add_room_form.elements['name'].value);
            data.append('department',add_room_form.elements['department'].value);
            data.append('desc',add_room_form.elements['desc'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/room.php",true);

            xhr.onload = function(){
                var myModal= document.getElementById('add-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText ==1)
                {
                 alert('success','New room added!');
                 add_room_form.reset();

                }
                else{
                    _alert('error','Sever Down')
                }
            }
        }
      
    </script>
</body>
</html>