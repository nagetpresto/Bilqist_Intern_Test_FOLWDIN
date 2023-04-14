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
      <!-- GENERAL -->
      <h1>Employee Contract Data</h1>
      <a href="/employee" class='ms-1'>Employee Data</a>
      <a href="/positions" class='ms-5'>Position Data</a>
      <!-- GENERAL -->
       <!-- START FORM -->
       <form action='/api/contracts' method='post'>
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="mb-3 row">
                <label for="nim" class="col-sm-2 col-form-label">Employee Name</label>
                <div class="col-sm-10">
                    <select class="form-control" name='employee_id' id="employee_id"></select>
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
        
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                         
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-2">NIM</th>
                            <th class="col-md-2">Nama</th>
                            <th class="col-md-2">Start Date</th>
                            <th class="col-md-2">Position</th>
                            <th class="col-md-2">Division</th>
                            <th class="col-md-2">Status</th>
                            <th class="col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <!-- this is where the rows will be populated -->
                    </tbody>
                </table>
               
          </div>
          <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      $(document).ready(function() {
        $.ajax({
          url: "/api/contracts",
          type: "GET",
          dataType: "json",
          success: function(response) {
            console.log(response);
            // get the element to populate
            var tableBody = document.getElementById("table-body");
            // create a row for each employee and append to the table
            for (var i = 0; i < response.data.length; i++) {
              var data = response.data[i];
              var row = document.createElement("tr");
              var index = i + 1;
              row.innerHTML = "<td>" + index + "</td><td>" + data.employee.employee_nim + "</td><td>" + data.employee.employee_name + "</td><td>" + data.employee.start_date + "</td><td>" + data.position.positions_title + "</td><td>" + data.position.positions_division + "</td><td>" + data.status + 
              "</td><td><a href='/edit/" + data.id + "'>Edit</a> | <a href='/delete/" + data.id + "' data-contract-id='"+data.id+"' class='delete-link'>Delete</a></td>";
              tableBody.appendChild(row);
            }
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      });
      $(document).ready(function() {
        $.ajax({
            url: '/api/employee',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var options = '<option selected disabled value="">Select an employee</option>';
                $.each(response.data, function(key, value) {
                    options += '<option value="' + value.employee_id + '">' + value.employee_name + '</option>';
                });
                $('#employee_id').html(options);
            }
        });
      });
      $(document).ready(function() {
        $.ajax({
            url: '/api/positions',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var options = '<option selected disabled value="">Select position</option>';
                $.each(response.data, function(key, value) {
                    options += '<option value="' + value.positions_id + '">' + value.positions_title + '</option>';
                });
                $('#positions_id').html(options);
            }
        });
      });
      $(document).ready(function() {
        $("form").submit(function(event) {
            event.preventDefault();
            
            var employee_id = $("#employee_id").val();
            var positions_id = $("#positions_id").val();
            var status = $("#status").val();

            $.ajax({
                url: "/api/contracts",
                type: "POST",
                data: {
                    employee_id: employee_id,
                    positions_id: positions_id,
                    status: status
                },
                success: function(response) {
                    console.log(response);
                    alert("Form submitted successfully!");
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
      $(document).on("click", "a.delete-link", function(event) {
        event.preventDefault();

        var contractId = $(this).data("contract-id");

        if (confirm("Are you sure you want to delete this contract?")) {
          $.ajax({
            url: "/api/contracts/" + contractId,
            type: "DELETE",
            success: function(response) {
              console.log(response);
              alert("Data deleted successfully!");
              window.location.href = "/";
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
              alert(xhr.responseText);
              window.location.href = "/";
            }
          });
        }
      });
    </script>
  </body>
</html>