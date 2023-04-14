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
      <h1>Positions Data</h1>
      <a href="/" class='ms-1'>Back</a>
      <a href="/employee" class='ms-5'>Employee Data</a>
      <!-- GENERAL --> 
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
                         
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-2">Title</th>
                            <th class="col-md-2">Division</th>
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
          url: "/api/positions",
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
              row.innerHTML = "<td>" + index + "</td><td>" + data.positions_title + "</td><td>" + data.positions_division + "</td><td><a href='/employee/edit/" + data.positions_id + "'>Edit</a> | <a href='/employee/delete/" + data.positions_id + "'>Delete</a></td>";
              tableBody.appendChild(row);
            }
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      });
    </script>
  </body>
</html>