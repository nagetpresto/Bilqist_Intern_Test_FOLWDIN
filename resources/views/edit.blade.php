<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <main class="container">
       <!-- START FORM -->
       <form action='' method='patch'>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="nim" class="col-sm-2 col-form-label">Employee Name</label>
                <div class="col-sm-10">
                    <select class="form-control" name='employee_id' id="employee_id">
                    </select>
                    <!-- <input type="number" class="form-control" name='employee_name' id="employee_name"> -->
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Position</label>
                <div class="col-sm-10">
                    <select class="form-control" name='positions_id' id="positions_id"></select>
                    <!-- <input type="text" class="form-control" name='positions_title' id="positions_title"> -->
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jurusan" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-control" name='status' id="status">
                      <option selected disabled>Select status</option>
                      <option value="Internship">Internship</option>
                      <option value="Contract">Contract</option>
                      <option value="Full Time">Full Time</option>
                    </select>
                    <!-- <input type="text" class="form-control" name='status' id="status"> -->
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jurusan" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
            </div>
        </div>
       </form>
        <!-- AKHIR FORM -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // extract id from URL
            var id = window.location.pathname.split('/').pop();
            var employee_id = 0;
            var positions_id = 0;
            var status = "";
            $.ajax({
                url: "/api/contracts/" + id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                console.log(response);
                // populate form fields with response data
                employee_id = response.data[0].employee_id;
                positions_id = response.data[0].positions_id;
                status = response.data[0].status;

                // populate form fields with response data
                $('#employee_id').val(employee_id);
                $('#positions_id').val(positions_id);
                $('#status').val(status);
                
                },
                error: function(xhr, status, error) {
                console.log(xhr.responseText);
                }
            });
            $.ajax({
                url: '/api/employee',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var options = '<option selected disabled value="">Select an employee</option>';
                    $.each(response.data, function(key, value) {
                        var selected = (value.employee_id == employee_id) ? 'selected' : '';
                        options += '<option  '+ selected +' value="' + value.employee_id + '">' + value.employee_name + '</option>';
                    });
                    $('#employee_id').html(options);
                }
            });
            $.ajax({
                url: '/api/positions',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var options = '<option selected disabled value="">Select position</option>';
                    $.each(response.data, function(key, value) {
                        var selected = (value.positions_id == positions_id) ? 'selected' : '';
                        options += '<option '+ selected +' value="' + value.positions_id + '">' + value.positions_title + '</option>';
                    });
                    $('#positions_id').html(options);
                }
            });
        });
        $(document).ready(function() {
            // get id from URL
            var id = window.location.pathname.split('/').pop();
            console.log(id)

            // submit form data using AJAX
            $("form").submit(function(event) {
                event.preventDefault();
                
                var employee_id = $("#employee_id").val();
                var positions_id = $("#positions_id").val();
                var status = $("#status").val();

                $.ajax({
                    url: "/api/contracts/"+id,
                    type: "PUT",
                    data: {
                        positions_id: positions_id,
                        status: status
                    },
                    success: function(response) {
                        console.log(response);
                        alert("Form updated successfully!");
                        window.location.href = "/";
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert(xhr.responseText);
                        window.location.href = "/";
                    }
                });
            });
        });

    </script>
  </body>
</html>