

      </div>
  <div class="container-fluid">
      <!-- Trigger the modal with a button -->
      <br>  <br>
    <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Show Record</button>  <br>  <br>
    <div class="panel panel-default">
      <div class="panel-heading"></div>
      <div class="panel-body">
        <form>
      <div class="form-group">
      <input type="Hidden" name="ID" class="form-control">
      </div>
      <div class="form-group">
        <label>Name</label>
      <input type="text" name="Name"  class="form-control">
       </div>
      <div class="form-group">
        <label>Bday</label>
      <input type="date" name="Bday"  class="form-control">
       </div>
      <div class="form-group">
        <label>Age</label>
      <input type="number" name="Age"  class="form-control">
       </div>
       <div class="form-group">
      <input type="submit" name="Submit"  class="btn btn-success">
       </div>
    </form>

      </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
           <div class="table-responsive">
              <table class="table" id="example">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Bday</th>
                    <th>Age</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Name1</td>
                    <td>10-1-1997</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>Name2</td>
                    <td>9-1-1997</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>Name3</td>
                    <td>8-1-1997</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>Name4</td>
                    <td>7-1-1997</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>Name5</td>
                    <td>6-1-1997</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>Name6</td>
                    <td>10-1-1997</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>Name7</td>
                    <td>9-1-1997</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>Name8</td>
                    <td>8-1-1997</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>Name9</td>
                    <td>7-1-1997</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>Name10</td>
                    <td>6-1-1997</td>
                    <td>20</td>
                  </tr>
                  <tr>
                    <td>Name11</td>
                    <td>6-1-1997</td>
                    <td>20</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
     </div>
    <script type="text/javascript">
      $(document).ready(function() {
           $('#example').DataTable();
         } );

       var table= $('#example').DataTable();
       var tableBody = '#modal-body';
       $(tableBody).on('click', 'tr', function () {
           var cursor = table.row($(this).parents('tr'));//get the clicked row
           var data=cursor.data();// this will give you the data in the current row.
        $('form').find("input[name='name'][type='text']").val(data.name);
        });

    </script>
    <!-- End Page -->
